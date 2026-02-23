<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $fillable = [
        'date',
        'status',
        'aprovet_by_id',
    ];
    public function aprovet_by()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->belongsToMany(Item::class , 'import_items');
    }
}
