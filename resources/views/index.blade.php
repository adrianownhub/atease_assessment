@extends('layouts.master')

@section('title')
    <h1 class="m-0">Dashboard</h1>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Admin Panel</li>
    </ol>
@endsection

@section('content')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-sm-12">
            <!-- CUSTOM BLOCKQUOTE -->
            <blockquote style="margin: 1.5em 0rem;" class="blockquote blockquote-custom bg-white p-3 shadow rounded">
                <div class="blockquote-custom-icon bg-info shadow-sm"><i class="fa fa-quote-left text-white"></i></div>
                <p class="mb-0 mt-2 font-italic">"You miss 100% of the shots you don’t take." <a href="#"
                        class="text-info">@wayne</a>."</p>
                <footer class="blockquote-footer pt-4 mt-4 border-top">
                    <cite title="Source Title">Wayne Gretzky</cite>
                </footer>
            </blockquote><!-- END -->
        </div>
        <div></div>
    </div>
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="driver-tab" data-toggle="tab" href="#driver" role="tab"
                        aria-controls="driver" aria-selected="true">Drivers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="customers-tab" data-toggle="tab" href="#customers" role="tab"
                        aria-controls="customers" aria-selected="false">Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="products-tab" data-toggle="tab" href="#products" role="tab"
                        aria-controls="products" aria-selected="false">Products</a>
                </li>
            </ul>
            <br>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="driver" role="tabpanel" aria-labelledby="driver-tab">
                    <div class="text-right mb-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDriverModal">Add
                            Driver</button>
                    </div>
                    <table class="table table-bordered" id="driver_tbl" name="driver_tbl" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th style="width: 20%">Action</th> <!-- Add action column -->
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tab-pane fade" id="customers" role="tabpanel" aria-labelledby="customers-tab">
                    <div class="text-right mb-3">
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                            data-target="#addCustomerModal">Add Customer</button>
                    </div>
                    <table class="table table-bordered" id="customers_tbl" name="customers_tbl" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Driver Name</th>
                                <th style="width: 20%">Action</th> <!-- Add action column -->
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="products-tab">
                    <div class="text-right mb-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#addProductModal">Add
                            Product</button>
                    </div>
                    <table class="table table-bordered" id="products_tbl" name="products_tbl" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th style="width: 20%">Action</th> <!-- Add action column -->
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include modals -->
    @include('modals')
@endsection
@include('js')
@push('scripts')
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        $('#driver_tbl').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/load-drivers',
                type: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action',
                },
            ]
        });

        $('#customers_tbl').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/load-customers',
                type: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'user_name',
                    name: 'user.name',
                    defaultContent: '',
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                },
            ]
        });

        $('#products_tbl').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/load-products',
                type: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'action',
                    name: 'action',
                },
            ]
        });

        // Load Customers in modal
        function loadCustomerInModal(customerId) {
            // AJAX request to fetch customer details
            $.ajax({
                url: '/customer/' + customerId,
                type: 'GET',
                success: function(response) {
                    // Populate modal fields with customer details
                    $('#customerId').val(response.customer.id);
                    $('#editCustomerName').val(response.customer.name);
                    $('#editCustomerAddress').val(response.customer.address);

                    // Populate the driver select field
                    var selectField = $('#editDriver');
                    selectField.empty(); // Clear existing options

                    // Add options for all drivers
                    $.each(response.allDrivers, function(index, driver) {
                        var option = $('<option>', {
                            value: driver.id,
                            text: driver.name
                        });
                        // Set selected option to the current driver of the customer being edited
                        if (driver.id == response.customer.user_id) {
                            option.attr('selected', 'selected');
                        }
                        selectField.append(option);
                    });

                    // Show the modal
                    $('#editCustomerModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error if needed
                }
            });
        }

        $(document).on('click', '#editCustomerBtn', function() {
            var customerId = $(this).data('id'); // Use data() method to retrieve data-id attribute
            loadCustomerInModal(customerId); // Call the function with customerId parameter
        });

        // Load Drivers in modal
        function loadDriverInModal(driverId) {
            $.ajax({
                url: '/driver/' + driverId,
                type: 'GET',
                success: function(response) {
                    $('#driverId').val(response.driver.id);
                    $('#editDriverName').val(response.driver.name);

                    $('#editDriverModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error if needed
                }
            });
        }

        $(document).on('click', '#editDriverBtn', function() {
            var driverId = $(this).data('id');
            loadDriverInModal(driverId);
        });

        // Load Products in modal
        function loadProductInModal(productId) {
            $.ajax({
                url: '/product/' + productId,
                type: 'GET',
                success: function(response) {
                    $('#productId').val(response.product.id);
                    $('#editProductName').val(response.product.name);
                    $('#editProductPrice').val(response.product.price);
                    $('#editProductModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error if needed
                }
            });
        }

        $(document).on('click', '#editProductBtn', function() {
            var productId = $(this).data('id');
            loadProductInModal(productId);
        });

        // Load Products in Discount modal
        function loadProducts() {
            $.ajax({
                url: "/products",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var products = response.products;
                    var options = "";
                    products.forEach(function(product) {
                        options += "<option value='" + product.id + "'>" + product.name + "</option>";
                    });
                    $("#product").html(options);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching products:", error);
                }
            });
        }

        // Call the function to load products when the modal is shown
        $('#addDiscountModal').on('shown.bs.modal', function(e) {
            loadProducts();
        });

        
    </script>
@endpush
