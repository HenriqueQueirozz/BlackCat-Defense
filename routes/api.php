<?php

use App\Http\Controllers\ZombiesController;
use App\Http\Controllers\ZombiesCounterController;
use App\Http\Controllers\ZombiesDefenseController;
use App\Http\Controllers\ZombiesWeaknessController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('zombies', ZombiesController::class)->only(['index', 'show', 'store']);
Route::resource('defenses', ZombiesDefenseController::class)->only(['index', 'show']);
Route::resource('counterattack', ZombiesCounterController::class)->only(['index', 'show']);
Route::resource('weaknesses', ZombiesWeaknessController::class)->only(['index', 'show']);