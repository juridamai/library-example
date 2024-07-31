<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

#import model
use App\Models\Transaction;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(){
        $transaction = Transaction::with('customer')->paginate(10);
        return view('backend.content.transaction.list',compact('transaction'));
    }

    public function detail($id){
        $transaction = Transaction::with('customer','item')->findOrFail($id);
        return view('backend.content.transaction.detail',compact('transaction'));
    }

    public function return(Request $request)
    {
        DB::beginTransaction();
        try{

            $id = $request->id;
            $transaction = Transaction::with('item')->findOrFail($id);

            #Calculate difference between two dates
            $dateMustReturn = Carbon::parse(date('Y-m-d', strtotime($transaction->date_must_return)));
            $dateNow = Carbon::parse(date('Y-m-d'));
            $diff = $dateMustReturn->diffInDays($dateNow,false);

            if($diff > 0){
                $transaction->penalty = $diff * intval(env('PENALTY'));
            }

            #ReturnItemsStock
            foreach ($transaction->item as $row){
                $book = Book::findOrFail($row->book_id);
                $book->returnItem($row->qty);
            }

            $transaction->status = 0;
            $transaction->save();

            DB::commit();
            return redirect(route('transaction.detail',$transaction->id))->with('msg', ['success','Berhasil kembalikan buku']);

        }catch(\Exception $e){
            DB::rollback();
            return redirect(route('transaction.detail',$transaction->id))->with('msg', ['danger','Gagal kembalikan buku']);
        }

    }
}
