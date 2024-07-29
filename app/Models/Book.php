<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Publisher;

class Book extends Model
{
    protected $table = 'books';

    protected $primaryKey = 'id';

    protected $fillable = [
        'code',
        'title',
        'date_of_issue',
        'stock',
        'publisher_id',
    ];

    public function publisher(){
        return $this->belongsTo(Publisher::class,'publisher_id');
    }
}
