<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{
//in id ke to home.blade.php dadi miad negah mikone in id male in poste va match mikone ba oon posti ke  mikhahi
    public function show(Post $post){
//      $post=  Post::findOrFail($id);
        return view('blog-post',compact('post'));
    }
    public function create(){
        $this->authorize('create',Post::class);
        $categories=Category::pluck('name','id')->all();
        return view('admin.posts.create',compact('categories'));

    }
    public function store(Request $request){

        $this->authorize('create',Post::class);
//        aval validate mishe bad mire to input
            $inputs=request()->validate([
            'title'=>'required|min:8|max:255',
            'category_id'=>'required',
                'post_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'body'=>'required'
        ]);
        if (request('post_image')){
            //mire mige age post image dar dardastres bood bia befres to file images
           $path= $inputs['post_image']=request('post_image')->store('images');
            $inputs['post_image']='/storage/'. $path;
        }
//        //on useri ke bahash login kardi ra postesho bezar
        auth()->user()->posts()->create($inputs);
        $request->session()->flash('post-create-message','post with title was created  '.$inputs['title']);
        return redirect()->route('post.index');
//        $requestData= $request->all();
//        $filename=time().$request->file('post_image')->getClientOriginalName();
//        $path=$request->file('post_image')->storeAs('images',$filename,'public');
//        $requestData["post_image"] ='/storage/' . $path;
//        auth()->user()->posts()->create($requestData);



    }
    public function index(){
//        $posts=auth()->user()->posts()->paginate(5);
        $posts=Post::all();
        return view('admin.posts.index',compact('posts'));
    }
    public function edit(Post $post){
//        $this->authorize('view',$post);
        //or
//        if (auth()->user()->can('view',$post)){
//
//        }
//ino to url darim dige find shode khodesh
//        $posts=Post::findOrFail($post);
        return view('admin.posts.edit',['post'=>$post]);
    }

    public function destroy(Post $post,Request $request){
        $this->authorize('delete',$post);
        //harkasi nyad har posti ra pak kone har user post khodesha pak kone
//        if (auth()->user()->id !==$post->user_id)
        $post->delete();
//       Session::flash('message','post was deleted');
        //dakhle blade   az in-> Session::get('message')
       //or
        $request->session()->flash('message','post was deleted');
        return back();
        //return back() bar migardae hamoon safe
    }
    public function update(Post $post){
        $inputs=request()->validate([
            'title'=>'required|min:8|max:255',
            'category_id'=>'required',
            'post_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'body'=>'required'
        ]);
        if (request('post_image')) {
            $path = $inputs['post_image'] = request('post_image')->store('images');
            $inputs['post_image'] = '/storage/' . $path;
            $post->post_image =$inputs['post_image'];
        }
        $post->title =$inputs['title'];
        $post->body =$inputs['body'];
        $this->authorize('update',$post);
        auth()->user()->posts()->save($post);
        //or
        //miad hamoon shakhsi ke sakhte ino update mikone
//        $post->save();
        session()->flash('post-updated-message','post with title was updated  '.$inputs['title']);
        return redirect()->route('post.index');
    }

    //
}
