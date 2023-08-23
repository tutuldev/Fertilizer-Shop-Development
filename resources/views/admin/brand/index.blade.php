@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    All Brand
                </div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    {{-- add table start  --}}
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">SI NO</th>
                            <th scope="col">Brand Name</th>
                            <th scope="col">Brand Image</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ( $brands as $brand )
                            <tr>
                                <th scope="row">{{ $brands->firstItem()+$loop->index}}</th>
                                <td>{{$brand->brand_name}}</td>
                                {{-- <td>
                                    <img src="img/brand/{{$brand->brand_image}}" style="height:30px; width: 40px;">
                                </td> --}}
                                  {{-- <td><img src="{{ asset('img/brand/' . $brand->brand_image) }}" alt="" width="150px" height="50px"></td> --}}
                                  <td>
                                    <img src="{{ asset($brand->brand_image) }}" alt="" width="150px" height="50px">
                                </td>

                                <td>{{$brand->user->name}}</td>
                                <td>
                                    @if($brand->created_at == NULL)
                                    <span class="text-danger">NO Time Set</span>
                                    @else
                                    {{$brand->created_at->diffForHumans()}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('Brand/Edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('Brand/Delete/'.$brand->id) }}" onclick="return confirm('Are You Sure to Delete')"  class="btn btn-danger">Delete</a>
                                    {{-- <a href="{{ url('Category/Edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a> --}}
                                </td>
                              </tr>
                            @endforeach

                        </tbody>
                      </table>
                    {{-- add table end --}}
                    {{-- paginaction  --}}
                    {{ $brands->links() }}
                    {{-- paginaction  --}}

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Insert Brand
                </div>

                <div class="card-body">

                    {{-- form start  --}}

                    <form action="{{route('store.brand')}}" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Brand Name </label>
                          <input type="text" name="brand_name" class="form-control @error('brand_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Brand Name" >

                            @error('brand_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">insert image </label>
                          <input type="file" name="brand_image" class="form-control @error('brand_image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"  >

                            @error('brand_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                      </form>
                    {{-- form end --}}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
