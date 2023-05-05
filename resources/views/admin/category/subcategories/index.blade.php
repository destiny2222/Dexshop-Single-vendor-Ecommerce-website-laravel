@extends('layouts.master2')
@section('title', 'Product Subcategory | ')
@section('content')
<div class="container-fluid py-5">

    <!-- start page title -->
    <div class="row my-5">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Product Subcategory</h4>

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

                    <h4 class="card-title btn btn-primary waves-effect waves-light" 
                    data-bs-toggle="modal" data-bs-target="#small">Create New SubCategory</h4>

                    <div class="table-responsive">
                        <table class="table table-editable table-nowrap align-middle table-edits">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>image</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $tagger)
                                <tr>
                                  <td><strong>{{ $loop->index + 1 }}</strong></td>
                                  <td>
                                    {{-- @if (!empty($tagger->image)) --}}
                                        <img class="" width="40" height="50" src="{{ asset("storage/category/".$tagger['image']) }}" alt="Card image cap" />
                                    {{-- @endif --}}
                                  </td>
                                  <td>
                                    
                                    {{  $tagger['date'] }}
                                  </td>
                                  <td>{{  $tagger['type'] }}</td>
                                  <td><strong>{{  $tagger['name'] }}</strong></td>
                                  
                                  <td>
                                    <div class="d-flex align-items-center">
                                      <a class=" btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                      data-bs-target="#small{{ $tagger['id'] }}" title="Edit">
                                              <i class="fas fa-edit"></i>
                                          </a>
                                      <a class="" href="javascript:void(0);">
                                        <form action="{{ route('admin.delete-subcategory', $tagger['id']) }}" method="POST">
                                          @method('delete')
                                          @csrf 
                                          <button class="ms-2 btn btn-primary waves-effect waves-light" onclick="return confirm('Are you sure?');"><i class="fa fa-trash me-1"></i>Delete</button>
                                        </form>
                                      </a>
                                    </div>
                                </td>
                                </tr>
                                @include('admin.category.subcategories.edit')
                            @endforeach 
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    @include('admin.category.subcategories')
</div> <!-- container-fluid -->
@endsection