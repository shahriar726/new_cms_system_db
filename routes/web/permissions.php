<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('admin/permissions',[App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
Route::post('admin/permissions',[App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
Route::delete('admin/permissions/{permission}/destroy',[App\Http\Controllers\PermissionController::class, 'destroy'])->name('permissions.destroy');
Route::get('admin/permissions/{permission}/edit',[App\Http\Controllers\PermissionController::class, 'edit'])->name('permissions.edit');
Route::put('admin/permissions/{permission}/update',[App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');
Route::delete('admin/permissions/{permission}/delete',[App\Http\Controllers\PermissionController::class, 'delete'])->name('permissions.delete');
