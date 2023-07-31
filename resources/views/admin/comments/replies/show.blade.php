<x-admin-master>
    @section('content')

        @if(($replies))
            <h1>All replies</h1>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="users_table" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Email</th>
                                <th>Body</th>
                                <th>View</th>

                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Email</th>
                                <th>Body</th>
                                <th>View</th>

                            </tfoot>
                            <tbody>
                            <tr>
                                @foreach($replies as $reply)
                                    <td>{{$reply->id}}</td>
                                    <td>{{$reply->author}}</td>
                                    <td>{{$reply->email}}</td>
                                    <td>{{Str::limit($reply->body,'20','...')}}</td>
                                    <td><a href="{{route('post',$reply->comment->post->id)}}">View Post</a></td>
                                    <td>
                                        @if($reply->is_active == 1)
                                            {!! Form::open(['method'=>'PATCH', 'action'=>['\App\Http\Controllers\CommnetRepliesController@update',$reply->id]]) !!}
                                            <input type="hidden" name="is_active" value="0">
                                            <div class="form-group">
                                                {!! Form::submit('Un-approve',['class'=>'btn btn-success']) !!}
                                            </div>
                                            {!! Form::close() !!}
                                        @else
                                            {!! Form::open(['method'=>'PATCH', 'action'=>['\App\Http\Controllers\CommnetRepliesController@update',$reply->id]]) !!}
                                            <input type="hidden" name="is_active" value="1">
                                            <div class="form-group">
                                                {!! Form::submit('approve',['class'=>'btn btn-info']) !!}
                                            </div>
                                            {!! Form::close() !!}
                                        @endif
                                    </td>
                                    <td>
                                        {!! Form::open(['method'=>'DELETE', 'action'=>['\App\Http\Controllers\CommnetRepliesController@destroy',$reply->id]]) !!}
                                        <div class="form-group">
                                            {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                            </tr>
                            </tbody>

                            @endforeach
                        </table>
                        @else
                            <h1 class="text-center">No replies</h1>
                    </div>
                </div>
            </div>

        @endif

    @endsection
</x-admin-master>
