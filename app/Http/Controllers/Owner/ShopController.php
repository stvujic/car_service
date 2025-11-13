<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkshopRequest;
use App\Http\Requests\UpdateWorkshopRequest;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->role ==='owner', 403);

        $workshops = Workshop::where('owner_id', auth()->id())->paginate(10);
        return  view('owner.workshops.index', compact('workshops'));
    }

    public function create()
    {
        abort_unless(auth()->user()->role ==='owner', 403);

        return view('owner.workshops.create');
    }

    public function store(StoreWorkshopRequest $request)
    {
        $data = $request->validated();
        $data['owner_id'] = auth()->id();
        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(6);

        $workshop = Workshop::create($data);

        return redirect()->route('owner_workshops_index')->with('success', 'Workshop created. Awaiting admin verification.');
    }

    public function edit(int $id)
    {
        abort_unless(auth()->user()->role === 'owner', 403);

        $workshop = Workshop::where('owner_id', auth()->id())->findOrFail($id);
        return view('owner.workshops.edit', compact('workshop'));
    }

    public function update(UpdateWorkshopRequest $request, int $id)
    {
        abort_unless(auth()->user()->role === 'owner', 403);

        $workshop = Workshop::where('owner_id', auth()->id())->findOrFail($id);
        $workshop->update($request->validated());

        return back()->with('success', 'Workshop updated.');
    }

    public function destroy(int $id)
    {
        abort_unless(auth()->user()->role === 'owner', 403);

        $workshop= Workshop::where('owner_id', auth()->id())->findOrFail($id);
        $workshop->delete();

        return redirect()->route('owner_workshops_index')->with('success', 'Workshop deleted.');

    }


}
