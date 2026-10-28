<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    use HasFactory;

    protected $table = 'borrowers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
    // relasi One to Many dengan Borrowing
public function borrowings()
{
    return $this->hasMany('App\Models\Borrowing');
}
}