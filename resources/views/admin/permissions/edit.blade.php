<x-admin-master>
    @section('content')
        <div class="row">
            <div class="col-sm-6">
                @if(session()->has('permission-updated'))
                    <div class="alert alert-success">{{session('permission-updated')}}</div>
                @endif
                <h1>Edit Role {{$permission->name}}</h1>
                <form method="post" action="{{route('permissions.update',$permission->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{$permission->name}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if($permissions->isNotEmpty())
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="users_table" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Delete</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($permissions as $permission)
                                        <tr>
{{--                                            <td><input type="checkbox"--}}
{{--                                                       @foreach($permission->roles as $permission_role)--}}
{{--                                                       @if($permission_role->slug == $permission->slug)--}}
{{--                                                       checked--}}
{{--                                                    @endif--}}
{{--                                                    @endforeach--}}
{{--                                                ></td>--}}
                                            <td>{{$permission->id}}</td>
                                            <td>{{$permission->name}}</td>
                                            <td>{{$permission->slug}}</td>
                                            <td>
                                                <form action="{{route('permissions.delete',$permission->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" >Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @endsection
</x-admin-master>
