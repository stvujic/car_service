<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $fillable = [
        'workshop_id','name','description','duration_minutes','price_cents','is_active'
    ];

    public function workshop() : BelongsTo
    {
        return $this->belongsTo(Workshop::class, 'workshop_id');
    }
}
