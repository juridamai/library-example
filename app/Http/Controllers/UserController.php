<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $user = User::paginate(10);
        return view('backend.content.user.list',compact('user'));
    }

    public function create(){
        return view('backend.content.user.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt('12345678');

        try {
            $user->save();
            return redirect(route('user.index'))->with('msg', ['success','Berhasil tambah user dengan password 12345678']);
        }catch (\Exception $e){
            return redirect(route('user.index'))->with('msg', ['danger','Gagal tambah user']);
        }
    }

    public function destroy($id){
        $user = User::findOrFail($id);

        try {
            $user->delete();
            return redirect(route('user.index'))->with('msg', ['success','Berhasil hapus user']);
        }catch (\Exception $e){
            return redirect(route('user.index'))->with('msg', ['danger','Gagal hapus user']);
        }
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('backend.content.user.edit', compact('user'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;

        try {
            $user->save();
            return redirect(route('user.index'))->with('msg', ['success','Berhasil ubah user']);
        }catch (\Exception $e){
            return redirect(route('user.index'))->with('msg', ['danger','Gagal ubah user']);
        }
    }
}
