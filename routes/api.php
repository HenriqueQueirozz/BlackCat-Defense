<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: *");

use App\Http\Controllers\ZumbisController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\DefenseController;
use App\Http\Controllers\WeaknessController;
use App\Http\Controllers\StrengthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('zumbis', ZumbisController::class)->only(['index', 'show', 'store']);
Route::resource('defenses', DefenseController::class)->only(['index', 'show']);
Route::resource('counterattack', CounterController::class)->only(['index', 'show']);
Route::resource('weaknesses', WeaknessController::class)->only(['index', 'show']);
Route::resource('strength', StrengthController::class)->only(['index', 'show']);