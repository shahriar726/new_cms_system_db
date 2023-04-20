<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function index(){

        $categories=Category::all();
        return view('admin.categories.index',['categories'=>$categories]);
    }
    public function store(){
        \request()->validate([
            'name'=>'required',

        ]);
        Category::create([
            'name'=>Str::ucfirst(request('name'))
        ]);
        return back();
    }
    public function destroy(Category $category,Post $post){
        auth()->user()->post()->delete($post);
        $category->delete();
        session()->flash('category-deleted','Deleted Category was successfully'.$category->name);
        return back();
    }
    public function edit($id){
        $category=Category::findOrFail($id);

    return    view ('admin.categories.edit',compact('category'));
    }
    public function update(Category $category){
        $category->name=Str::ucfirst(request('name'));
        if ($category->isDirty('name')){
            session()->flash('category-updated','category Updated :'.$category->name);
            $category->save();
        }else{
            session()->flash('category-updated','Nothing to Updated');

        }
        return back();

    }
}
