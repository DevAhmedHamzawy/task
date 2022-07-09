<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function paymentSafe()
    {
        return $this->belongsTo(PaymentSafe::class);
    }

    public function exchangeStore()
    {
        return $this->belongsTo(ExchangeStore::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItems::class);
    }
}
