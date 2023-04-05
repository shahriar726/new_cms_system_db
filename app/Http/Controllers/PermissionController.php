<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    //
    public function index(){

        return view('admin.permissions.index',['permissions'=>Permission::all()]);
    }
    public function store(){
        request()->validate([
            'name'=>'required',
        ]);
        Permission::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-'),
        ]);
        return back();
    }

    public function edit(Permission $permission){

        return view('admin.permissions.edit',['permission'=>$permission,'permissions'=>Permission::all()]);

    }
    public function update(Permission $permission){
        $permission->name=Str::ucfirst(request('name'));
        $permission->slug=Str::of(Str::lower(request('name')))->slug('-');
        if ($permission->isDirty('name')){
            //age chizi bara update darim in session ro neshoon bede
            session()->flash('permission-updated','Permission Updated :'.$permission->name);
            $permission->save();
        }else{
            //age update nakardim chizi vase update pas nadarim session ro avaz mikonim
            session()->flash('permission-updated','Nothing to Updated');

        }
        return back();
//            return redirect('admin.roles.index');
    }
    public function destroy(Permission $permission){
        $permission->delete();
        session()->flash('permission-deleted','Deleted Permission was successfully'.$permission->name);
        return back();
    }
    public  function  delete(Permission $permission){
        $permission->delete();
        session()->flash('permission-deleted','Deleted Permission was successfully'.$permission->name);
        return redirect('/admin/permissions');
    }


}
