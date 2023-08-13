@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    All Category
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
                            <th scope="col">Category Name</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ( $categories as $category )
                            <tr>
                                <th scope="row">{{ $categories->firstItem()+$loop->index}}</th>
                                <td>{{$category->category_name}}</td>
                                <td>{{$category->user->name}}</td>
                                <td>
                                    @if($category->created_at == NULL)
                                    <span class="text-danger">NO Time Set</span>
                                    @else
                                    {{$category->created_at->diffForHumans()}}
                                    @endif
                                </td>
                                <td><a href="{{ url('Category/Edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                              </tr>
                            @endforeach

                        </tbody>
                      </table>
                    {{-- add table end --}}
                    {{-- paginaction  --}}
                    {{ $categories->links() }}
                    {{-- paginaction  --}}

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                     <a class="btn float-end btn-warning" href="">Create</a>
                    </div>

                <div class="card-body">

                    {{-- form start  --}}

                    <form action="{{route('store.category')}}" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Name </label>
                          <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Category" >

                            @error('category_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                      </form>
                    {{-- form end --}}


                </div>
            </div>
        </div>
        {{-- trast start  --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Trash List
                </div>

                <div class="card-body">
                    {{-- add table start  --}}
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">SI NO</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ( $trashCategories as $trashCAtegory )
                            <tr>
                                <th scope="row">{{ $trashCategories->firstItem()+$loop->index}}</th>
                                <td>{{$trashCAtegory->category_name}}</td>
                                <td>{{$trashCAtegory->user->name}}</td>
                                <td>
                                    @if($trashCAtegory->created_at == NULL)
                                    <span class="text-danger">NO Time Set</span>
                                    @else
                                    {{$trashCAtegory->created_at->diffForHumans()}}
                                    @endif
                                </td>
                                <td>
                                <a href="{{ url('Category/restore/'.$trashCAtegory->id) }}" class="btn btn-info">Restore</a>
                                <a href="{{ url('pdelete/category/'.$trashCAtegory->id) }}" class="btn btn-danger">P-Delete</a>
                                </td>
                              </tr>
                            @endforeach

                        </tbody>
                      </table>
                    {{-- add table end --}}
                    {{-- paginaction  --}}
                    {{ $trashCategories->links() }}
                    {{-- paginaction  --}}

                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
        {{-- trast end --}}
    </div>
</div>
@endsection
