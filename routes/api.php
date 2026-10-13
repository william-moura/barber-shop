<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarbershopController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/teste', function () {
    return response()->json([
        'message' => 'Hello World'
    ]);
});
Route::post('/barbearias', [BarbershopController::class, 'store']);
