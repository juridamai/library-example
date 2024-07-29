<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

#import model
use App\Models\Publisher;

use Barryvdh\DomPDF\Facade\Pdf;

class PublisherController extends Controller
{
    public function index(){
        $publisher = Publisher::paginate(10);
        return view('backend.content.publisher.list',compact('publisher'));
    }

    public function create(){
        return view('backend.content.publisher.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);

        $publisher = new Publisher();
        $publisher->name = $request->name;
        $publisher->address = $request->address;

        try {
            $publisher->save();
            return redirect(route('publisher.index'))->with('msg', ['success','Berhasil tambah penerbit']);
        }catch (\Exception $e){
            return redirect(route('publisher.index'))->with('msg', ['danger','Gagal tambah penerbit']);
        }
    }

    public function destroy($id){
        $publisher = Publisher::findOrFail($id);

        try {
            $publisher->delete();
            return redirect(route('publisher.index'))->with('msg', ['success','Berhasil hapus penerbit']);
        }catch (\Exception $e){
            return redirect(route('publisher.index'))->with('msg', ['danger','Gagal hapus penerbit']);
        }
    }

    public function edit($id){
        $publisher = Publisher::findOrFail($id);
        return view('backend.content.publisher.edit', compact('publisher'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
        ]);

        $publisher = Publisher::findOrFail($request->id);
        $publisher->name = $request->name;
        $publisher->address = $request->address;

        try {
            $publisher->save();
            return redirect(route('publisher.index'))->with('msg', ['success','Berhasil ubah penerbit']);
        }catch (\Exception $e){
            return redirect(route('publisher.index'))->with('msg', ['danger','Gagal ubah penerbit']);
        }
    }
}
