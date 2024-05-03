<!-- Customer -->
<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCustomerModalLabel">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add form for adding a new customer -->
                <form id="addCustomerForm">
                    <div class="form-group">
                        <label for="customerName">Name</label>
                        <input type="text" class="form-control" id="customerName" name="customerName"
                            placeholder="Enter customer name">
                    </div>
                    <div class="form-group">
                        <label for="customerAddress">Address</label>
                        <input type="text" class="form-control" id="customerAddress" name="customerAddress"
                            placeholder="Enter customer address">
                    </div>
                    <div class="form-group">
                        <label for="driverId">Driver</label>
                        <select class="form-control" id="driverId" name="driverId">
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addCustomerBtn">Add Customer</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Customer Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog" aria-labelledby="editCustomerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add form for editing an existing customer -->
                <form id="editCustomerForm">
                    <input type="hidden" id="customerId" name="customerId">
                    <div class="form-group">
                        <label for="editCustomerName">Name</label>
                        <input type="text" class="form-control" id="editCustomerName" name="editCustomerName"
                            placeholder="Enter customer name">
                    </div>
                    <div class="form-group">
                        <label for="editCustomerAddress">Address</label>
                        <input type="text" class="form-control" id="editCustomerAddress" name="editCustomerAddress"
                            placeholder="Enter customer address">
                    </div>

                    <div class="form-group">
                        <label for="editDriver">Driver</label>
                        <select class="form-control" id="editDriver" name="editDriver">
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editCustomerBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Customer Modal -->
<div class="modal fade" id="deleteCustomerModal" tabindex="-1" role="dialog"
    aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCustomerModalLabel">Delete Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this customer?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteCustomerBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Driver -->
<!-- Add Driver Modal -->
<div class="modal fade" id="addDriverModal" tabindex="-1" role="dialog" aria-labelledby="addDriverModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDriverModalLabel">Add Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add form for adding a new driver -->
                <form id="addDriverForm">
                    <div class="form-group">
                        <label for="driverName">Name</label>
                        <input type="text" class="form-control" id="driverName" name="driverName"
                            placeholder="Enter Driver Name">
                    </div>
                    <div class="form-group">
                        <label for="driveUserName">Username</label>
                        <input type="text" class="form-control" id="driveUserName" name="driveUserName"
                            placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label for="driverPassword">Password</label>
                        <input type="text" class="form-control" id="driverPassword" name="driverPassword"
                            placeholder="Enter Password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addDriverBtn">Add Driver</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Driver Modal -->
<div class="modal fade" id="editDriverModal" tabindex="-1" role="dialog" aria-labelledby="editDriverModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDriverModalLabel">Edit Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add form for editing an existing driver -->
                <form id="editDriverForm">
                    <input type="hidden" id="driverId" name="driverId">
                    <div class="form-group">
                        <label for="editDriverName">Name</label>
                        <input type="text" class="form-control" id="editDriverName" name="editDriverName"
                            placeholder="Enter driver name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editDriverBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Driver Modal -->
<div class="modal fade" id="deleteDriverModal" tabindex="-1" role="dialog"
    aria-labelledby="deleteDriverModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteDriverModalLabel">Delete Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this driver?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteDriverBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Products -->
<!-- Add Products Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addProductForm">
                    <div class="form-group">
                        <label for="productName">Name</label>
                        <input type="text" class="form-control" id="productName" name="productName"
                            placeholder="Enter Product Name">
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Price</label>
                        <input type="number" step="0.01" class="form-control" id="productPrice"
                            name="productPrice" placeholder="Enter Price">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addProductBtn">Add Product</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add form for editing an existing driver -->
                <form id="editProductForm">
                    <input type="hidden" id="productId" name="productId">
                    <div class="form-group">
                        <label for="editProductName">Name</label>
                        <input type="text" class="form-control" id="editProductName" name="editProductName"
                            placeholder="Enter Product name">
                    </div>
                    <div class="form-group">
                        <label for="editProductPrice">Price</label>
                        <input type="number" step="0.01" class="form-control" id="editProductPrice"
                            name="editProductPrice" placeholder="Enter Price">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editProductBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Product Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog"
    aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this product?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteProductBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Products -->
<!-- Add Discount Rule Modal -->
<div class="modal fade" id="addDiscountModal" tabindex="-1" role="dialog" aria-labelledby="addDiscountModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDiscountModalLabel">Add Discount Rule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addDiscountForm">
                    <input type="hidden" id="customer_id" name="customer_id">
                    <div class="form-group">
                        <label for="product">Product</label>
                        <select class="form-control" id="product" name="product">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="discountValue">Fixed Discount Value</label>
                        <input type="number" step="0.01" class="form-control" id="discountValue"
                            name="discountValue" placeholder="Enter Discount Value">
                    </div>
                    <div class="form-group">
                        <label for="discountType">Discount Type</label>
                        <select class="form-control" id="discountType" name="discountType">
                            <option value="free_of_charge">Free of Charge</option>
                            <option value="free_pack">Free Pack</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="minQuantity">Minimum Quantity</label>
                        <input type="number" class="form-control" id="minQuantity" name="minQuantity"
                            placeholder="Enter Minimum Quantity">
                    </div>
                    <div class="form-group">
                        <label for="minQuantity">Maximum Quantity</label>
                        <input type="number" class="form-control" id="maxQuantity" name="maxQuantity"
                            placeholder="Enter Maximum Quantity">
                    </div>
                    <div class="form-group">
                        <label for="freePackQuantity">Free Pack Quantity</label>
                        <input type="number" class="form-control" id="freePackQuantity" name="freePackQuantity"
                            placeholder="Enter Free Pack Quantity">
                    </div>
                    <!-- Add more fields as needed -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addDiscountBtn">Add Discount Rule</button>
            </div>
        </div>
    </div>
</div>

<!-- Orders -->
<!-- Create Orders Modal -->
<div class="modal fade" id="createOrderModal" tabindex="-1" role="dialog" aria-labelledby="createOrderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createOrderModalLabel">Create Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createOrderForm">
                    <input type="hidden" id="order_customer_id" name="order_customer_id">
                    <div class="form-group">
                        <label for="orderProductName">Product Name</label>
                        <select class="form-control" id="orderProductId" name="orderProductId">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="orderQuantity" name="orderQuantity"
                            placeholder="Enter Quantity">
                    </div>
                    <hr>
                    <h5>Order Details</h5>
                    <div class="form-group">
                        <label for="totalPrice">Total Price</label>
                        <input type="text" class="form-control" id="totalPrice" name="totalPrice" readonly>
                    </div>
                    <div class="form-group">
                        <label for="totalQuantity">Total Quantity</label>
                        <input type="text" class="form-control" id="totalQuantity" name="totalQuantity" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createOrderBtn">Create Order</button>
            </div>
        </div>
    </div>
</div>

<!-- View Orders Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Customer Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody id="cartItems">
                        <!-- Cart items will be inserted here -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmCartBtn">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="pdfViewer" style="width: 100%; height: 800px;" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



