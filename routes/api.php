<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\LovController;
use App\Http\Controllers\Api\UserController;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // Admin only routes
    Route::middleware(['check.permission:users.manage'])->group(function () {
        Route::apiResource('users', UserController::class)->except(['create', 'edit']);
    });

    // LOV Endpoints
    Route::prefix('lov')->group(function () {
        Route::get('/provinces', [LovController::class, 'getProvinces']);
        Route::get('/cities/{province_code}', [LovController::class, 'getCities']);
        Route::get('/districts/{city_code}', [LovController::class, 'getDistricts']);
        Route::get('/villages/{district_code}', [LovController::class, 'getVillages']);
        Route::get('/products', [LovController::class, 'getProducts']);
    });

    // Leads Endpoints
    Route::prefix('leads')->group(function () {
        Route::post('/', [LeadController::class, 'store'])->middleware('check.permission:leads.create');
        Route::get('/', [LeadController::class, 'index']);
        Route::get('/{id}', [LeadController::class, 'show'])->middleware('check.lead.ownership:view');
        Route::put('/{id}', [LeadController::class, 'update'])->middleware(['check.lead.ownership:update', 'check.permission:leads.update.own']);
        Route::delete('/{id}', [LeadController::class, 'destroy'])->middleware(['check.lead.ownership:delete', 'check.permission:leads.delete.own', 'check.converted']);
        Route::put('/{id}/status', [LeadController::class, 'updateStatus'])->middleware(['check.lead.ownership:update', 'check.permission:leads.update.own']);
        Route::put('/{id}/info', [LeadController::class, 'updateInfo'])->middleware(['check.lead.ownership:update', 'check.permission:leads.update.own']);
    });
    
});