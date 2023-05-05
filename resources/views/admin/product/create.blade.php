@extends('layouts.master2')
@section('title', 'Blog | Ecommerce')
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Add Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <!-- end page title -->
    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (count($subcategory) != 0)
            <div class="row">
            <div class="col-lg-12">
                <div id="addproduct-accordion" class="custom-accordion">

                        <div class="card">
                            <a href="#addproduct-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
                                <div class="p-4">

                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-xs">
                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                    01
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="font-size-16 mb-1">Billing Info</h5>
                                            <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                        </div>

                                    </div>

                                </div>
                            </a>

                            <div id="addproduct-billinginfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
                                <div class="p-4 border-top">
                                    <!-- <form> -->
                                        <div class="mb-3">
                                            <label class="form-label" for="productname">Product Name</label>
                                            <input id="productname" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your Product Name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="price">Price</label>
                                                    <input id="price" name="price" type="text" class="form-control @error('price') is-invalid @enderror" placeholder="Enter your Price">
                                                </div>
                                                @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="discount">Discount Price</label>
                                                    <input id="discount" name="discount" type="text" class="form-control @error('discount') is-invalid @enderror" placeholder="Enter your Manufacturer Name">
                                                </div>
                                                @error('discount')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label" class="control-label">Category</label>
                                                    <select class="form-control select2 @error('subcategory_id') is-invalid  @enderror" name="subcategory_id">
                                                        <option>Select</option>
                                                        @foreach ($subcategory as $subcategories)
                                                            <option value="{{ $subcategories->id }}" >{{  $subcategories->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('subcategory_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <label class="form-label" for="inputGroupFile01">Product image</label>
                                            <input type="file"  name="image" class="form-control  @error('image') is-invalid @enderror" id="inputGroupFile01" />
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-0">
                                                <label class="form-label" for="productdesc">Product Description</label>
                                                <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="productdesc" rows="4" placeholder="Enter your Product Description"></textarea>
                                                @error('body')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <div class="form-check form-switch form-switch-lg">
                                                    <input type="checkbox" name="status" class="form-check-input" id="customSwitchsizelg" >
                                                    <label class="form-check-label" for="customSwitchsizelg">Large Size Switch</label>
                                                </div>
                                                @error('status')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    <!-- </form>  -->
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row mb-4">
            <div class="col ms-auto">
                <div class="d-flex flex-reverse flex-wrap gap-2">
                    <input type="submit" class="btn btn-success" value="Create Product">
                </div>
            </div> <!-- end col -->
        </div> <!-- end row-->
        @else
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.category.index') }}" class="btn btn-primary">
                        Create New Category
                    </a>
                </div>
                <div class="card-body">
                    You have not created any Category yet. PLease create one now
                </div>
            </div>
        @endif

    </form>
</div> <!-- container-fluid -->
@endsection

<!-- Modal -->
    {{-- <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Add Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(count($categories) != 0)
                    <form >
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">{{ __(' Product Name ') }}</label>
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" id="basic-default-fullname"
                                placeholder="Product Name" />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">{{ __('Product Price') }}</label>
                            <input type="text" name="price"
                                class="form-control  @error('price') is-invalid @enderror" id="basic-default-company"
                                placeholder="Product Price." />
                            @error('price')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">{{ __('Discount Price') }}</label>
                            <input type="text" name="discount"
                                class="form-control  @error('discount') is-invalid @enderror" id="basic-default-company"
                                placeholder="Discount Price." />
                            @error('discount')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div>
                                <label for="defaultSelect" class="form-label">{{ __('Categories') }}</label>
                                <select id="defaultSelect" name="category_id" class="form-select ">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="file" name="image"
                                    class="form-control  @error('image') is-invalid @enderror" id="inputGroupFile01" />
                                @error('image')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-message">{{ __(' Product Description ') }}</label>
                            <textarea  id="body" name="body" class="form-control"
                                placeholder="Hi, Do you have a moment to talk Joe?"></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary ">{{ __(' Save ') }}</button>
                        </div>

                    </form>
                    @else
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.category.index') }}" class="btn btn-primary">
                                Create New Category
                            </a>
                        </div>
                        <div class="card-body">
                            You have not created any Category yet. PLease create one now
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div> --}}


