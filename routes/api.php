<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: *");

use App\Http\Controllers\ZumbisController;
use App\Http\Controllers\ZumbisCounterController;
use App\Http\Controllers\ZumbisDefenseController;
use App\Http\Controllers\ZumbisWeaknessController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('zumbis', ZumbisController::class)->only(['index', 'show', 'store']);
Route::resource('defenses', ZumbisDefenseController::class)->only(['index', 'show']);
Route::resource('counterattack', ZumbisCounterController::class)->only(['index', 'show']);
Route::resource('weaknesses', ZumbisWeaknessController::class)->only(['index', 'show']);