<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlansController;

Route::post('/register', [PlansController::class, 'registerBeneficiaries']);

Route::get('/plans', [PlansController::class, 'getPlans']);

Route::get('/price', [PlansController::class, 'getPrice']);
