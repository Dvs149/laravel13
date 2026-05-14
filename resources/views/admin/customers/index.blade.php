@extends('admin.partials.admin_layout')

@section('content')

<div class="nxl-content">

    <!-- Page Header -->
    <div class="page-header">

        <div class="page-header-left d-flex align-items-center">

            <div class="page-header-title">
                <h5 class="m-b-10">Customer</h5>
            </div>

            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">
                        Home
                    </a>
                </li>

                <li class="breadcrumb-item">
                    Customer List
                </li>
            </ul>

        </div>

        <div class="page-header-right ms-auto">

            <a href="{{ route('admin.customers.create') }}"
               class="btn btn-primary">

                <i class="feather-plus me-2"></i>

                <span>Create Customer</span>

            </a>

        </div>

    </div>

    <!-- Success Message -->

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    <!-- Main Content -->

    <div class="main-content">

        <div class="row">

            <div class="col-lg-12">

                <div class="card stretch stretch-full">

                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-hover" id="customerList">

                                <thead>

                                    <tr>

                                        <th width="5%">#</th>

                                        <th>Image</th>

                                        <th>Name</th>

                                        <th>Email</th>

                                        <th>Phone</th>

                                        <th>Address</th>

                                        <th>Created At</th>

                                        <th class="text-end">Actions</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($customers as $customer)

                                        <tr>

                                            <td>
                                                {{ $loop->iteration }}
                                            </td>

                                            <td>

                                                @if($customer->image)

                                                    <div class="avatar-image avatar-md">

                                                        <img
                                                            src="{{ asset('storage/' . $customer->image) }}"
                                                            class="img-fluid rounded-circle"
                                                            alt="customer"
                                                        >

                                                    </div>

                                                @else

                                                    <div class="avatar-text avatar-md">
                                                        {{ strtoupper(substr($customer->name, 0, 1)) }}
                                                    </div>

                                                @endif

                                            </td>

                                            <td>

                                                <span class="fw-semibold">
                                                    {{ $customer->name }}
                                                </span>

                                            </td>

                                            <td>
                                                {{ $customer->email }}
                                            </td>

                                            <td>
                                                {{ $customer->phone }}
                                            </td>

                                            <td>
                                                {{ $customer->address }}
                                            </td>

                                            <td>
                                                {{ $customer->created_at->format('d M Y') }}
                                            </td>

                                            <td>

                                                <div class="hstack gap-2 justify-content-end">

                                                    <!-- Edit -->

                                                    <a href="{{ route('admin.customers.edit', $customer->id) }}"
                                                       class="avatar-text avatar-md">

                                                        <i class="feather feather-edit"></i>

                                                    </a>

                                                    <!-- Delete -->

                                                    <form action="{{ route('admin.customers.destroy', $customer->id) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Are you sure?')">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                                class="avatar-text avatar-md border-0 bg-transparent">

                                                            <i class="feather feather-trash-2 text-danger"></i>

                                                        </button>

                                                    </form>

                                                </div>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="8" class="text-center py-5">

                                                No Customers Found

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>
                            

                        </div>

                    </div>

                </div>

                

            </div>

        </div>

    </div>

</div>

@endsection