<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WareHouse extends Model
{
    protected $fillable = [
        'quantity',
        'expired_date',
        'item_id',
    ];
    public function items()
    {
        return $this->hasMany(Item::class , 'id', 'item_id');
    }

}
