<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

#import model
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index(){
        $book = Book::with('publisher')->paginate(10);
        return view('backend.content.book.list',compact('book'));
    }

    public function create(){
        $publisher = Publisher::all();
        return view('backend.content.book.create',compact('publisher'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'date_of_issue' => 'required',
            'stock' => 'required',
        ]);

        $book = new Book();
        $book->code = Str::uuid();
        $book->title = $request->title;
        $book->date_of_issue = $request->date_of_issue;
        $book->stock = $request->stock;
        $book->publisher_id = $request->publisher_id;

        try {
            $book->save();
            return redirect(route('book.index'))->with('msg', ['success','Berhasil tambah buku']);
        }catch (\Exception $e){
            return redirect(route('book.index'))->with('msg', ['danger','Gagal tambah buku']);
        }
    }

    public function destroy($id){
        $book = Book::findOrFail($id);

        try {
            $book->delete();
            return redirect(route('book.index'))->with('msg', ['success','Berhasil hapus buku']);
        }catch (\Exception $e){
            return redirect(route('book.index'))->with('msg', ['danger','Gagal hapus buku']);
        }

    }

    public function edit($id){
        $book = Book::findOrFail($id);
        $publisher = Publisher::all();
        return view('backend.content.book.edit',compact('book','publisher'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'date_of_issue' => 'required',
            'stock' => 'required',
        ]);

        $book = Book::findOrFail($request->id);

        $book->title = $request->title;
        $book->date_of_issue = $request->date_of_issue;
        $book->stock = $request->stock;
        $book->publisher_id = $request->publisher_id;

        try {
            $book->save();
            return redirect(route('book.index'))->with('msg', ['success','Berhasil ubah buku']);
        }catch (\Exception $e){
            return redirect(route('book.index'))->with('msg', ['danger','Gagal ubah buku']);
        }
    }
}
