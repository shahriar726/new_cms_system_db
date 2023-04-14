<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        return view('admin.users.profile',compact('user','roles'));
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
    public function destroy(User $user)
    {
        $this->authorize('delete',$user);
        $user->delete();
        session()->flash('user-deleted','User has been deleted');
        return back();


    }
    public function attach(User $user){
        $user->roles()->attach(\request('role'));
        return back();
    }
    public function detach(User $user){
        $user->roles()->detach(\request('role'));
        return back();
    }


}
