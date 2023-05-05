@extends('layouts.master2')
@section('title', 'Partner | Autocruze')
@section('content')
<div class="container-fluid py-5">


<!-- start page title -->
<div class="row pt-5">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Partner </h4>

            {{-- <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">UI Elements</a></li>
                    <li class="breadcrumb-item active">Lightbox</li>
                </ol>
            </div> --}}

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">


    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-0 btn btn-primary waves-effect waves-light ms-2" 
                  data-bs-toggle="modal" data-bs-target="#smallModal">Add New Partners</h4>
                
                <div class="popup-gallery">
                    <div class="row">
                        @forelse ($partner as $item)
                        <div class="col-xl-2 col-md-4 col-6">
                            <div class="mt-4">
                                <a href="{{  asset('storage/partner/'.$item->image) }}" title="Project 1">
                                    <div class="img-fluid">
                                        <img src="{{  asset('storage/partner/'.$item->image) }}" alt="" class="img-fluid d-block">
                                    </div>
                                </a>
                            </div>
                            <div class="d-flex align-items-center pt-3">
                                <a class=" btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target="#small{{ $item->id }}" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                <a class="" href="javascript:void(0);">
                                  <form action="{{ route('partners.destroy', $item->id) }}" method="POST">
                                    @method('delete')
                                    @csrf 
                                    <button class="ms-2 btn btn-primary waves-effect waves-light"><i class="fa fa-trash me-1"></i>Delete</button>
                                  </form>
                                </a>
                            </div>
                            @include('admin.partner.edit')
                        </div>
                        
                        @empty
                            
                        @endforelse
                        
                        
                        
                    </div>
                    
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@include('admin.partner.create')
</div>

@endsection