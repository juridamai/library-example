<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemTransaction extends Model
{
    protected $table = 'item_transactions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'transaction_id',
        'book_id',
        'qty',
        'description',
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id');
    }

    public function book(){
        return $this->belongsTo(Book::class,'book_id');
    }
}
