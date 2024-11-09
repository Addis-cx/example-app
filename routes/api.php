<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\studentsController;
use App\Http\Controllers\Api\teachersController;

// CRUD Students
Route::get('/students', [studentsController::class, 'index']);

Route::get('/students/{id}', [studentsController::class, 'show']);

Route::post('/students', [studentsController::class, 'store']);

Route::put('/students/{id}',[studentsController::class, 'update']);

Route::patch('/students/{id}',[studentsController::class, 'updatePartial']);

Route::delete('/students/{id}', [studentsController::class, 'destroy']);
// end CRUD Students

// CRUD Teachers
Route::get('/teachers', [teachersController::class, 'index']);

Route::get('/teachers/{id}', [teachersController::class, 'show']);

Route::post('/teachers', [teachersController::class, 'store']);

Route::put('/teachers/{id}',[teachersController::class, 'update']);

Route::patch('/teachers/{id}',[teachersController::class, 'updatePartial']);

Route::delete('/teachers/{id}', [studentsController::class, 'destroy']);
// end CRUD Teachers