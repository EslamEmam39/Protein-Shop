@extends('admin.master')

@section('title' , 'All Category')

@section('content')
@if (Session::has('msg'))
   <div class="alert alert-success" role="alert">
    {{Session::get('msg')}}
  </div>
@endif
<table class="table table-striped  table-bordered text-center">
    <thead  >
      <tr>
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">image</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($categories as  $category)
            <tr>
                <th scope="row">{{$category->id}}</th>
                <td>{{$category->name}}</td>
                <td>
                    <img style="width:60px" src="{{asset('storage/' . $category->image)}}" alt="">
                </td>
                <td><a class="btn btn-primary" href="{{route('edit.category', $category->id)}}">Edit</a></td>
                <td>
                  <form action="{{route('destroy.category' , $category->id)}}" method="post">
                    @method('DELETE')
                    @csrf  
                    <button class="btn btn-danger">DELETE</button>
                </form>
              </td>
            </tr>
        @endforeach
  
   
    </tbody>
  </table>
@endsection