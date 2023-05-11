
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
                                {{-- @foreach ($subcategory as $sub) --}}
                                   <option value="{{ $sub->id }}" {{ old('subcategory_id') == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                                {{-- @endforeach --}}
                            </select>
                            @error('subcategory_id')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <div class="input-group">
                                <input type="file" value="{{ $item->image }}" name="image" class="form-control  @error('image') is-invalid @enderror" id="inputGroupFile01" />
                                @error('image')
                                    <span class="invalid-feedback" role="alert">{{  $message  }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="basic-default-message">{{ __(' Message ') }}</label>
                            <textarea  id="summary" name="body" class="form-control">{{ $item->body }}</textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="basic-default-message">{{ __(' Specifications ') }}</label>
                            <textarea  id="summary" name="editor" class="form-control">{{ $item->specification }}</textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="basic-default-message">{{ __(' Keyfeatures ') }}</label>
                            <textarea  id="summary" name="editors" class="form-control">{{ $item->keyfeature }}</textarea>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0 text-center">
                            <input type="submit" class="btn btn-primary btn-sm" value="Save Change">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

        <!-- App js -->
{{-- @include('layouts.script') --}}
