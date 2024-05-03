/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/custom.js ***!
  \********************************/
// Driver
// Add new Driver
function addDriver() {
  var name = $("#driverName").val();
  var username = $("#driveUserName").val();
  var password = $("#driverPassword").val();
  $.ajax({
    url: "/add-driver",
    type: "POST",
    dataType: "json",
    data: {
      driverName: name,
      driveUserName: username,
      driverPassword: password
    },
    success: function success(response) {
      alert(response.message);
      // Close the modal
      $("#addDriverModal").modal("hide");
      $("#driver_tbl").DataTable().ajax.reload();
    },
    error: function error(xhr, status, _error) {
      var errorMessage = xhr.responseJSON.message;
      alert(errorMessage);
    }
  });
}
$("#addDriverBtn").click(function () {
  addDriver();
});

// Update Driver
function updateDriver() {
  // Get the form data
  var driverId = $("#driverId").val();
  var driverName = $("#editDriverName").val();
  $.ajax({
    url: "/edit-driver/" + driverId,
    type: "PUT",
    dataType: "json",
    data: {
      name: driverName
    },
    success: function success(response) {
      alert(response.message);
      $("#editDriverModal").modal("hide");
      $("#driver_tbl").DataTable().ajax.reload();
    },
    error: function error(xhr, status, _error2) {
      var errorMessage = xhr.responseJSON.message || "An error occurred while updating the driver.";
      alert(errorMessage);
    }
  });
}
$("#editDriverBtn").click(function () {
  updateDriver();
});

// Delete Driver
var driverIdToDelete;
$(document).on("click", "#deleteDriverBtn", function () {
  driverIdToDelete = $(this).data("id");
  $("#deleteDriverModal").modal("show");
});
$("#confirmDeleteDriverBtn").click(function () {
  $.ajax({
    url: "/delete-driver/" + driverIdToDelete,
    type: "DELETE",
    success: function success(response) {
      $("#deleteDriverModal").modal("hide");
      $("#driver_tbl").DataTable().ajax.reload();
    },
    error: function error(xhr, status, _error3) {
      console.error("Error deleting driver:", _error3);
    }
  });
});

// Customer
// Add new customer
function addCustomer() {
  var name = $("#customerName").val();
  var address = $("#customerAddress").val();
  var user_id = $("#driverId").val();

  // AJAX request to the controller
  $.ajax({
    url: "/add-customer",
    type: "POST",
    dataType: "json",
    data: {
      customerName: name,
      customerAddress: address,
      driverId: user_id
    },
    success: function success(response) {
      // If the request is successful, show a success message
      alert(response.message);
      // Close the modal
      $("#addCustomerModal").modal("hide");
      // Reload the customer table to display the updated data
      $("#customers_tbl").DataTable().ajax.reload();
    },
    error: function error(xhr, status, _error4) {
      // If there's an error, show the error message
      var errorMessage = xhr.responseJSON.message;
      alert(errorMessage);
    }
  });
}
$("#addCustomerBtn").click(function () {
  addCustomer();
});

// Update Customer
function updateCustomer() {
  var customerId = $("#customerId").val();
  var customerName = $("#editCustomerName").val();
  var customerAddress = $("#editCustomerAddress").val();
  var driverId = $("#editDriver").val();
  $.ajax({
    url: "/edit-customer/" + customerId,
    type: "PUT",
    dataType: "json",
    data: {
      name: customerName,
      address: customerAddress,
      driverId: driverId
    },
    success: function success(response) {
      alert(response.message);
      $("#editCustomerModal").modal("hide");
      $("#customers_tbl").DataTable().ajax.reload();
    },
    error: function error(xhr, status, _error5) {
      var errorMessage = xhr.responseJSON.message || "An error occurred while updating the customer.";
      alert(errorMessage);
    }
  });
}
$("#editCustomerBtn").click(function () {
  updateCustomer();
});

// Delete Customer
var customerIdToDelete;
$(document).on("click", "#deleteCustomerBtn", function () {
  customerIdToDelete = $(this).data("id");
  $("#deleteCustomerModal").modal("show");
});
$("#confirmDeleteCustomerBtn").click(function () {
  $.ajax({
    url: "/delete-customer/" + customerIdToDelete,
    type: "DELETE",
    success: function success(response) {
      $("#deleteCustomerModal").modal("hide");
      $("#customers_tbl").DataTable().ajax.reload();
    },
    error: function error(xhr, status, _error6) {
      console.error("Error deleting customer:", _error6);
    }
  });
});

// Product
// Add new product
function addProduct() {
  var name = $("#productName").val();
  var price = $("#productPrice").val();
  $.ajax({
    url: "/add-product",
    type: "POST",
    dataType: "json",
    data: {
      productName: name,
      productPrice: price
    },
    success: function success(response) {
      alert(response.message);
      $("#addProductModal").modal("hide");
      $("#products_tbl").DataTable().ajax.reload();
    },
    error: function error(xhr, status, _error7) {
      var errorMessage = xhr.responseJSON.message || "An error occurred while adding the product.";
      alert(errorMessage);
    }
  });
}
$("#addProductBtn").click(function () {
  addProduct();
});

// Update product
function updateProduct() {
  var productId = $("#productId").val();
  var productName = $("#editProductName").val();
  var productPrice = $("#editProductPrice").val();
  $.ajax({
    url: "/edit-product/" + productId,
    type: "PUT",
    dataType: "json",
    data: {
      name: productName,
      price: productPrice
    },
    success: function success(response) {
      alert(response.message);
      $("#editProductModal").modal("hide");
      $("#products_tbl").DataTable().ajax.reload();
    },
    error: function error(xhr, status, _error8) {
      var errorMessage = xhr.responseJSON.message || "An error occurred while updating the product.";
      alert(errorMessage);
    }
  });
}
$("#editProductBtn").click(function () {
  updateProduct();
});

// Delete product
var productIdToDelete;
$(document).on("click", "#deleteProductBtn", function () {
  productIdToDelete = $(this).data("id");
  $("#deleteProductModal").modal("show");
});
$("#confirmDeleteProductBtn").click(function () {
  $.ajax({
    url: "/delete-product/" + productIdToDelete,
    type: "DELETE",
    success: function success(response) {
      $("#deleteProductModal").modal("hide");
      $("#products_tbl").DataTable().ajax.reload();
    },
    error: function error(xhr, status, _error9) {
      console.error("Error deleting products:", _error9);
    }
  });
});

// Discount
$(document).on('click', '.create-discount-btn', function () {
  var customerId = $(this).data('id');
  console.log('Customer ID:', customerId);
  $('#customer_id').val(customerId);
  $('#addDiscountModal').modal('show');
});
$(document).on('click', '.create-order-btn', function () {
  var customerId = $(this).data('id');
  $('#order_customer_id').val(customerId);
  $('#createOrderModal').modal('show');
});
function addDiscount() {
  var product = $("#product").val();
  var discountType = $("#discountType").val();
  var discountValue = $("#discountValue").val();
  var minQuantity = $("#minQuantity").val();
  var freePackQuantity = $("#freePackQuantity").val();
  var customer_id = $("#customer_id").val();
  var maxQuantity = $("#maxQuantity").val();
  $.ajax({
    url: "/add-discount",
    type: "POST",
    dataType: "json",
    data: {
      customer_id: customer_id,
      product: product,
      discountType: discountType,
      discountValue: discountValue,
      minQuantity: minQuantity,
      maxQuantity: maxQuantity,
      freePackQuantity: freePackQuantity
    },
    success: function success(response) {
      alert(response.message);
      $("#addDiscountModal").modal("hide");
    },
    error: function error(xhr, status, _error10) {
      var errorMessage = xhr.responseJSON.message;
      alert(errorMessage);
    }
  });
}
$("#addDiscountBtn").click(function () {
  addDiscount();
});
document.addEventListener("DOMContentLoaded", function () {
  var discountTypeSelect = document.getElementById("discountType");
  var minQuantityField = document.getElementById("minQuantity");
  var maxQuantityField = document.getElementById("maxQuantity");
  var freePackQuantityField = document.getElementById("freePackQuantity");
  function toggleFieldsVisibility() {
    var selectedOption = discountTypeSelect.value;
    if (selectedOption === "free_of_charge") {
      minQuantityField.closest(".form-group").style.display = "block";
      maxQuantityField.closest(".form-group").style.display = "block";
      freePackQuantityField.closest(".form-group").style.display = "none";
    } else if (selectedOption === "free_pack") {
      minQuantityField.closest(".form-group").style.display = "block";
      maxQuantityField.closest(".form-group").style.display = "none";
      freePackQuantityField.closest(".form-group").style.display = "block";
    }
  }
  toggleFieldsVisibility();
  discountTypeSelect.addEventListener("change", toggleFieldsVisibility);
});

// Calculate Discount
function applyDiscounts(order_customer_id, orderProductId, orderQuantity) {
  $.ajax({
    url: "/calculate-discounted-price",
    type: "GET",
    data: {
      customer_id: order_customer_id,
      product_id: orderProductId,
      quantity: orderQuantity
    },
    dataType: "json",
    success: function success(response) {
      $("#totalPrice").val(response.total_price.totalPrice.toFixed(2));
      $("#totalQuantity").val(response.total_price.totalQuantity);
    },
    error: function error(xhr, status, _error11) {
      console.error("Error calculating discounted price:", _error11);
    }
  });
}
$('#orderProductId, #orderQuantity').on('change', function () {
  var order_customer_id = $('#order_customer_id').val();
  var orderProductId = $('#orderProductId').val();
  var orderQuantity = $('#orderQuantity').val();
  applyDiscounts(order_customer_id, orderProductId, orderQuantity);
});

// Add Order to Cart
function addOrderToCart(orderCustomerId, orderProductId, orderQuantity, totalPrice, totalQuantity) {
  // Make AJAX request to add order to cart
  $.ajax({
    url: "/add-to-cart",
    type: "POST",
    data: {
      order_customer_id: orderCustomerId,
      order_product_id: orderProductId,
      order_quantity: orderQuantity,
      totalPrice: totalPrice,
      totalQuantity: totalQuantity
    },
    dataType: "json",
    success: function success(response) {
      alert("Order added to cart successfully!");
      $("#createOrderModal").modal("hide");
    },
    error: function error(xhr, status, _error12) {
      console.error("Error adding order to cart:", _error12);
    }
  });
}
$("#createOrderBtn").on("click", function () {
  var orderCustomerId = $("#order_customer_id").val();
  var orderProductId = $("#orderProductId").val();
  var orderQuantity = $("#orderQuantity").val();
  var totalPrice = $("#totalPrice").val();
  var totalQuantity = $("#totalQuantity").val();
  addOrderToCart(orderCustomerId, orderProductId, orderQuantity, totalPrice, totalQuantity);
});

// View Cart
function loadCartItems() {
  $.ajax({
    url: "/view-cart",
    type: "GET",
    dataType: "json",
    success: function success(response) {
      var cartItems = response.cart_items;
      var tableRows = "";
      cartItems.forEach(function (item) {
        tableRows += "<tr><td>" + item.product.name + "</td><td>" + item.customer.name + "</td><td>" + item.quantity + "</td><td>" + item.total_price + "</td></tr>";
      });
      $("#cartItems").html(tableRows);
    },
    error: function error(xhr, status, _error13) {
      console.error("Error loading cart items:", _error13);
    }
  });
}
$("#viewCartBtn").on("click", function () {
  loadCartItems();
  $("#cartModal").modal("show");
});

// Confirm orders in cart
function confirmCart() {
  $.ajax({
    url: "/confirm-cart",
    type: "POST",
    dataType: "json",
    success: function success(response) {
      alert(response.message);
      generateAndDisplayPDF();
      $("#cartModal").modal("hide");
    },
    error: function error(xhr, status, _error14) {
      console.error("Error confirming orders:", _error14);
    }
  });
}
$("#confirmCartBtn").on("click", function () {
  confirmCart();
});
function generateAndDisplayPDF() {
  $.ajax({
    url: "/generate-pdf",
    type: "POST",
    success: function success(response) {
      var url = response.pdf_path;
      console.log(url);
      $("#pdfViewer").attr("src", url);
      $("#pdfModal").modal("show");
    },
    error: function error(xhr, status, _error15) {
      console.error("Error generating PDF:", _error15);
    }
  });
}
/******/ })()
;