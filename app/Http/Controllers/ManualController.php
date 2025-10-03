<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;

class ManualController extends Controller
{
    /**
     * 1. Handleiding tonen + teller ophogen (Ticket 09)
     */
    public function show($brand_id, $brand_slug, $manual_id)
    {
        $brand = Brand::findOrFail($brand_id);

        // Eager load 'type' zodat de view (indien gebruikt) $type kan tonen
        $manual = Manual::with('type')
            ->where('id', $manual_id)
            ->where('brand_id', $brand->id)
            ->firstOrFail();

        // Teller +1 (blijft zoals was)
        $manual->increment('view_count');

        // Optioneel aan view meegeven als die $type verwacht
        $type = $manual->type;

        return view('pages/manual_view', compact('manual', 'brand', 'type'));
    }

    /**
     * 2. Top 10 populairste handleidingen (site breed) - Ticket 10
     */
    public function top10()
    {
        $manuals = Manual::orderByDesc('view_count')
            ->take(10)
            ->get();

        return view('pages/manuals_top10', compact('manuals'));
    }

    /**
     * 3. Top 5 populairste handleidingen per merk - Ticket 11
     */
    public function top5ByBrand($brand_id)
    {
        $brand = Brand::findOrFail($brand_id);

        // via relatie (zorg dat Brand een manuals() relatie heeft in het model)
        $manuals = $brand->manuals()
            ->orderByDesc('view_count')
            ->take(5)
            ->get();

        return view('pages/manuals_top5_brand', compact('brand', 'manuals'));
    }
    public function create()
    {
        
    }
}
