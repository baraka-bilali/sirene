<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
use App\Models\Notification;

Route::get('/', function () {
    $alerts = Notification::latest()->paginate(10);
    return view('dashboard', compact('alerts'));
});
