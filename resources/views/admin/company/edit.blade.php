@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                     <a class="btn float-end btn-warning" href="">Update Company</a>
                    </div>

                <div class="card-body">

                    {{-- form start  --}}

                    <form action="{{ url('Store/Company/'.$company->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >
                        @csrf
                        <input type="hidden" name="old_img" value="{{$company->company_image}}">
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Company Name </label>
                          <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $company->company_name }}" >

                            @error('company_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">insert image </label>
                            <input type="file" name="company_image" class="form-control @error('company_image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
                             value="">

                              @error('company_image')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="form-group pb-2">
                            <img src="{{ asset($company->company_image) }}" height="60px" width="150px" >
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
