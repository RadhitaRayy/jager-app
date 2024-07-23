<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'frontend_user_id', 'name', 'phone', 'address', 'total', 'status','payment_status',
        'shipping_status',
        'shipping_details',
        'snap_token',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function frontendUser()
    {
        return $this->belongsTo(FrontendUser::class, 'frontend_user_id');
    }
}
