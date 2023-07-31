{{--<x-home-master>--}}



{{--@section('content')--}}
{{--        <h1 class="my-4">Page Heading--}}
{{--            <small>Secondary Text</small>--}}
{{--        </h1>--}}

{{--        <!-- Blog Post -->--}}
{{--     @foreach($posts as $post)--}}
{{--        <div class="card mb-4">--}}
{{--            <img class="card-img-top" src="{{$post->post_image}}" alt="Card image cap">--}}
{{--            <div class="card-body">--}}
{{--                <h2 class="card-title">{{$post->title}}</h2>--}}
{{--                <p class="card-text"> {{ Str::limit($post->body,'50','.....')}}</p>--}}
{{--                <p class="card-text"> {!! Str::limit($post->body)!!}</p>--}}
{{--                <a href="{{route('post',$post->id)}}" class="btn btn-primary">Read More &rarr;</a>--}}
{{--            </div>--}}
{{--            <div class="card-footer text-muted">--}}
{{--                Posted on {{$post->created_at->diffForHumans()}}--}}
{{--                <a href="#">Start Bootstrap</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        @endforeach--}}



{{--    @endsection--}}



{{--</x-home-master>--}}
<x-home-master>
@section('content')

    <!-- Title -->
    @foreach($posts as $post)
        <h1 class="mt-4">{{$post->title}}</h1>

        <!-- Author -->
        <p class="lead">
            by
            <a href="#">{{$post->name}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on {{$post->created_at->diffForHumans()}}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{$post->post_image}}" alt="">
            <hr>

        <!-- Post Content -->
                            <p class="card-text">{{Str::limit($post->body,'0','click to show')}}</p>
        <a href="{{route('post',$post->id)}}" class="btn btn-primary">Read More &rarr;</a>
        <hr>
            <!-- Pagination -->


        @endforeach
        <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
                <a class="page-link" href="#">&larr; Older</a>
            </li>
            <li class="page-item disabled">
                <a class="page-link" href="#">Newer &rarr;</a>
            </li>
        </ul>
    @endsection
        @section('category')
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        @foreach($categories as $category)
                        <ul class="list-unstyled mb-0">
                            <li>

                                <a href="{{route('post',$post->id)}}">{{$category->name}}</a>
                            </li>
                        </ul>
                        @endforeach
                    </div>

                </div>
            </div>

        @endsection


</x-home-master>

