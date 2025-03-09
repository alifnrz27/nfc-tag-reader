<?php

use App\Http\Controllers\ReaderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ReaderController::class, 'index']);
