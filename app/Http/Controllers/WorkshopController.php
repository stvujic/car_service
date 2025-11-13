<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    public function index()
    {
        $workshops = Workshop::where('is_verified', true)->paginate(12);
        return view('workshops.index', compact('workshops'));
    }

    public function show(string $slug)
    {
        $workshop = Workshop::with([
            'services' => function ($query) {
                $query->where('is_active', true);
            },
            'workingHours',
            'closedDates'
        ])
            ->where('slug', $slug)
            ->where('is_verified', true)
            ->firstOrFail();

        return view('workshops.show', compact('workshop'));
    }
}
