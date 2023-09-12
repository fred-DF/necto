<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome', [
        'products' => Product::all(),
    ]);
});

Route::get('item/{item}', function ($slug) {
    //  Passendes Produkt zu der Variable $slug aus der Datenbank finden und an die View Item übergebn
    
    $item = Product::where('name', '=', $slug)->get()->toArray()[0];
    
    return view('item', [
        'item' => $item
    ]);

});

Route::get('shopping-cart', function () {
    return view('shopping-cart');
});

Route::get('legal', function () {
    return view('legal');
});