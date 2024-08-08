@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Order Form</h2>
        <form id="orderForm">
            <div class="mb-3">
                <label for="table_no" class="form-label">Table Number</label>
                <input type="text" class="form-control" id="table_no" name="table_no" placeholder="Enter table number"
                    required>
            </div>

            <div id="orderItems">
                <div class="order-item mb-3 row">
                    <div class="col-md-6">
                        <label for="product" class="form-label">Product</label>
                        <select class="form-select product" name="product[]">
                            <option value="1">Es Jeruk (Dingin)</option>
                            <option value="2">Es Jeruk (Panas)</option>
                            <option value="3">Kopi (Dingin)</option>
                            <option value="4">Kopi (Panas)</option>
                            <option value="5">Teh (Manis)</option>
                            <option value="6">Teh (Tawar)</option>
                            <option value="7">Mie Goreng</option>
                            <option value="8">Mie Kuah</option>
                            <option value="9">Nasi Goreng</option>
                            <option value="10">Promo Nasi Goreng + Jeruk Dingin</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control quantity" name="quantity[]" min="1" value="1"
                            required>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-danger mt-4 remove-item">Remove</button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-success mb-3" id="addItem">Add Item</button>
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            if (typeof $ !== 'undefined' && typeof $.ajax === 'function') {
                console.log('jQuery and $.ajax are available.');
            } else {
                console.log('jQuery or $.ajax is not available.');
            }
            // Add a new item row
            $('#addItem').on('click', function() {
                const newItem = `
            <div class="order-item mb-3 row">
                <div class="col-md-6">
                    <select class="form-select product" name="product[]">
                        <option value="1">Es Jeruk (Dingin)</option>
                        <option value="2">Es Jeruk (Panas)</option>
                        <option value="3">Kopi (Dingin)</option>
                        <option value="4">Kopi (Panas)</option>
                        <option value="5">Teh (Manis)</option>
                        <option value="6">Teh (Tawar)</option>
                        <option value="7">Mie Goreng</option>
                        <option value="8">Mie Kuah</option>
                        <option value="9">Nasi Goreng</option>
                        <option value="10">Promo Nasi Goreng + Jeruk Dingin</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control quantity" name="quantity[]" min="1" value="1" required>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-danger remove-item">Remove</button>
                </div>
            </div>`;
                $('#orderItems').append(newItem);
            });

            // Remove an item row
            $(document).on('click', '.remove-item', function() {
                $(this).closest('.order-item').remove();
            });
            console.log('jQuery loaded correctly');
            // Handle form submission
            $('#orderForm').on('submit', function(event) {
                event.preventDefault();

                const tableNo = $('#table_no').val();
                const products = [];

                $('.order-item').each(function() {
                    const product_id = $(this).find('.product').val();
                    const quantity = $(this).find('.quantity').val();
                    products.push({
                        product_id,
                        quantity
                    });
                });

                $.ajax({
                    url: '/api/order',
                    type: 'POST',
                    contentType: 'application/json',
                    dataType: 'json',
                    data: JSON.stringify({
                        table_no: tableNo,
                        items: products
                    }),
                    success: function(response) {
                        alert('Order placed! Printers: ' + response.printers.join(', '));
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred while placing the order. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection
