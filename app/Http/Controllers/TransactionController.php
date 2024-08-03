<?php

namespace App\Http\Controllers;

use App\Models\ItemTransaction;
use Illuminate\Http\Request;

#import model
use App\Models\Transaction;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class TransactionController extends Controller
{
    public function index(){
        $transaction = Transaction::with('customer')->orderBy('status','desc')->paginate(10);
        return view('backend.content.transaction.list',compact('transaction'));
    }

    public function detail($id){
        $transaction = Transaction::with('customer','item')->findOrFail($id);
        return view('backend.content.transaction.detail',compact('transaction'));
    }

    public function create(){
        $customer = Customer::all();
        $book = Book::where('stock','>',0)->get();
        return view('backend.content.transaction.create',compact('customer','book'));
    }

    public function store(Request $request){
        DB::beginTransaction();

        try{
            //semua proses insert
            $send = $request->send;
            $customer_id = $request->customer_id;

            $mustReturn = Carbon::now()->addDays(7);

            $transaction = new Transaction();
            $transaction->date = Carbon::now()->toDateString();
            $transaction->date_must_return = $mustReturn->toDateString();
            $transaction->customer_id = $customer_id;
            $transaction->save();

            foreach ($send as $i){

                #min stock
                $book_id = $i['book_id'];
                $book = Book::findOrFail($book_id);
                $book->reduceStock();

                $item = new ItemTransaction();
                $item->book_id = $book_id;
                $item->qty = 1;
                $item->transaction_id = $transaction->id;
                $item->save();
            }

            DB::commit();
            return redirect(route('transaction.index'))->with('msg', ['success','Berhasil pinjam buku']);

        }catch (\Exception $e){
            DB::rollBack();
            return redirect(route('transaction.index'))->with('msg', ['danger','Gagal pinjam buku']);
        }
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
                $book->returnStock();
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
