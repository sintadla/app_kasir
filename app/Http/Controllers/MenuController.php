<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $data = Menu::select('id', 'nama_menu', 'kategori', 'foto', 'harga', 'keterangan')
            ->when($search, function ($q) use ($search) {
                $q->where('nama_menu', 'like', "%{$search}%");
            })
            ->orderBy('kategori')
            ->paginate(50);

        $data->map(function ($row) {
            // $row->foto = asset("public/storage/images/$row->foto");
            $row->foto = Storage::url('public/images/' . $row->foto);
            return $row;
        });

        return view('menu.index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|min:4',
            'harga' => 'required|numeric',
            'file_foto' => 'required|image|max:2000',
            'kategori' => 'required|in:makanan,minuman',
        ]);

        $folder = 'images';

        $file = $request->file('file_foto');
        $ext = $file->getClientOriginalExtension();
        $filename = date("Ymdhis") . '.' . $ext;

        $file->storeAs($folder, $filename, 'public');

        $request->merge([
            'foto' => $filename,
        ]);

        Menu::create($request->all());

        return redirect()->route('menu.index')->with('status', 'save');
    }
    public function show(Menu $menu)
    {
        return abort(404);
    }

    public function edit(Menu $menu)
    {
        $menu->foto = Storage::url('public/images/' . $menu->foto);
        return view('menu.edit', [
            'row' => $menu,
        ]);
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama_menu' => 'required|min:4',
            'harga' => 'required|numeric',
            'file_foto' => 'nullable|image|max:2000',
            'kategori' => 'required|in:makanan,minuman',
        ]);

        if ($request->file_foto) {
            $folder = 'images';
            $foto_lama = "{$folder}/{$menu->foto}";

            if (file_exists($foto_lama)) {
                unlink($foto_lama);
            }

            $file = $request->file('file_foto');
            $ext = $file->getClientOriginalExtension();
            $filename = date('Ymdhis') . '.' . $ext;

            $file->storeAs($folder, $filename, 'public');

            $request->merge([
                'foto' => $filename,
            ]);
        }

        $menu->update($request->all());

        return redirect()->route('menu.index')->with('status', 'edit');
    }
    public function destroy(Menu $menu)
    {
        $folder = 'images';
        $foto_lama = "{$folder}/{$menu->foto}";

        if (file_exists($foto_lama)) {
            unlink($foto_lama);
        }

        $menu->delete();

        return back()->with('status', 'delete');
    }
}
