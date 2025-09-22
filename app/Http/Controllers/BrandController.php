<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;

class BrandController extends Controller
{
    public function show($brand_id, $brand_slug)
    {
        $brand = Brand::findOrFail($brand_id);

        // Bestaande lijst (ongewijzigd)
        $manuals = Manual::all()->where('brand_id', $brand_id);

        // ✅ Ticket 11: Top-5 meest bekeken manuals voor dit merk
        // (wordt bovenaan de merkpagina getoond)
        $top5Manuals = Manual::with('type')
            ->where('brand_id', $brand->id)
            ->orderByDesc('view_count')
            ->take(5)
            ->get();

        return view('pages/manual_list', [
            'brand'       => $brand,
            'manuals'     => $manuals,
            'top5Manuals' => $top5Manuals, // ← toegevoegd
        ]);
    }
}
