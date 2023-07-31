<x-home-master>
    @section('content')

        <!-- Title -->
            <h1 class="mt-4">{{$post->title}}</h1>

            <!-- Author -->
            <p class="lead">
                by
                <a href="#">{{$post->user->name}}</a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p>Posted on {{$post->created_at->diffForHumans()}}</p>

            <hr>

            <!-- Preview Image -->
            <img class="img-fluid rounded" src="{{$post->post_image}}" alt="">

            <hr>

            <!-- Post Content -->
                    <p> {!! $post->body!!}</p>
            <hr>
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
{{--            <div id="disqus_thread"></div>--}}
{{--            <script>--}}
{{--                /**--}}
{{--                 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.--}}
{{--                 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */--}}
{{--                /*--}}
{{--                var disqus_config = function () {--}}
{{--                this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable--}}
{{--                this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable--}}
{{--                };--}}
{{--                */--}}
{{--                (function() { // DON'T EDIT BELOW THIS LINE--}}
{{--                    var d = document, s = d.createElement('script');--}}
{{--                    s.src = 'https://new-cms-system-2.disqus.com/embed.js';--}}
{{--                    s.setAttribute('data-timestamp', +new Date());--}}
{{--                    (d.head || d.body).appendChild(s);--}}
{{--                })();--}}
{{--            </script>--}}
{{--            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>--}}
{{--            <script id="dsq-count-scr" src="//new-cms-system-2.disqus.com/count.js" async></script>--}}




        @if(Session::has('comment_massage'))
                <div class="alert alert-success"> {{session('comment_massage')}}</div>

            @endif
            @if(Auth::check())
            <!-- Comments Form -->
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">

                        {!! Form::open(['method'=>'POST', 'action'=>'\App\Http\Controllers\PostCommentsController@store']) !!}
                                {{csrf_field()}}
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                <div class="form-group">
                                    {!! Form::label('title','Body:') !!}
                                    {!! Form::textarea('body', null ,['class'=>'form-control','rows'=>3]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::submit('Submit Comment',['class'=>'btn btn-primary']) !!}
                                </div>
                    {!! Form::close() !!}
                </div>
            </div>
            @endif
            @foreach($comments as $comment)
                @if(count($comments) > 0)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img height="64" class="media-object" src="{{Auth::user()->gravatar}}" alt="">
                        <img height="64" class="media-object" src="{{$comment->avatar}}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->author}}
                            <small>{{$comment->created_at->diffForHumans()}}</small>
                        </h4>
                       <p>{{$comment->body}}</p>
                    </div>
                    @endif
                </div>


                    @if(count($comment->replies) > 0)
                @foreach($comment->replies as $reply)
                        <!-- Comment with nested comments -->
                        @if($reply->is_active ==1)

                <div  id="nested-comment" class=" media" style="margin-top: 20px;margin-left: 20px ">
                    <a class="pull-right" href="#">
                        <img height="64" class="media-object -info-circle" src="{{Auth::user()->gravatar}}" alt="axs">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <small>{{$reply->created_at->diffForHumans()}}</small>
                            {{$reply->author}}
                        </h4>
                      <mark>{{$reply->body}}</mark>
                    </div>



                </div>
                            @endif
                    @endforeach
                    @endif
                    <div   class="comment-reply-container ">
                        <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                    <div class="comment-reply" >

                        {!! Form::open(['method'=>'POST', 'action'=>'\App\Http\Controllers\CommnetRepliesController@createReply']) !!}

                                    <div class="form-group">
                                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                        {!! Form::label('body','body:') !!}
                                        {!! Form::textarea('body', null ,['class'=>'form-control','rows'=>1]) !!}
                                    </div>

                                    <div class="form-group" style="text-align: right" >
                                        {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                             </div>

                    {!! Form::close() !!}
                    </div>
                    </div>


            @endforeach





        @endsection
    @section('scripts')
              <script>
                $(".comment-reply-container .toggle-reply").click(function(){

                $(this).next().slideToggle("slow");

                });

               </script>

        @endsection
</x-home-master>
