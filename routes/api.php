<?php

use App\Http\Controllers\UssdBackendController;
use App\Http\Controllers\UssdController;
use App\Http\Controllers\UssdMenuProcessor;
use App\Http\Controllers\WhatsappBotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Example API route
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});
Route::prefix('v1/')->group(function () {
    Route::post('mcaz/ussd/live', [UssdController::class, 'index']);
});

Route::prefix('v1/')->group(function () {
    Route::post('mcaz/backend/live', [UssdBackendController::class, 'process'])->name("mcazBackendRoute");
});

Route::prefix('v1/')->group(function () {
    Route::post('mcaz/ussd/processor/live', [UssdMenuProcessor::class, 'process'])->name("mcazMenuProcessor");
});

Route::prefix('v1/')->group(function () {
    Route::post('mcaz/ussd/whatsapp/live', [WhatsappBotController::class, 'process'])->name("mcazWhatsappMenuProcessor");
});
