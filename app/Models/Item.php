<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'catogory_id',
    ];

    public function catogory()
    {
        return $this->belongsTo(Category::class);
    }
    public function ware_house()
    {
        return $this->belongsTo(WareHouse::class);
    }
    public function imports()
    {
        return $this->belongsToMany(Import::class , 'import_items');
    }
    public function exports()
    {
        return $this->belongsToMany(Export::class , 'export_items');
    }
}
