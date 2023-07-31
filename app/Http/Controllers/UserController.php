<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function GuzzleHttp\Promise\all;

class UserController extends Controller
{

    public function index(){
        $users=User::all();
        return view('admin.users.index',compact('users'));
    }
    public function create(User $user){
        $roles=Role::all();
        return view('admin.users.create',compact('roles','user'));
    }
    public function store(Request $request,User $user){
            $inputs= \request()->validate([

            'username'=>['required','string','max:255','alpha_dash'],
            'name'=>['required','string','min:3','max:255'],
            'email'=>['required','email','max:255'],
            'password'=>['max:255','min:6','confirmed'],
        ]);
        $user->create($inputs);
        session()->flash('user-created','User has been created'. $user->name);
        return back();
    }

    public function show(User $user){
        $roles=Role::all();
        $permissions = Permission::all();
        return view('admin.users.profile',compact('user','roles','permissions'));
    }
    public function update(User $user){
        $inputs= \request()->validate([
            'username'=>['required','string','max:255','alpha_dash'],
            'name'=>['required','string','min:3','max:255'],
            'email'=>['required','email','max:255'],
            'avatar'=>['file'],
        ]);
        if (\request('avatar')){
            $path=$inputs['avatar']=\request('avatar')->store('images');
            $inputs['avatar']='/storage/' . $path;
        }
        $user->update($inputs);
        return back();

    }
    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('message', 'Role exists.');
        }

        $user->assignRole($request->role);
        return back()->with('message', 'Role assigned.');
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'Role removed.');
        }

        return back()->with('message', 'Role not exists.');
    }

    public function givePermission(Request $request, User $user)
    {
        if ($user->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission exists.');
        }
        $user->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission does not exists.');
    }

    public function destroy(User $user)
    {
        if ($user->hasRole('admin')) {
            return back()->with('message', 'you are admin.');
        }
        $user->delete();

        return back()->with('message', 'User deleted.');
    }


}
