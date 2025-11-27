<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkingHour extends Model
{
    use HasFactory;
    protected $fillable = [
        'workshop_id',
        'day_of_week',
        'is_working_day',
        'open_time',
        'close_time',
        'break_start',
        'break_end',
    ];

    public function workshop(): BelongsTo
    {
        return $this->belongsTo(Workshop::class);
    }

}
