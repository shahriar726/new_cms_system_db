<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/admin/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
Route::post('/admin/categories', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
Route::get('/admin/categories/{category}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
Route::delete('/admin/categories/{category}/destroy', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.destroy');
Route::patch('/admin/categories/{category}/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');

