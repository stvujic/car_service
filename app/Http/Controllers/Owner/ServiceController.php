<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Models\Workshop;

class ServiceController extends Controller
{

    public function index(int $workshopId)
    {
        abort_unless(auth()->user()->role === 'owner', 403);

        $workshop = Workshop::where('owner_id', auth()->id())->findOrFail($workshopId);

        $services = $workshop->services()->paginate(10);

        return view('owner.services.index', compact('workshop', 'services'));

    }

    public function create(int $workshopId)
    {
        abort_unless(auth()->user()->role === 'owner', 403);

        $workshop = Workshop::where('owner_id', auth()->id())->findOrFail($workshopId);

        return view('owner.services.create', compact('workshop'));
    }

    public function store(StoreServiceRequest $request, int $workshopId)
    {
        abort_unless(auth()->user()->role === 'owner', 403);

        $workshop = Workshop::where('owner_id', auth()->id())->findOrFail($workshopId);
        $workshop->services()->create($request->validated());

        return redirect()
            ->route('owner_services_index', $workshopId)
            ->with('success', 'Service added successfully');    }

    public function edit(int $workshopId, int $serviceId)
    {
        abort_unless(auth()->user()->role === 'owner', 403);

        $workshop = Workshop::where('owner_id', auth()->id())->findOrFail($workshopId);

        $service = $workshop->services()->findOrFail($serviceId);

        return view('owner.services.edit', compact('workshop', 'service'));
    }

    public function update(UpdateServiceRequest $request, int $workshopId, int $serviceId)
    {
        abort_unless(auth()->user()->role === 'owner', 403);

        $workshop = Workshop::where('owner_id', auth()->id())->findOrFail($workshopId);
        $service  = $workshop->services()->findOrFail($serviceId);

        $service->update($request->validated());

        return redirect()
            ->route('owner_services_index', $workshopId)
            ->with('success', 'Service updated successfully');
    }

    public function destroy(int $workshopId, int $serviceId)
    {
        abort_unless(auth()->user()->role === 'owner', 403);

        $workshop = Workshop::where('owner_id', auth()->id())->findOrFail($workshopId);
        $service  = $workshop->services()->findOrFail($serviceId);
        $service->delete();

        return back()->with('success', 'Service deleted.');
    }

}
