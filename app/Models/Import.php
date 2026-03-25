<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
   public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
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
        return $this->belongsToMany(Item::class , 'import_items')
        ->withPivot('quantity');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
