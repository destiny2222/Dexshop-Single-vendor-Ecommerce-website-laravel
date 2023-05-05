
<!-- Small Modal -->
<div class="modal fade" id="small{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content ">
            
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Edit </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('partners.update', $item->id ) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col mb-3">
                            <div class="input-group">
                                <input type="file" value="{{ $item->image }}" name="image" class="form-control  @error('image') is-invalid @enderror" id="inputGroupFile01" />
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
