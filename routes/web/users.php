<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//-------------------------mitoni admin ham bardari----------------

Route::put('admin/users/{user}/update',[App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');

Route::delete('admin/users/{user}/destroy',[App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

Route::middleware(['role:admin','auth'])->group(function(){
//ma in middleawre ra to route ezafe kardim
    Route::get('admin/users',[App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::put('admin/users/{user}attach',[App\Http\Controllers\UserController::class, 'attach'])->name('user.role.attach');
    Route::put('admin/users/{user}detach',[App\Http\Controllers\UserController::class, 'detach'])->name('user.role.detach');

});
//onaii ke can mitoonan view ro bebinan va user ra bebinan
Route::middleware(['can:view,user'])->group(function(){
    //har ki beone profile khodesha taqqir bede dakhle policy logic ha nveshte shode
    //har Route dige ham mitoni ezafe koni ke faqat admin bebine
    Route::get('admin/users/{user}/profile',[App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');
});
