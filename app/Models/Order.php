<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $with = ['currency'];

    protected $fillable = [
        'currency_id',
        'exchange_rate',
        'surcharge_percentage',
        'surcharge_amount',
        'amount_purchased',
        'amount_payed_usd',
        'discount_percentage',
        'discount_amount',
        'date'
    ];

    /**
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
