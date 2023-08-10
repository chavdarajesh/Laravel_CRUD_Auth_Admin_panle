@extends('admin.layouts.main')
@section('title', 'Company Add')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="card-header justify-content-between d-flex">
            <div class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Company /</span> All Companies / Add Company
            </div>
        </h5>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Add New Company </h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="company_form" method="POST" action="{{ route('admin.post.company') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="name" class="form-label">Name*</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                        id="name" name="name" value="{{ old('name') }}" autofocus />
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="email" class="form-label">Email*</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                                        id="email" name="email" value="{{ old('email') }}" autofocus />
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="website" class="form-label">Website*</label>
                                    <input class="form-control @error('website') is-invalid @enderror" type="url"
                                        id="website" name="website" value="{{ old('website') }}" autofocus />
                                    @error('website')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo*</label>
                                    <input class="form-control  @error('logo') is-invalid @enderror" type="file"
                                        accept="image/*" id="logo" name="logo">
                                    @error('logo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <a href="{{ route('admin.get.company') }}" class="btn btn-outline-secondary">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $("#company_form").validate({
                rules: {
                    'name': "required",
                    'email': {
                        required: true,
                        email: true
                    },
                    'website': {
                        required: true,
                        url: true
                    },
                    'logo': "required",
                },
                messages: {
                    'name': "The name field is required.",
                    'referente_mail[]': {
                        required: "The email field is required.",
                        email: "The email is not valid."
                    },
                    'website': {
                        required: "The website field is required.",
                        url: "The url is not valid."
                    },
                    'logo': "The logo field is required.",
                },
                errorClass: 'text-danger',
            });
        });
    </script>
@stop
