<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanDetailed extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'currency_id', 'loan_id',
        'to_be_returned', 'interest', 'total_amount',
        'amount', 'profit_rate','interest_rate','dated',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
