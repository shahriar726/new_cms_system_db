<x-admin-master>
    @section('content')

    @if(count($comments) > 0)
            <h1>All Comments</h1>
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
                                        @foreach($comments as $comment)
                                        <tr>
                                            <td>{{$comment->id}}</td>
                                            <td>{{$comment->author}}</td>
                                            <td>{{$comment->email}}</td>
                                            <td>{{Str::limit($comment->body,'20','...')}}</td>
                                            <td><a href="{{route('post',$comment->post->id)}}">View Post</a></td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
        @else
        <h1 class="text-center">No Comments</h1>
        @endif

        @endsection
</x-admin-master>
