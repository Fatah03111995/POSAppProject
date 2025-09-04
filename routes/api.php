<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//LOGIN
Route::post('/login', [\App\Http\Controllers\api\AuthController::class, 'login']);
//post adalah methode statis dari class Route
//parameter pertama adalah endpoint
//parameter kedua adalah handler yang digunakan
//handler berupa clossur(di dart anonymous function atau lambda), callable array
//Callable array adalah array yang berisi dua elemen
// elemen pertama adalah nama class, elemen kedua adalah nama method

//Menggunakan clossure, hanya untuk sekala kecil
// Route::post('/login', function(){
//     $controller = new \App\Http\Controllers\api\AuthController();
//     return $controller->login(request());
// });

//LIST CATEGORY
Route::get('/categories', [\App\Models\Category::class, 'index'])->middleware('auth:sanctum');
