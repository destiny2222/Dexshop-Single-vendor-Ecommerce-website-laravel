<!-- Small Modal -->
<div class="modal fade" id="small{{ $tagger->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content ">
            
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Edit Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('routes.update', $tagger->id ) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="nameSmall" class="form-label">Location</label>
                            <input type="text" value="{{ $tagger->location }}" id="nameSmall" name="location" class="form-control  @error('location') is-invalid @enderror" placeholder="" />
                            @error('location')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="nameSmall" class="form-label">Pickup Point</label>
                            <input type="text" value="{{ $tagger->pick_up_point }}" id="nameSmall" name="pick_up_point" class="form-control  @error('pick_up_point') is-invalid @enderror" placeholder="" />
                            @error('pick_up_point')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="nameSmall" class="form-label">Price</label>
                            <input type="text" value="{{ $tagger->price }}" id="nameSmall" name="price" class="form-control  @error('price') is-invalid @enderror" placeholder="" />
                            @error('price')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="nameSmall" class="form-label">Dropoff Point</label>
                            <input type="text" value="{{ $tagger->drop_off_point }}" id="nameSmall" name="drop_off_point" class="form-control  @error('drop_off_point') is-invalid @enderror" placeholder="" />
                            @error('drop_off_point')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <div class="input-group">
                                <input type="file" value="{{ $tagger->image }}" name="image" class="form-control  @error('image') is-invalid @enderror" id="inputGroupFile01" />
                                @error('image')
                                    <span class="invalid-feedback" role="alert">{{  $message  }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 text-center">
                        <div class="col mb-0">
                            <input type="submit" class="btn btn-primary" id="emailSmall" value="Update" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
