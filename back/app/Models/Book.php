<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
       protected $fillable =[
           'title',
           'author',
           'description',
           'category',
           'quantity',
           'cover_image'
];
  public  function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
