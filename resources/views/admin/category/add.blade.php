@extends('admin.master')

@section('title' , 'Add Category')

@section('content')
<div class="container ">
<div class="row">
    <div class="col-md-6 col-lg-12">
          <form method="post" action="{{route('store.category')}}"  enctype="multipart/form-data">
            @csrf
                <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" id="name" >
                </div>
                @error('name')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                      </div>
                @enderror
                <div class="mb-3">
                <label for="image" class="form-label">Category Image</label>
                <input type="file" name="image" class="form-control" id="image" >   
                </div>
                @error('image')
               <div class="alert alert-danger" role="alert">
                {{$message}}
                  </div>
            @enderror
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>
</div>
</div>
@endsection