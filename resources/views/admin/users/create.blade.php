<x-admin-master>
    @section('content')
        @if(session('user-created'))
            <div class="alert alert-success">
                {{session('user-created')}}
            </div>
        @endif

            <h1>change with {{auth()->user()->name}}</h1>
        <div class="row">
            <div class="col-sm-12">
                <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text"
                               name="username"
                               class="form-control @error('username') is-invalid @enderror"
                               id="username"
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
                        <div class="form-group">
                                {!! Form::label('status','status:') !!}
                                {!! Form::select('status' , array(1=>'active',0=>'not active'), 0 ,['class'=>'form-control']) !!}
                            </div>
                    @error('password_confirmation')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Create User</button>
                </form>
            </div>
        </div>

        @include('admin.includes.error_form')
        @endsection
</x-admin-master>
