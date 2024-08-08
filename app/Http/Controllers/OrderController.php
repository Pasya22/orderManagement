<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function store(Request $request)
    {
         // Validasi data
         $request->validate([
            'table_no' => 'required|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);
        $orderDetails = [];

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);

            if (!$product) {
                return response()->json(['error' => 'Invalid product ID: ' . $item['product_id']], 400);
            }

            $orderDetails[] = [
                'product_id' => $item['product_id'],
                'product_name' => $product->name,
                'quantity' => $item['quantity'],
                'price' => $product->price,
                'total_price' => $product->price * $item['quantity'],
                'printer' => $product->printer,
            ];
        }

        $order = Order::create([
            'table_no' => $request->table_no,
            'order_details' => json_encode($orderDetails), // Menyimpan detail dalam format JSON
        ]);

        $printerFlags = array_unique(array_column($orderDetails, 'printer'));

        return response()->json(['printers' => $printerFlags,$order]);
    }


}
