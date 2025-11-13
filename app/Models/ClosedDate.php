<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClosedDate extends Model
{
    protected $fillable = [
        'workshop_id','date','reason'
    ];

    public function workshop() : BelongsTo
    {
        return $this->belongsTo(Workshop::class, 'workshop_id');
    }
}
