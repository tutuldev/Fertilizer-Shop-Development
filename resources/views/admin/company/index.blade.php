@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    All Company
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
                            <th scope="col">Company Name</th>
                            <th scope="col">Company Image</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ( $companies as $company )
                            <tr>
                                <th scope="row">
                                    {{ $companies->firstItem()+$loop->index}}
                                </th>
                                <td>
                                    {{$company->company_name}}
                                </td>
                                  <td>
                                    <img src="{{ asset($company->company_image) }}" alt="" width="150px" height="50px">
                                </td>

                                <td>
                                    {{$company->user->name}}
                                </td>
                                <td>
                                    @if($company->created_at == NULL)
                                    <span class="text-danger">NO Time Set</span>
                                    @else
                                    {{$company->created_at->diffForHumans()}}
                                    @endif
                                </td>
                                <td>
                                    {{-- <a href="" class="btn btn-info">Edit</a> --}}
                                    <a href="{{ url('Company/Edit/'.$company->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('Company/Delete/'.$company->id) }}" class="btn btn-danger">Delete</a>
                                    {{--
                                    <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a> --}}
                                </td>
                              </tr>
                            @endforeach

                        </tbody>
                      </table>
                    {{-- add table end --}}
                    {{-- paginaction  --}}
                    {{ $companies->links() }}
                    {{-- paginaction  --}}

                </div>
            </div>
        </div>
        {{-- secton 2  --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                     <a class="btn float-end btn-warning" href="">Create</a>
                    </div>

                <div class="card-body">

                    {{-- form start  --}}

                    <form action="{{ route('store.company') }}" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Company Name </label>
                          <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Company Name" >

                            @error('company_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Insert image </label>
                          <input type="file" name="company_image" class="form-control @error('company_image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"  >

                            @error('company_image')
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
