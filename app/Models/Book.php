<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'author',
        'year',
    ];
    // relasi One to Many dengan Borrowing
public function borrowings()
{
    return $this->hasMany('App\Models\Borrowing');
}
}