<?php

use App\Http\Controllers\Civilian\CivilianController;
use Illuminate\Support\Facades\Route;

Route::resource('/', CivilianController::class);
