@extends('layouts.master2')
@section('title', 'Blog Tag | Autocruze')
@section('content')
<div class="container-fluid py-5">

    <!-- start page title -->
    <div class="row my-5">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Blog Tag</h4>

                {{-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Editable Table</li>
                    </ol>
                </div> --}}

            </div>
        </div>
    </div>
    <!-- end page title -->
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#smallModal">Create New Route</h4>

                    <div class="table-responsive">
                        <table class="table table-editable table-nowrap align-middle table-edits">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Location</th>
                                    <th>Price</th>
                                    <th>Pickup Point</th>
                                    <th>Dropoff Point</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($route as $tagger)
                                <tr>
                                  <td><strong>{{ $loop->index + 1 }}</strong></td>
                                  <td><img class="img-fluid" src="{{ asset('storage/route/'.$tagger->image) }}"  width="50" height="50" alt="Card image cap"></td>
                                  <td><strong>{{  $tagger->location }}</strong></td>
                                  <td><strong>&#8358;{{ number_format($tagger->price, 2) }}</strong></td>
                                  <td><strong>{{  $tagger->pick_up_point }}</strong></td>
                                  <td><strong>{{  $tagger->drop_off_point }}</strong></td>
                                  <td>
                                    <div class="d-flex align-items-center">
                                      <a class=" btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                      data-bs-target="#small{{ $tagger->id }}" title="Edit">
                                              <i class="fas fa-edit"></i>
                                          </a>
                                      <a class="" href="javascript:void(0);">
                                        <form action="{{ route('routes.destroy', $tagger->id) }}" method="POST">
                                          @method('delete')
                                          @csrf 
                                          <button class="ms-2 btn btn-primary waves-effect waves-light"><i class="fa fa-trash me-1"></i>Delete</button>
                                        </form>
                                      </a>
                                    </div>
                                </td>
                                </tr>
                                @include('admin.route.edit')
                            @endforeach 
                            </tbody>
                            </table>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    @include('admin.route.create')
</div> <!-- container-fluid -->
@endsection