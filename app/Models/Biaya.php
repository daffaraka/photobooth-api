<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'biaya'
    ];


    protected static function boot()
    {
        parent::boot();

        // Otomatis buat Produk-1 , Produk-2, Produk-3 dst
        static::creating(function ($order) {
            $lastOrder = static::latest()->first();

            if ($lastOrder) {
                $lastCode = explode('-', $lastOrder->order_id);
                $number = intval($lastCode[1]);
                $order->order_id = 'ORDER-' . ($number + 1) . ' - ' . date('Y-m-d - H:i:s');
            } else {
                $order->order_id = 'ORDER-1' . ' - ' . date('Y-m-d - H:i:s');
            }
        });
    }
}
