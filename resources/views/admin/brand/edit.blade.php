@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                     <a class="btn float-end btn-warning" href="">Update Brand</a>
                    </div>

                <div class="card-body">

                    {{-- form start  --}}

                    <form action="{{ url('store/brand/'.$brand->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >
                        @csrf
                        <input type="hidden" name="old_img" value="{{$brand->brand_image}}">
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Name </label>
                          <input type="text" name="brand_name" class="form-control @error('brand_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $brand->brand_name }}" >

                            @error('brand_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">insert image </label>
                            <input type="file" name="brand_image" class="form-control @error('brand_image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                             value="{{$brand->brand_name}}">

                              @error('brand_image')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="form-group pb-2">
                            <img src="{{ asset($brand->brand_image) }}" height="60px" width="150px" >
                            <br>

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
