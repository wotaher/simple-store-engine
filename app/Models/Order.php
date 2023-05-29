<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'zip_code',
        'city',
        'user_id',
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getTotal()
    {
        return array_reduce($this->details()->get()->toArray(), function ($carry, $detail) {
                return $carry + ($detail['unit_price'] * $detail['quantity']);
            }, 0);
    }
}
