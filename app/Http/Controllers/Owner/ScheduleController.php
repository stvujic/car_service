<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkingHoursRequest;
use App\Models\WorkingHour;
use App\Models\Workshop;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function edit(int $workshopId)
    {
        abort_unless(auth()->user()->role === 'owner', 403);

        $workshop = Workshop::where('owner_id', auth()->id())
            ->with(['workingHours', 'closedDates'])
            ->findOrFail($workshopId);

        return view('owner.schedule.edit', compact('workshop'));
    }

    public function upsertWorkingHours(StoreWorkingHoursRequest $request, int $workshopId)
    {
        abort_unless(auth()->user()->role === 'owner', 403);

        $workshop = Workshop::where('owner_id', auth()->id())->findOrFail($workshopId);

        foreach ($request->validated()['items'] as $item) {
            WorkingHour::updateOrCreate(
                [
                    'workshop_id' => $workshop->id,
                    'day_of_week' => $item['day_of_week']
                ],
                [
                    'is_working_day' => $item['is_working_day'],
                    'open_time' => $item['is_working_day'] ? $item['open_time'] : null,
                    'close_time' => $item['is_working_day'] ? $item['close_time'] : null,
                    'break_start' => $item['is_working_day'] ? $item['break_start'] ?? null : null,
                    'break_end' => $item['is_working_day'] ? $item['break_end'] ?? null : null,
                ]
            );
        }

        return back()->with('success', 'Working hours saved.');
    }

}
