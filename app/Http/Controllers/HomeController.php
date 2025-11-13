<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $workshops = Workshop::query()
            ->where('is_verified', true)
            ->latest()
            ->paginate(12);

        return view('home', compact('workshops'));
    }
}
