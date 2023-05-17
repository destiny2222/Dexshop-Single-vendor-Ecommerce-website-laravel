@extends('layouts.master2')
@section('page-title', 'Category List')
@section('content')
  <!-- start page title -->
  <div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#smallModal">
              Add Category
            </h4>

            {{-- <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);" >Tables</a></li>
                    <li class="breadcrumb-item active">Ta Table</li>
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

                  <div class="table-responsive">
                      <table class="table table-editable table-nowrap align-middle table-edits">
                          <thead>
                              <tr>
                                  <th>Id</th>
                                  <th>Name</th>
                                  <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($categories as $tagger)
                                <tr>
                                  <td><strong>{{ $loop->index + 1 }}</strong></td>
                                  <td><strong>{{  $tagger->name }}</strong></td>
                                  <td>
                                    <div class="d-flex align-items-center">
                                      <a class=" btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                      data-bs-target="#small{{ $tagger->id }}" title="Edit">
                                              <i class="fas fa-edit"></i>
                                          </a>
                                      {{-- <a class="dropdown-item" href="javascript:void(0);"> --}}
                                        <form action="{{ route('admin.categories.destroy',$tagger->id) }}" method="POST">
                                          @csrf
                                          @method('delete')
                                          <button class="ms-2 btn btn-primary waves-effect waves-light" onclick="return confirm('Are you sure?');"><i class="fa fa-trash me-1"></i>Delete</button>
                                        </form>
                                      {{-- </a> --}}
                                    </div>
                                </td>
                                </tr>
                                @include('admin.postcategory.edit')
                            @endforeach
                          </tbody>
                          </table>
                  </div>

              </div>
          </div>
      </div> <!-- end col -->
  </div> <!-- end row -->

<!-- / Content -->

@include('admin.postcategory.create')

@endsection


