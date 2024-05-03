@extends('layouts.master')

@section('title')
    <h1 class="m-0">Dashboard</h1>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Driver Panel</li>
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
                    <a class="nav-link active" id="customers-tab" data-toggle="tab" href="#customers" role="tab"
                        aria-controls="customers" aria-selected="false">Customers</a>
                </li>
            </ul>
            <br>
            <div class="tab-pane fade show active" id="customers" role="tabpanel" aria-labelledby="customers-tab">
                <div class="text-right mb-3">
                    <button type="button" class="btn btn-success mb-3" id="viewCartBtn">View Cart</button>
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
        $('#customers_tbl').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/load-customers-for-drivers',
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

        // Load Products in Discount modal
        function loadProducts() {
            $.ajax({
                url: "/order-products",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var order_products = response.order_products;
                    var options = "";
                    order_products.forEach(function(products) {
                        options += "<option value='" + products.id + "'>" + products.name + "</option>";
                    });
                    $("#orderProductId").html(options);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching products:", error);
                }
            });
        }

        $('#createOrderModal').on('shown.bs.modal', function(e) {
            loadProducts();
        });
        
    </script>
@endpush
