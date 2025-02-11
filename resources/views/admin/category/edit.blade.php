@extends('admin.master')

@section('title' , 'Category')

@section('content')
<div class="container ">
    <div class="row">
        <div class="col-md-6 col-lg-12">
              <form method="post" action="{{route('update.category' , $category->id)}}"  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{$category->name}}">
                    </div>
                    @error('name')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                          </div>
                    @enderror
                    <div class="mb-3">
                    <label for="image" class="form-label">Category Image</label>
                    <input type="file" name="image" class="form-control" id="image" >   
                    <img style="width:200px;" src="{{asset('storage/' . $category->image)}}" alt="">
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