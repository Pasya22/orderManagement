<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function showBillForm()
    {
        return view('bill');
    }

    public function showBill(Request $request)
    {
        $table_no = $request->table_no;
        return redirect('/bill/' . $table_no);
    }

    public function getBill($table_no)
    {
        $order = Order::where('table_no', $table_no)->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $orderDetails = json_decode($order->order_details, true); // Decode JSON ke array
        $total = array_sum(array_column($orderDetails, 'total_price'));

        return response()->json([
            'table_no' => $order->table_no,
            'order_details' => $orderDetails,
            'total' => $total,
            'printer_flag' => $order->printer_flag
        ]);
    }

}
