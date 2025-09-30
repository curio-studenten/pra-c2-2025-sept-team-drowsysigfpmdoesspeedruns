<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

use App\Models\Brand;
use App\Models\Manual; 
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\LocaleController;

// Homepage
Route::get('/', function () {
    $brands = Brand::all()->sortBy('name');
    $description = 'Hoi dit is een pagina waar je handleiding kunt downloaden';
    $myname = 'joe biden';

    
    $top10Manuals = Manual::with(['brand','type'])
        ->orderByDesc('view_count')
        ->take(10)
        ->get();

   
    return view('pages.homepage', compact('brands', 'description', 'myname', 'top10Manuals'));
})->name('home');


Route::get('/contact', function () {
    return view('pages.contact');
});
Route::get('/manage', function () {
    return view('pages.managementpage');
});
Route::post('/contact', [ContactController::class, 'store']);

Route::get('/manual/{language}/{brand_slug}/', [RedirectController::class, 'brand']);
Route::get('/manual/{language}/{brand_slug}/brand.html', [RedirectController::class, 'brand']);

Route::get('/datafeeds/{brand_slug}.xml', [RedirectController::class, 'datafeed']);

// Locale routes
Route::get('/language/{language_slug}/', [LocaleController::class, 'changeLocale'])->name('language.switch');

// List of manuals for a brand (merkpagina)
Route::get('/{brand_id}/{brand_slug}/', [BrandController::class, 'show']);

// Detail page for a manual
Route::get('/{brand_id}/{brand_slug}/{manual_id}/', [ManualController::class, 'show']);

// Generate sitemaps
Route::get('/generateSitemap/', [SitemapController::class, 'generate']);

// Top 10 handleidingen (globaal) – losse pagina blijft bestaan
Route::get('/manuals_top10', [ManualController::class, 'top10'])->name('manuals.top10');

// Top 5 handleidingen per merk – losse pagina blijft bestaan
Route::get('/{brand_id}/{brand_slug}/top5', [ManualController::class, 'top5ByBrand'])->name('manuals.top5ByBrand');

// web.php
Route::get('/manual/{id}/{name}/{id2}', [ManualController::class, 'show'])->name('manual.show');