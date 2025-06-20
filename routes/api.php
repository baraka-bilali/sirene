<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NotificationController;
use App\Models\Notification;

Route::post('/alert', [NotificationController::class, 'store']);
Route::get('/alerts', [NotificationController::class, 'index']);
Route::delete('/alert/{id}', [NotificationController::class, 'destroy']);
Route::get('/alert-count', [Notification::class, 'count']);
