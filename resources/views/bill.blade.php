@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Bill</h2>
    <form id="billForm">
        <div class="mb-3">
            <label for="table_no" class="form-label">Table Number</label>
            <input type="text" class="form-control" id="table_no" name="table_no" placeholder="Enter table number" required>
        </div>
        <button type="submit" class="btn btn-primary">Get Bill</button>
    </form>

    <div id="billDetails" class="mt-4"></div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#billForm').on('submit', function(event) {
            event.preventDefault();

            let tableNo = $('#table_no').val();

            $.ajax({
                url: '/api/bill/' + tableNo,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        $('#billDetails').html('<div class="alert alert-danger">' + response.error + '</div>');
                    } else {
                        let billHtml = '<h4>Table Number: ' + response.table_no + '</h4>';
                        billHtml += '<table class="table">';
                        billHtml += '<thead><tr><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th></tr></thead><tbody>';

                        response.order_details.forEach(function(item) {
                            billHtml += '<tr>';
                            billHtml += '<td>' + item.product_name + '</td>';
                            billHtml += '<td>' + item.quantity + '</td>';
                            billHtml += '<td>' + item.price + '</td>';
                            billHtml += '<td>' + item.total_price + '</td>';
                            billHtml += '</tr>';
                        });

                        billHtml += '</tbody></table>';
                        billHtml += '<h4>Total: ' + response.total + '</h4>';

                        $('#billDetails').html(billHtml);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    $('#billDetails').html('<div class="alert alert-danger">An error occurred while fetching the bill. Please try again.</div>');
                }
            });
        });
    });
</script>


@endsection
