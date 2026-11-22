<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $table = 'borrowings';
    protected $primaryKey = 'id';

    protected $fillable = [
        'borrower_id',
        'book_id',
        'borrow_date',
        'return_date',
        'actual_return_date',
    ];

    // relasi Many to One (belongsTo) ke Borrower
    public function borrower()
    {
        return $this->belongsTo(Borrower::class);
    }

    // relasi Many to One (belongsTo) ke Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // helper hitung denda (24 jam telat = Rp2.000)
    public function getFineAttribute()
    {
        if (!$this->actual_return_date) {
            return 0;
        }

        $returnDate = \Carbon\Carbon::parse($this->return_date);
        $actualReturnDate = \Carbon\Carbon::parse($this->actual_return_date);

        if ($actualReturnDate->lessThanOrEqualTo($returnDate)) {
            return 0;
        }

        $daysLate = $returnDate->diffInDays($actualReturnDate);
        return $daysLate * 2000;
    }
}