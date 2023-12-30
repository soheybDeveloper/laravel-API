<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function create(Request $request)
    {
        $result = $this->orderService->createOrder($request->all());

        return response()->json($result['message'], $result['status_code']);
    }

    public function index()
    {
        $result = $this->orderService->getAllOrders();

        return response()->json($result['data']);
    }

    public function show($id)
    {
        $result = $this->orderService->getOrderById($id);

        return response()->json($result['data'] ?? $result['message'], $result['status_code']);
    }

    public function update(Request $request, $id)
    {
        $result = $this->orderService->updateOrder($id, $request->all());

        return response()->json($result['message'], $result['status_code']);
    }

    public function destroy($id)
    {
        $result = $this->orderService->deleteOrder($id);

        return response()->json($result['message'], $result['status_code']);
    }

    public function search(Request $request)
    {
        $result = $this->orderService->searchOrders($request->query('query'));

        return response()->json($result['data']);
    }
}














//// app/Http/Controllers/OrderController.php
//
//namespace App\Http\Controllers;
//
//use App\Models\Order;
//use App\Models\User;
//use Illuminate\Http\Request;
//
//class OrderController extends Controller
//{
//    public function __construct()
//    {
//
//    }
//
//    public function create(Request $request)
//    {
//        // Validation
//        $request->validate([
//            'title' => 'required|unique:orders',
//            'description' => 'required',
//            'price' => 'required|numeric',
//            'status' => 'required|in:Pending,Processing,Shipped,Delivered',
//        ]);
//
//        // Create Order for the authenticated user
//        $order = auth()->user()->orders()->create([
//            'title' => $request->input('title'),
//            'description' => $request->input('description'),
//            'price' => $request->input('price'),
//            'status' => $request->input('status'),
//            'createdAt' => now(),
//            // Add other fields as needed
//        ]);
//        $order.save();
//        return response()->json($order, 201);
//    }
//
//    public function index()
//    {
//        $orders = auth()->user()->orders()->get();
//        return response()->json($orders);
//    }
//
//    public function show($id)
//    {
//         $order = auth()->user()->orders()->findOrFail($id);
////        dd('hello'.$id);
//
////         dd($order);
//
//
//        if ($order == null) return response(['content'=>'no content'])->json();
//        return response()->json($order);
//    }
//
//    public function update(Request $request, $id)
//    {
//        // Validation
//        $request->validate([
//            'title' => 'required',
//            'description' => 'required',
//            'price' => 'required|numeric',
//            'status' => 'required|in:Pending,Processing,Shipped,Delivered',
//        ]);
//
//        $order = auth()->user()->orders()->findOrFail($id);
//
//        // Update Order
//        $order->update([
//            'title' => $request->input('title'),
//            'description' => $request->input('description'),
//            'price' => $request->input('price'),
//            'status' => $request->input('status'),
//            // Update other fields as needed
//        ]);
//
//        return response()->json($order);
//    }
//
//    public function destroy($id)
//    {
//        $order = auth()->user()->orders()->findOrFail($id);
//
//        $order->delete();
//
//        return response()->json(['message' => 'Order deleted successfully']);
//    }
//
//    public function search(Request $request)
//    {
////        dd('ff');
//        $query = $request->query('query');
//
//        // Use parameter binding to prevent SQL injection
//        $orders = auth()->user()->orders()->where('title', 'like', '%' . $query . '%')->get();
//
//        return response()->json($orders);
//    }
//
//}
