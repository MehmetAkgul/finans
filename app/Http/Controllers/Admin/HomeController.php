<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logger;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    public function index()
    {

        return view('admin.index');
    }

    public function data(Request $request)
    {
        $table = Logger::query();
        $data = DataTables::of($table)->make(true);
        return $data;
    }

}
