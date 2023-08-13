@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                     <a class="btn float-end btn-warning" href="">Edit Category</a>
                    </div>

                <div class="card-body">

                    {{-- form start  --}}

                    <form action="{{ url('store/category/'.$category->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Name </label>
                          <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $category->category_name }}" >

                            @error('category_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </form>
                    {{-- form end --}}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
