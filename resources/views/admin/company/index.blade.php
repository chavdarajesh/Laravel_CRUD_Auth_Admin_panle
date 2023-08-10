@extends('admin.layouts.main')
@section('title', 'Company List')
@section('content')
@php use App\Models\Front\Payment; @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="card-header justify-content-between d-flex">
            <div class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Company /</span> All Companies</div>
            <div><a href="{{route('admin.add.company')}}" class="btn btn-primary add-btn">Add New Company</a></div>
        </h5>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">All companies</h5>
                    <div class="table-responsive text-nowrap p-3">
                        <table class="table table-hover " id="example">
                            <thead>
                                <tr>
                                    <th class="text-center" >ID</th>
                                    <th class="text-center" >Name</th>
                                    <th class="text-center" >Email</th>
                                    <th class="text-center" >logo</th>
                                    <th class="text-center" >website</th>
                                    <th class="text-center" >Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($companies as $item)
                                    <tr>
                                        <td class="text-center"><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $item->id }}</strong>
                                        </td>
                                        <td class="text-center" >{{ $item->name }}</td>
                                        <td class="text-center" >{{ $item->email }}</td>
                                        <td class="text-center" > @if ($item->logo)
                                            <img src="{{ asset($item->logo) }}" width="60px" alt="Company Logo" class="logo">
                                        @else
                                            No Logo
                                        @endif</td>
                                        <td class="text-center">{{ $item->website }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.edit.company', $item->id) }}"> <button
                                                    type="button" class="btn btn-success">Edit</button></a>
                                                    <a href="{{ route('admin.view.company', $item->id) }}"> <button
                                                        type="button" class="btn btn-primary">View</button></a>

                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#item-delete-modal-{{ $item->id }}">
                                                Delete
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="item-delete-modal-{{ $item->id }}"
                                                tabindex="-1" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalCenterTitle">Delete Item
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('admin.delete.company', $item->id) }}"
                                                                method="post">
                                                                <h3>Do You Want To Really Delete This Item?</h3>
                                                                @csrf
                                                                @method('DELETE')
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                            {{ $companies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop