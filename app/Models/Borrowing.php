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

    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'date',
        'actual_return_date' => 'date',
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

    public function getIsReturnedAttribute(): bool
    {
        return !is_null($this->actual_return_date);
    }

    public function getIsOverdueAttribute(): bool
    {
        if ($this->is_returned) {
            return false;
        }

        return \Carbon\Carbon::parse($this->return_date)->endOfDay()->isPast();
    }

    // helper hitung denda (24 jam telat = Rp2.000)
    public function getFineAttribute()
    {
        $returnDate = \Carbon\Carbon::parse($this->return_date)->startOfDay();
        $comparisonDate = $this->actual_return_date
            ? \Carbon\Carbon::parse($this->actual_return_date)->startOfDay()
            : \Carbon\Carbon::today();

        if ($comparisonDate->lessThanOrEqualTo($returnDate)) {
            return 0;
        }

        $daysLate = $returnDate->diffInDays($comparisonDate);

        return $daysLate * 2000;
    }
}