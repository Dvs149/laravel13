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
                    <a href="{{ route('admin.customers.index') }}">
                        Home
                    </a>
                </li>

                <li class="breadcrumb-item">
                    Edit Customer
                </li>

            </ul>

        </div>

    </div>

    <!-- Main Content -->

    <div class="main-content">

        <div class="row">

            <div class="col-lg-12">

                <div class="card stretch stretch-full">

                    <div class="card-body general-info">

                        <div class="mb-5">

                            <h5 class="fw-bold mb-2">
                                Customer Info
                            </h5>

                            <span class="fs-12 text-muted">
                                Update customer information
                            </span>

                        </div>

                        <!-- Form -->

                        <form
                            action="{{ route('admin.customers.update', $customer->id) }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >

                            @csrf
                            @method('PUT')


                            <!-- Image Upload -->
                            <div class="row mb-4 align-items-center">
                            
                                <div class="col-lg-4">
                            
                                    <label class="fw-semibold">
                                        Avatar:
                                    </label>
                            
                                </div>
                            
                                <div class="col-lg-8">
                            
                                    <div class="mb-4 mb-md-0 d-flex gap-4 your-brand">
                            
                                        <!-- Image Box -->
                            
                                        <div class="wd-100 ht-100 position-relative overflow-hidden border border-gray-2 rounded">
                            
                                            @if($customer->image)
                            
                                                <img
                                                    src="{{ asset('uploads/customers/' . $customer->image) }}"
                                                    class="upload-pic img-fluid rounded h-100 w-100"
                                                    alt=""
                                                >
                            
                                            @else
                            
                                                <img
                                                    src="{{ asset('assets/images/avatar/1.jpg') }}"
                                                    class="upload-pic img-fluid rounded h-100 w-100"
                                                    alt=""
                                                >
                            
                                            @endif
                            
                                            <!-- Upload Button -->
                            
                                            <div class="position-absolute start-50 top-50 end-0 translate-middle h-100 w-100 hstack align-items-center justify-content-center c-pointer upload-button">
                            
                                                <i class="feather feather-camera"></i>
                            
                                            </div>
                            
                                            <!-- Hidden File Input -->
                            
                                            <input
                                                class="file-upload d-none"
                                                type="file"
                                                name="image"
                                                accept="image/*"
                                            >
                            
                                        </div>
                            
                                        <!-- Info -->
                            
                                        <div class="d-flex flex-column gap-1">
                            
                                            <div class="fs-11 text-gray-500 mt-2">
                                                # Upload your profile
                                            </div>
                            
                                            <div class="fs-11 text-gray-500">
                                                # Avatar size 150x150
                                            </div>
                            
                                            <div class="fs-11 text-gray-500">
                                                # Max upload size 2mb
                                            </div>
                            
                                            <div class="fs-11 text-gray-500">
                                                # Allowed: png, jpg, jpeg
                                            </div>
                            
                                            @error('image')
                            
                                                <div class="text-danger mt-2">
                            
                                                    {{ $message }}
                            
                                                </div>
                            
                                            @enderror
                            
                                        </div>
                            
                                    </div>
                            
                                </div>
                            
                            </div>


                            <!-- Name -->

                            <div class="row mb-4 align-items-center">

                                <div class="col-lg-4">

                                    <label class="fw-semibold">
                                        Name:
                                    </label>

                                </div>

                                <div class="col-lg-8">

                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        value="{{ old('name', $customer->name) }}"
                                        placeholder="Name"
                                    >

                                    @error('name')

                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>

                            </div>

                            <!-- Email -->

                            <div class="row mb-4 align-items-center">

                                <div class="col-lg-4">

                                    <label class="fw-semibold">
                                        Email:
                                    </label>

                                </div>

                                <div class="col-lg-8">

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        value="{{ old('email', $customer->email) }}"
                                        placeholder="Email"
                                    >

                                    @error('email')

                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>

                            </div>

                            <!-- Phone -->

                            <div class="row mb-4 align-items-center">

                                <div class="col-lg-4">

                                    <label class="fw-semibold">
                                        Phone:
                                    </label>

                                </div>

                                <div class="col-lg-8">

                                    <input
                                        type="text"
                                        name="phone"
                                        class="form-control"
                                        value="{{ old('phone', $customer->phone) }}"
                                        placeholder="Phone"
                                    >

                                    @error('phone')

                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>

                            </div>

                            <!-- Address -->

                            <div class="row mb-4 align-items-center">

                                <div class="col-lg-4">

                                    <label class="fw-semibold">
                                        Address:
                                    </label>

                                </div>

                                <div class="col-lg-8">

                                    <textarea
                                        name="address"
                                        class="form-control"
                                        rows="4"
                                        placeholder="Address"
                                    >{{ old('address', $customer->address) }}</textarea>

                                    @error('address')

                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>

                            </div>

                            <!-- Submit -->

                            <div class="text-end">

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >

                                    <i class="feather-save me-2"></i>

                                    Update Customer

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

    function previewImage(event)
    {
        const reader = new FileReader();

        reader.onload = function()
        {
            const output = document.getElementById('preview-image');

            output.src = reader.result;
        }

        reader.readAsDataURL(event.target.files[0]);
    }

</script>

@endpush