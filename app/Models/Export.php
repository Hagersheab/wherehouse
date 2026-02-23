<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
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

}
