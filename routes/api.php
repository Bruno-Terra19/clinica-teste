<?php

use App\Http\Controllers\CalcomWebhookController;
use App\Http\Controllers\ContactFormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/calcom/webhook', [CalcomWebhookController::class, 'handle']);
Route::post('/contato', [ContactFormController::class, 'store']);