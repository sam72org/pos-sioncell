<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function Index() {
        $model = User::all();
    	return view('user/index', ['model' => $model]);
    }

    public function Tambah() {
    	return view('user/tambah');
    }

    public function Create(Request $request) {
    	$this->validate($request,[
            'role' => 'required|string|max:20',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $model = User::create([
    		'name' => $request->name,
    		'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
    		'role' => $request->role,
    	]);

    	return redirect('user/index');
    }

    public function Ubah($id) {
    	$model = User::find($id);

    	return view('user/ubah', ['model' => $model]);
    }

    public function Update($id, Request $request) {
    	$model = User::find($id);
        $model->role        = $request->role;
        $model->name        = $request->name;
        $model->username    = $request->username;
        $model->email       = $request->email;
        $model->save();

        return redirect('user/index');
    }

    public function UbahPassword($id) {
        $model = User::find($id);

        return view('user/ubah-password', ['model' => $model]);
    }

     public function ChangePassword($id, Request $request) {
        $model = User::find($id);
        $model->password = bcrypt($request->password);
        $model->save();

        return redirect('user/index');
    }

    // public function Hapus($id) {
    // 	$model = RefPelanggan::find($id);
    //     $model->delete();
        
    //     return redirect('ref-pelanggan/index');
    // }
}
