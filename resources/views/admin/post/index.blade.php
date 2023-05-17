@extends('layouts.master2')
@section('title', 'Blog | Autocruze')
@section('content')
<div class="container-fluid py-5">

    <!-- start page title -->
    <div class="row py-5">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Blog Section</h4>

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
        <div class="col-4">
            <div class="page-title-box d-flex align-items-center">
                <a class="mb-0 btn btn-primary waves-effect waves-light ms-2" data-bs-toggle="modal" data-bs-target="#modalCenter">
                   Add New Blog
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        @forelse ($post as $blogs)
            <div class="col-lg-4">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{ asset('storage/post/'.$blogs->image) }}" alt="Card image cap">
                    <div class="card-body">
                        <div class="d-flex justify-content-between py-3">
                            <div>
                                <span>Category</span>
                                @forelse ($categories as $item)
                                    <span class="badge bg-primary me-1">{{ $item->name }}</span>
                                    @empty
                                <h6>No Tag</h6>
                            @endforelse
                            </div>
                            <div>
                                <span>Tag</span>
                                @forelse ($blogs->tag as $tags)
                                    <h6 class="badge bg-primary me-1">{{ $tags->name }}</h6>
                                @empty
                                    <h6>No Tag</h6>
                                @endforelse
                            </div>
                        </div>
                        <p class="card-text">
                            <small class="text-muted">{{ $blogs->author }}</small>
                        </p>
                        <h3 class="" style="line-height: 25px;">{{  $blogs->title  }}</h3>
                        <p class="card-text">{!! html_entity_decode($blogs->description)  !!}</p>
                        <div class="d-flex">
                            <a class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#modalTop{{ $blogs->id }}" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="" href="javascript:void(0);">
                            <form action="{{ route('admin.blog.destroy', $blogs->id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="ms-2 btn btn-primary waves-effect waves-light" onclick="return confirm('Are you sure?');"><i class=" fa fa-trash me-1"></i>Delete</button>
                            </form>
                        </a>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
                @include('admin.post.edit')
            </div><!-- end col -->

        @empty
        <h2 class="p-2">No Items</h2>

    @endforelse
    </div>

    @include('admin.post.create')
</div> <!-- container-fluid -->

@endsection
