@extends('layouts.master2')
@section('title', 'Blog | Ecommerce')
@section('content')


    <div class="container-fluid ">

        <!-- start page title -->
        <div class="row ">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Products</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item btn btn-primary waves-effect waves-light">
                                <a href="{{  route('admin.product.create')  }}" class="text-white">Create new product</a>
                            </li>
                            {{-- <li class="breadcrumb-item active">Products</li> --}}
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-header bg-transparent border-bottom">
                        <h5 class="mb-0">Filters</h5>
                    </div>

                    <div class="p-4">
                        <h5 class="font-size-14 mb-3">Categories</h5>
                        <div class="custom-accordion">
                            @foreach ($categories as $category)
                                <a class="text-body fw-semibold pb-2 d-block" data-bs-toggle="collapse" href="#categories-collapse" role="button" aria-expanded="false" aria-controls="categories-collapse">
                                    <i class="mdi mdi-chevron-up accor-down-icon text-primary me-1"></i> {{ $category->name }}
                                </a>
                                @if(count($category->subcategories) > 0)
                                <div class="collapse show" id="categories-collapse">
                                    <div class="card p-2 border shadow-none">

                                        <ul class="list-unstyled categories-list mb-0">
                                            @foreach($category->subcategories as $subcategory)
                                            <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>{{ $subcategory->name }}</a></li>
                                            @endforeach
                                        </ul>

                                    </div>
                                </div>
                                @endif
                            @endforeach


                        </div>

                    </div>



                </div>
            </div>

            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div>
                                        <h5>Showing result for "Shoes"</h5>
                                        <ol class="breadcrumb p-0 bg-transparent mb-2">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Footwear</a></li>
                                            <li class="breadcrumb-item active">Shoes</li>
                                        </ol>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-inline float-md-end">
                                        <div class="search-box ms-2">
                                            <div class="position-relative">
                                                <input type="text" class="form-control bg-light border-light rounded" placeholder="Search...">
                                                <i class="mdi mdi-magnify search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                @foreach ($product as $item)
                                    <div class="col-xl-4 col-sm-6">
                                        <div class="product-box">
                                            <div class="product-img pt-4 px-4">
                                                <div class="product-ribbon">
                                                    <form action="{{ route('admin.product.destroy', $item->id) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="ms-2 btn btn-danger waves-effect waves-light" onclick="return confirm('Are you sure?');"><i class=" fa fa-trash me-1"></i>Delete</button>
                                                    </form>
                                                </div>
                                                <div class="product-wishlist">
                                                    {{-- <a href="#">
                                                        <i class="mdi mdi-heart-outline"></i>
                                                    </a> --}}
                                                </div>
                                                <img src="{{ asset('storage/product/'.$item->image ) }}" alt="" class="img-fluid mx-auto d-block">
                                            </div>

                                            <div class="text-center product-content px-4 pt-5 pb-4">

                                                <h5 class="mb-1"><a href="#" class="text-dark">{{  $item->name }}</a></h5>
                                                <p class="text-muted font-size-13">{{ $item->subcategory->name }}</p>

                                                <h5 class="mt-3 mb-0">
                                                    <span class="text-muted me-2">
                                                        <del>${{ $item->price  }}</del>
                                                    </span>
                                                    ${{  $item->discount }}
                                                </h5>
                                                <ul class="list-inline mb-0 text-muted product-color">
                                                    <li class="list-inline-item text-center icon-demo-content" data-bs-toggle="modal" data-bs-target="#modalTop{{ $item->id }}">
                                                        <i class="uil-edit"></i>
                                                    </li>

                                                </ul>
                                            </div>

                                        </div>
                                        @include('admin.product.edit')
                                    </div>

                                @endforeach
                            </div>
                            <!-- end row -->

                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <div>
                                        <p class="mb-sm-0">Page 2 of 84</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-sm-end">
                                        <ul class="pagination pagination-rounded mb-sm-0">
                                            <li class="page-item disabled">
                                                <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">1</a>
                                            </li>
                                            <li class="page-item active">
                                                <a href="#" class="page-link">2</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">3</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">4</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">5</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->

@endsection
