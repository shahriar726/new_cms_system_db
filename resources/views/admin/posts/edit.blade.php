<x-admin-master>
    @section('content')
        <h1>Edit a Post</h1>
        @include('admin.includes.tinyeditor')
        <form method="post" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" id="" aria-describedby=""
                       placeholder="Enter Title" value="{{$post->title}}">
            </div>
            <div class="form-group">
                {!! Form::label('Category','Category:') !!}
                {!! Form::select('category_id' , [''=>'Choose Categories'] + $categories , null ,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <div><img height="100px" src="{{$post->post_image}}" alt=""></div>
                <label for="">File</label>
                <input type="file" name="post_image" class="form-control-file" id="post_image">
            </div>
            <div class="form-group">
                <textarea   name="body"  class="form-control" id="body" cols="30" rows="10">{{$post->body}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        @include('admin.includes.error_form')
    @endsection
</x-admin-master>
