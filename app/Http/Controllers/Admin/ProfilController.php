<?php

namespace App\Http\Controllers\Admin;

use App\Helper\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        return view('admin.profil.index');
    }

    public function store(Request $request)
    {


        $all = $request->except('_token', 'password2');
        if ($all['password'] == "") {
            unset($all['password']);
        } else {
            $all['password'] = Hash::make($request->password);
        }


        $data = User::where('id', Auth::id())->first();
        $all['photo'] = FileUpload::changeUpload(Auth::user()->email, $request->file('photo'), 0, $data, 'photo');

        $update = User::where('id', Auth::id())->update($all);
        return redirect()->back();
    }

}
