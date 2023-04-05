<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    //
    public function index(){

        return view('admin.roles.index',['roles'=>Role::all()]);
    }

    public function edit(Role $role){

        return view('admin.roles.edit',['role'=>$role,'permissions'=>Permission::all()]);

    }

    public function store(){
        \request()->validate([
            'name'=>'required',

        ]);
        Role::create([
            'name'=>Str::ucfirst(request('name')),
            //str::of zamani ke ma mikhahim az in reshte estefade konim request('name')
            'slug'=>Str::of(Str::lower(request('name')))->slug('-'),
        ]);
        return back();
    }
    public function update(Role $role){
            $role->name=Str::ucfirst(request('name'));
            $role->slug=Str::of(Str::lower(request('name')))->slug('-');
        if ($role->isDirty('name')){
            //age chizi bara update darim in session ro neshoon bede
            session()->flash('role-updated','Role Updated :'.$role->name);
            $role->save();
        }else{
            //age update nakardim chizi vase update pas nadarim session ro avaz mikonim
            session()->flash('role-updated','Nothing to Updated');

        }
            return back();
//            return redirect('admin.roles.index');
    }
    public function destroy(Role $role){
        $role->delete();
        session()->flash('role-deleted','Deleted Role was successfully'.$role->name);
        return back();
    }
    public function attach_permission(Role $role){
        $role->permissions()->attach(\request('permission'));
        return back();
    }
    public function detach_permission(Role $role){
        $role->permissions()->detach(\request('permission'));
        return back();
    }

}
