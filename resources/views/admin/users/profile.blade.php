<x-admin-master>

    @section('content')
            <h1>User Profile For :{{$user->name}}</h1>

            <div class="row">
                <div class="col-sm-12">
                            <form method="post" action="{{route('user.profile.update',$user)}}" enctype="multipart/form-data">
                                    @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <img  class="img-profile rounded-circle" src="{{$user->avatar}}">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="avatar">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text"
                                           name="username"
                                           class="form-control @error('username') is-invalid @enderror"
                                           id="username"
                                           value="{{$user->username}}"
                                    >
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text"
                                                   name="name"
                                       class="form-control  @error('name') is-invalid @enderror"
                                                   id="name"
                                                   value="{{$user->name}}"
                                            >
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        </div>
                                         @enderror
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text"
                                           name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           value="{{$user->email}}"
                                    >
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                </div>

                                @enderror
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password"
                                           name="password"
                                           class="form-control"
                                           id="password"
                                    >
                                </div>
                                @error('password')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label for="password-confirmation">Confirm Password</label>
                                    <input type="password"
                                           name="password_confirmation"
                                           class="form-control"
                                           id="password-confirmation"
                                    >
                                </div>
                                @error('password_confirmation')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                </div>
            </div>
        <div class="row">
        <div class="py-12 w-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                    <div class="flex p-2">
{{--                        <a href="{{ route('admin.users.index') }}"--}}
{{--                           class="px-4 py-2 bg-green-700 hover:bg-green-500 text-slate-100 rounded-md">Users Index</a>--}}
                    </div>
                    <div class="flex flex-col p-2 bg-slate-100">
                        <div>User Name: {{ $user->name }}</div>
                        <div>User Email: {{ $user->email }}</div>
                    </div>
                    <div class="mt-6 p-2 bg-slate-100">
                        <h2 class="text-2xl font-semibold">Roles</h2>
                        <div class="flex space-x-2 mt-4 p-2">
                            @if ($user->roles)
                                @foreach ($user->roles as $user_role)
                                    <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" method="POST"
                                          action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}"
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">{{ $user_role->name }}</button>
                                    </form>
                                @endforeach
                            @endif
                        </div>
                        <div class="max-w-xl mt-6">
                            <form method="POST" action="{{ route('admin.users.roles', $user->id) }}">
                                @csrf
                                <div class="sm:col-span-6">
                                    <label for="role" class="block text-sm font-medium text-gray-700">Roles</label>
                                    <select id="role" name="role" autocomplete="role-name"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('role')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <button type="submit"
                                    class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md btn btn-success">Assign</button>
                        </div>
                        </form>
                    </div>
                    <div class="mt-6 p-2 bg-slate-100">
                        <h2 class="text-2xl font-semibold">Permissions</h2>
                        <div class="flex space-x-2 mt-4 p-2">
                            @if ($user->permissions)
                                @foreach ($user->permissions as $user_permission)
                                    <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md " method="POST"
                                          action="{{ route('admin.users.permissions.revoke', [$user->id, $user_permission->id]) }}"
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">{{ $user_permission->name }}</button>
                                    </form>
                                @endforeach
                            @endif
                        </div>
                        <div class="max-w-xl mt-6">
                            <form method="POST" action="{{ route('admin.users.permissions', $user->id) }}">
                                @csrf
                                <div class="sm:col-span-6">
                                    <label for="permission"
                                           class="block text-sm font-medium text-gray-700">Permission</label>
                                    <select id="permission" name="permission" autocomplete="permission-name"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('name')
                                <span class="text-red-400 text-sm alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <button type="submit"
                                    class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md btn btn-success">Assign</button>
                        </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
        </div>


        @endsection
</x-admin-master>
