<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('admin/roles',[App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
Route::post('admin/roles',[App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
Route::delete('admin/roles/{role}/destroy',[App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
Route::get('admin/roles/{role}/edit',[App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
Route::put('admin/roles/{role}/update',[App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
Route::put('admin/roles/{role}/attach',[App\Http\Controllers\RoleController::class, 'attach_permission'])->name('role.permission.attach');
Route::put('admin/roles/{role}/detach',[App\Http\Controllers\RoleController::class, 'detach_permission'])->name('role.permission.detach');
