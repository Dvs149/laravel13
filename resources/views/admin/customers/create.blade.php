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
                    Create Customer
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

                        <!-- Heading -->

                        <div class="mb-5">

                            <h5 class="fw-bold mb-2">
                                Customer Information
                            </h5>

                            <span class="fs-12 text-muted">
                                Create new customer details
                            </span>

                        </div>

                        <!-- Form -->

                        <form
                            id="customerForm"
                            method="POST"
                            enctype="multipart/form-data"
                        >

                            @csrf

                            <!-- Image Upload -->

                            <div class="row mb-4 align-items-center">

                                <div class="col-lg-4">

                                    <label class="fw-semibold">
                                        Avatar:
                                    </label>

                                </div>

                                <div class="col-lg-8">

                                    <div class="mb-4 mb-md-0 d-flex gap-4 your-brand">

                                        <div class="wd-100 ht-100 position-relative overflow-hidden border border-gray-2 rounded">

                                            <img
                                                src="{{ asset('assets/images/avatar/1.jpg') }}"
                                                class="upload-pic img-fluid rounded h-100 w-100"
                                                alt=""
                                            >

                                            <div class="position-absolute start-50 top-50 end-0 translate-middle h-100 w-100 hstack align-items-center justify-content-center c-pointer upload-button">

                                                <i class="feather feather-camera"></i>

                                            </div>

                                            <input
                                                class="file-upload"
                                                type="file"
                                                name="image"
                                                accept="image/*"
                                            >

                                        </div>

                                        <div class="d-flex flex-column gap-1">

                                            <div class="fs-11 text-gray-500">
                                                # Upload your profile
                                            </div>

                                            <div class="fs-11 text-gray-500">
                                                # Avatar size 150x150
                                            </div>

                                            <div class="fs-11 text-gray-500">
                                                # Max upload size 2mb
                                            </div>

                                            <div class="fs-11 text-gray-500">
                                                # Allowed types: png, jpg, jpeg
                                            </div>

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
                                        placeholder="Enter customer name"
                                    >

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
                                        placeholder="Enter email"
                                    >

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
                                        placeholder="Enter phone number"
                                    >

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
                                        placeholder="Enter address"
                                    ></textarea>

                                </div>

                            </div>

                            <!-- Submit -->

                            <div class="text-end">

                                <button
                                    type="button"
                                    class="btn btn-primary create_cust"
                                >

                                    <i class="feather-user-plus me-2"></i>

                                    Create Customer

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

$(document).ready(function () {

    
    /*
    |--------------------------------------------------------------------------
    | Remove Validation Errors
    |--------------------------------------------------------------------------
    */

    $(document).on(
        "keyup change",
        "#customerForm input, #customerForm textarea",
        function () {

            $(this)
                .closest(".col-lg-8")
                .find(".validation-error")
                .remove();
        }
    );

    /*
    |--------------------------------------------------------------------------
    | AJAX Submit
    |--------------------------------------------------------------------------
    */

    $(document).on("click", ".create_cust", function (e) {

        e.preventDefault();

        let button = $(this);

        let form = $("#customerForm")[0];

        let formData = new FormData(form);

        // remove old validation errors
        $(".validation-error").remove();

        // disable button
        button.prop("disabled", true);

        button.html("Processing...");

        $.ajax({

            url: "{{ route('admin.customers.store') }}",

            type: "POST",

            data: formData,

            processData: false,

            contentType: false,

            success: function (response) {

                button.prop("disabled", false);

                button.html(`
                    <i class="feather-user-plus me-2"></i>
                    Create Customer
                `);

                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: response.message
                });

                // reset form
                $("#customerForm")[0].reset();

                // reset image preview
                $(".upload-pic").attr(
                    "src",
                    "{{ asset('assets/images/avatar/1.jpg') }}"
                );
            },

            error: function (xhr) {

                button.prop("disabled", false);

                button.html(`
                    <i class="feather-user-plus me-2"></i>
                    Create Customer
                `);

                if (xhr.status === 422) {

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {

                        let input = $(
                            "[name='" + key + "']"
                        );

                        input
                            .closest(".col-lg-8")
                            .find(".validation-error")
                            .remove();

                        input.after(`
                            <div class="text-danger validation-error mt-2">
                                ${value[0]}
                            </div>
                        `);
                    });
                }
            }
        });
    });

});

</script>

@endpush