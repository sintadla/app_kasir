<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\Menu;
use App\Models\Transaksi;
// use Darryldecode\Cart\Cart;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function index()
    {
        $data = Menu::select('id','nama_menu','kategori','foto','harga')
        ->orderBy('kategori')->get();

        $data->map(function ($row) {
            // $row->foto = asset("images/{$row->foto}");
            $row->foto = Storage::url('public/images/' . $row->foto);
            return $row;
        });

        return view('cart.index', [
            'data' =>$data,
        ]);
    }


    public function add(Menu $menu)
{
    Cart::add([
        'id' => $menu->id,
        'name' => $menu->nama_menu,
        'price' => $menu->harga,
        'quantity' => 1,
    ]);
    return back();
}


    public function update($id,$type)
{
    switch ($type) {
        case 'plus':
            \Cart::update($id,[
                'quantity' => 1
            ]);
            break;
            case 'minus':
                \Cart::update($id,[
                'quantity' => -1
            ]);
            break;
            case 'remove':
                \Cart::remove($id);
                break;
    }
    return back();
}

    public function store(Request $request)
{
    LogActivity::add('berhasil membuat Transaksi');
    $request->validate([
        'cash' => 'required|numeric'
    ]);
    $subtotal = \Cart::getTotal();
    $pajak = $subtotal * 10/100;
    $total = $subtotal + $pajak;
    $kembalian = $request->cash - $total;
    $total_qty = \Cart::getTotalQuantity();

    if ($kembalian < 0) {
        return back()->withErrors([
            'cash'=>'Cash tidak mencukupi',
        ])->withInput();
    }
    $transaksi = Transaksi::create([
        'user_id'=>Auth::id(),
        'qty_total'=>$total_qty,
        'sub_total'=>$subtotal,
        'pajak' => $pajak,
        'total' => $total,
        'tunai' => $request->cash,
        'kembalian' =>$kembalian,
        'status' => 'success',
    ]);

    foreach (\Cart::getContent() as $row) {
    TransaksiDetail::create([
        'transaksi_id' => $transaksi->id,
        'menu_id' => $row->id,
        'qty' => $row->quantity,  // Perbaikan typo di sini
        'harga' => $row->price,
    ]);
}
    LogActivity::add('berhasil membuat Transaksi');

    \Cart::clear();

    return redirect()->route('transaksi.show', ['transaksi' => $transaksi->id]);
}
public function destroy()
{
    \Cart::clear();
    return back();
}
}

//     Cart::clear();
// }
//     public function destroy()
// {
//     Cart::clear();
//     return back();
// }


// }


