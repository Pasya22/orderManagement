<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['table_no', 'order_details'];
    protected $casts = [
        'order_details' => 'array', // Memastikan 'order_details' di-cast ke array saat diakses
    ];
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
