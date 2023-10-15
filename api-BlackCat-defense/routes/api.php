<?php

use App\Http\Controllers\ZombiesController;
use App\Http\Controllers\ZombiesCounterController;
use App\Http\Controllers\ZombiesDefenseController;
use App\Http\Controllers\ZombiesWeaknessController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('zombies', ZombiesController::class);
Route::resource('defenses', ZombiesDefenseController::class);
Route::resource('counterattack', ZombiesCounterController::class);
Route::resource('weaknesses', ZombiesWeaknessController::class);

Route::post('calculo-atributos/{zombie}', [ZombiesController::class, 'analiseDeAtributos']);
Route::post('calculo-periculosidade/{zombie}', [ZombiesController::class, 'analiseDePericulosidade']);