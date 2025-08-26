<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $propertiesByLocation = Property::with('images')
            ->where('status', 'active')
            ->latest()
            ->get()
            ->groupBy(fn ($p) => $p->location ?: 'Unspecified');

        return view('real-estate', [
            'propertiesByLocation' => $propertiesByLocation,
        ]);
    }

    public function dashboard(Request $request): View
    {
        $properties = Property::where('user_id', auth()->id())
            ->with(['images', 'comments', 'reactions'])
            ->latest()
            ->get();

        // Add default values for properties that might not have these fields
        $properties->each(function ($property) {
            $property->views_count = $property->views_count ?? 0;
            $property->inquiries_count = $property->inquiries_count ?? 0;
        });

        return view('dashboard', [
            'properties' => $properties,
        ]);
    }
}



