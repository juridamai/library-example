<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

#import model
use App\Models\Transaction;
use App\Models\ItemTransaction;
use App\Models\Book;

class TransactionController extends Controller
{
    public function index(){
        $transaction = Transaction::with('customer')->paginate(10);
        return view('backend.content.transaction.list',compact('transaction'));
    }

    public function detail($id){
        $transaction = Transaction::with('customer','item')->findOrFail($id);
//        dd($transaction);
        return view('backend.content.transaction.detail',compact('transaction'));
    }

    public function return(Request $request)
    {
        dd("hai");
    }
}
