<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_id',
        'date',
        'return_date',
        'date_must_return',
        'status',
        'penalty',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function item(){
        return $this->hasMany(ItemTransaction::class);
    }
}
