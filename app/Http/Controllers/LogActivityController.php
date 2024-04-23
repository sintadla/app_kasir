<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LogActivityController extends Controller
{
    public function index(Request $request)
    {
        $data = \App\Models\LogActivity::all();
            return view('log_activity.index', [
            'data'=>$data,
            ]);
    }

    protected function all(Request $request)
    {
        return LogActivity::list($request->nama);
    }

    protected function kasir(Request $request)
    {
        return LogActivity::list($request->nama, ['kasir', 'manajer']);
    }

    public function clear()
    {
        LogActivity::truncate();

        return back()->with('status', 'clear');
    }
}

