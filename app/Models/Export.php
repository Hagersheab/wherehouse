<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    protected $fillable = [
        'status',
        'date_approve',
        'reseved_by_id',
        'approved_by_id',
        'department_id',
    ];
    public function reseved_by()
    {
        return $this->belongsTo(User::class);
    }
    public function approved_by()
    {
        return $this->belongsTo(User::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function items()
    {
        return $this->belongsToMany(Item::class, 'export_items')
        ->withPivot('quantity');
    }

}
