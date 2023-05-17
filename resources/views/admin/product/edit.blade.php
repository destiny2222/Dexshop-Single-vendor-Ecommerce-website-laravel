
<div class="modal fade" id="modalTop{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">{{ __('Edit Product') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.product.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label" for="basic-default-fullname">{{ __('Product Name') }}</label>
                            <input type="text" value="{{ $item->name }}" name="name" class="form-control @error('name') is-invalid @enderror" id="basic-default-fullname" placeholder="Product Name" />
                            @error('name')
                              <span class="invalid-feedback" role="alert">
                                 {{ $message }}
                              </span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="basic-default-company">{{  __('Product Price') }}</label>
                            <input type="text" value="{{ $item->price }}"  name="price" class="form-control  @error('price') is-invalid @enderror" id="basic-default-company" placeholder="Product Price" />
                            @error('price')
                            <span class="invalid-feedback" role="alert">{{  $message  }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="basic-default-company">{{  __('Product Discount') }}</label>
                            <input type="text" value="{{ $item->discount }}"  name="discount" class="form-control  @error('discount') is-invalid @enderror" id="basic-default-company" placeholder="Product Discount" />
                            @error('discount')
                            <span class="invalid-feedback" role="alert">{{  $message  }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-control  @error('subcategory_id') is-invalid @enderror" name="subcategory_id">
                                @foreach ($product as $sub)
                                   <option value="{{ $sub->subCategory->id }}" {{ old('subcategory_id') == $sub->subCategory->id ? 'selected' : '' }}>{{ $sub->subCategory->name }}</option>
                                @endforeach
                            </select>
                            @error('subcategory_id')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="form-label">Is Featured</label>
                            <div class="col-lg-12">
                                <select name="is_featured" class="form-control  ">
                                    <option>Select</option>
                                    <option value="0" {{ $item->is_featured == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ $item->is_featured == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="form-label">Badges (option)</label>
                            <div class="col-lg-12">
                                <select name="badge" class="form-control  ">
                                    <option value="new" {{ $item->badge == 1 ? 'selected' : '' }}>New</option>
                                    <option value="sale" {{ $item->badge == 2 ? 'selected' : '' }}>Sale</option>
                                </select>
                            </div>
                            @error('badge')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label class="form-label">Status (option)</label>
                            <div class="col-lg-12">
                                <select name="status" class="form-control  ">
                                    <option value="instock" {{ $item->status == 1 ? 'selected' : '' }}>In Stock</option>
                                    <option value="outstock" {{ $item->status == 2 ? 'selected' : '' }}>Out Stock</option>
                                </select>
                            </div>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <div class="input-group">
                                <input type="file" value="{{ $item->cover_image }}" name="image" class="form-control  @error('cover_image') is-invalid @enderror" id="inputGroupFile01" />
                                @error('cover_image')
                                    <span class="invalid-feedback" role="alert">{{  $message  }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="basic-default-message">{{ __(' Message ') }}</label>
                            <textarea  id="body" name="body" class="form-control">{!! html_entity_decode($item->body) !!}</textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="basic-default-message">{{ __(' Specifications ') }}</label>
                            <textarea  id="editor" name="specification" class="form-control">{!! html_entity_decode($item->specification) !!}</textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="basic-default-message">{{ __(' Keyfeatures ') }}</label>
                            <textarea  id="editors" name="keyfeature" class="form-control">{!! html_entity_decode($item->keyfeature) !!}</textarea>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0 text-center">
                            <input type="submit" class="btn btn-primary btn-sm w-100" value="Save Change">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

        <!-- App js -->
{{-- @include('layouts.script') --}}
