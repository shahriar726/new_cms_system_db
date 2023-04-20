<x-admin-master>
    @section('content')
        <div class="row">
            @if(session()->has('category-updated'))
                <div class="alert alert-success">{{session('category-updated')}}</div>
            @endif
            <div class="col-sm-3">
                <form method="post" action="{{route('category.update',$category->id)}}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Name :</label>
                        <input type="text" id="name" name="name" value="{{$category->name}}" class="form-control @error('name') is-invalid @enderror">

                        <div>
                            @error('name')
                            <span><strong class="invalid-feedback">{{$message}}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update Category</button>
                </form>
            </div>

        </div>

    @endsection
</x-admin-master>
