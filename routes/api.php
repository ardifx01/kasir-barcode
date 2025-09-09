<?php 
use Illuminate\Support\Facades\Route;

use App\Models\Product;

Route::get('/product/{barcode}', function ($barcode) {
    return Product::where('barcode', $barcode)->first();
});
