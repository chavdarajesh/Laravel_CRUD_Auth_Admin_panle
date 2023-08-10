@extends('admin.layouts.main')
@section('title', 'Company View')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="card-header justify-content-between d-flex">
            <div class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Company /</span> All Companies / View Company
            </div>
        </h5>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">View Company </h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" type="text" id="name" name="name"
                                    value="{{ $Company->name ? $Company->name : '' }}" readonly />
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control" type="email" id="email" name="email"
                                    value="{{ $Company->email ? $Company->email : '' }}" readonly />
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="website" class="form-label">Website</label>
                                <input class="form-control" type="url" id="website" name="website"
                                    value="{{ $Company->website ? $Company->website : '' }}" readonly />
                            </div>

                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo</label>
                                <div>
                                    <img src="{{ asset($Company->logo) }}" width="100px" alt="">
                                </div>
                            </div>

                            <div class="mt-2">
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
