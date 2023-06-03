    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Add Wallet Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.usermanagement.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">{{ __('Name') }}</label>
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" id="basic-default-fullname"
                                placeholder="Name" />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">{{ __('Last Name') }}</label>
                            <input type="text" name="last_name"
                                class="form-control @error('last_name') is-invalid @enderror" id="basic-default-fullname"
                                placeholder="Last Name" />
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">{{ __('Email') }}</label>
                            <input type="text" name="email"
                                class="form-control @error('email') is-invalid @enderror" id="basic-default-fullname"
                                placeholder="Email  address" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">{{ __('Amount') }}</label>
                            <input type="text" name="amount"
                                class="form-control @error('amount') is-invalid @enderror" id="basic-default-fullname"
                                placeholder="Amount" />
                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload Popfile Image</label>
                            <input class="form-control" name="image" type="file" id="formFile" />
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                          </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">{{ __('Net balance') }}</label>
                            <input type="text" name="net_balance"
                                class="form-control @error('net_balance') is-invalid @enderror" id="basic-default-fullname"
                                placeholder="Net balance" />
                            @error('net_balance')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">{{ __('Capital') }}</label>
                            <input type="text" name="capital"
                                class="form-control @error('capital') is-invalid @enderror" id="basic-default-fullname"
                                placeholder="Capital" />
                            @error('capital')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">{{ __('Currency') }}</label>
                            <input type="text" name="currency"
                                class="form-control @error('currency') is-invalid @enderror" id="basic-default-fullname"
                                placeholder="Currency" />
                            @error('currency')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">{{ __('Profit') }}</label>
                            <input type="text" name="profit"
                                class="form-control @error('profit') is-invalid @enderror" id="basic-default-fullname"
                                placeholder="Profit" />
                            @error('profit')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        
                        {{-- <div class="mb-3">
                            <label class="form-label" for="basic-default-message">{{ __(' Wallet Address ') }}</label>
                            <textarea id="basic-default-message" id="summary-body" name="address" class="form-control"
                                placeholder="Wallet Address"></textarea>
                        </div> --}}
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary ">{{ __(' Save ') }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>