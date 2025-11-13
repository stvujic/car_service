<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workshop extends Model
{
    protected $fillable =  [
        'owner_id','name','slug','city','address','phone','description','is_verified'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function workingHours() : HasMany
    {
        return $this->hasMany(WorkingHour::class);
    }

    public function closedDates() : HasMany
    {
        return $this->hasMany(ClosedDate::class);
    }
}
