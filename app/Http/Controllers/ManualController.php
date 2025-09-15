<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;

class ManualController extends Controller
{
    /**
     * 1. Handleiding tonen + teller ophogen
     */
    public function show($brand_id, $brand_slug, $manual_id)
    {
        $brand = Brand::findOrFail($brand_id);
        $manual = Manual::where('id', $manual_id)
            ->where('brand_id', $brand->id)
            ->firstOrFail();

        // Teller +1
        $manual->increment('view_count');

        return view('pages/manual_view', [
            "manual" => $manual,
            "brand" => $brand,
        ]);
    }

    /**
     * 2. Top 10 populairste handleidingen (site breed)
     */
    public function top10()
    {
        $manuals = Manual::orderByDesc('view_count')
            ->take(10)
            ->get();

        return view('pages/manuals_top10', [
            "manuals" => $manuals,
        ]);
    }

    /**
     * 3. Top 5 populairste handleidingen per merk
     */
    public function top5ByBrand($brand_id)
    {
        $brand = Brand::findOrFail($brand_id);

        $manuals = $brand->manuals()
            ->orderByDesc('view_count')
            ->take(5)
            ->get();

        return view('pages/manuals_top5_brand', [
            "brand" => $brand,
            "manuals" => $manuals,
        ]);
    }
}
