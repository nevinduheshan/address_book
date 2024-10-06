<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/', [CustomerController::class, 'index'])->name('customers.index');

// Route::resource('projects', ProjectController::class);

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');


