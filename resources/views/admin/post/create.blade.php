    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Add Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(count($tag) != 0)
                    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">{{ __('Title ') }}</label>
                            <input type="text" name="title"
                                class="form-control @error('title') is-invalid @enderror" id="basic-default-fullname"
                                placeholder="Title" />
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">{{ __('author') }}</label>
                            <input type="text" name="author"
                                class="form-control  @error('author') is-invalid @enderror" id="basic-default-company"
                                placeholder="ACME Inc." />
                            @error('author')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div>
                                <label for="defaultSelect" class="form-label">{{ __('Tag') }}</label>
                                <select id="defaultSelect" name="tag[]" class="form-select ">
                                    @foreach ($tag as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
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
                            <label class="form-label" for="basic-default-message">{{ __(' Message ') }}</label>
                            <textarea  id="body" name="description" class="form-control"
                                placeholder="Hi, Do you have a moment to talk Joe?"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100">{{ __(' Save ') }}</button>
                        </div>

                    </form>
                    @else
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.tags.index') }}" class="btn btn-primary">
                                Create New Tag
                            </a>
                        </div>
                        <div class="card-body">
                            You have not created any tag yet. PLease create one now
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
