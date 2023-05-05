@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
          <li class="nav-item">
            <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
          </li>
        </ul>
        <div class="card mb-4">
          <h5 class="card-header">Profile Details</h5>
          <!-- Account -->
          <form id="formAccountSettings" method="POST" action="{{ route('edit-profile', $userprofile->id ) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="{{ asset('users/'.$userprofile->image) }}" alt="user-avatar" class="d-block rounded" height="100"
                  width="100" id="uploadedAvatar" />
                <div class="button-wrapper">
                  <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">Upload new photo</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input type="file" id="upload" name="image" class="account-file-input" hidden  />
                  </label>
                </div>
              </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input class="form-control" type="text" id="firstName" name="name" value="{{ $userprofile->name  }}" >
                  </div>
                  {{-- <div class="mb-3 col-md-6">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input class="form-control" type="text" name="lastName" id="lastName" value="Doe" />
                  </div> --}}
                  <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">{{  __('E-mail Address') }}</label>
                    <input class="form-control" type="text" id="email" name="email" value="{{ $userprofile->email  }}" placeholder="john.doe@example.com" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="phoneNumber">{{ __('Phone Number') }}</label>
                    <div class="input-group input-group-merge">
                      {{-- <span class="input-group-text">US (+1)</span> --}}
                      <input type="text" id="phoneNumber" name="phone" class="form-control" value="{{ $userprofile->phone  }}" />
                    </div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="state" class="form-label">{{ __('State') }}</label>
                    <input class="form-control" type="text" id="state" name="state" value="{{ $userprofile->state  }}" />
                  </div>
                </div>
                <div class="mt-2">
                  <button type="submit" class="btn btn-primary me-2">Save changes</button>
                </div>
              
            </div>
          </form>
          <!-- /Account -->
        </div>
        {{-- <div class="card">
          <h5 class="card-header">Delete Account</h5>
          <div class="card-body">
            <div class="mb-3 col-12 mb-0">
              <div class="alert alert-warning">
                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
              </div>
            </div>
            <form id="formAccountDeactivation" onsubmit="return false">
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="accountActivation"
                  id="accountActivation" />
                <label class="form-check-label" for="accountActivation">I confirm my account
                  deactivation</label>
              </div>
              <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
            </form>
          </div>
        </div> --}}
      </div>
    </div>
  </div>
@endsection