<?php

namespace App\services;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Enums\OrderStatus;
use App\Http\Resources\Order\ShowResource;
class OrderService
{
    private function validateOrderAttributes(array $data,$calledmethod): array
    {

        // Convert status to lowercase if it exists in the $data array
        if (isset($data['status'])) {
            $data['status'] = strtolower($data['status']);
        }


        if($calledmethod==1)  $rules = [
            'title' => 'unique:orders',
            'description' => 'required',
            'price' => 'required|numeric',
            'status' => 'in:pending,processing,shipped,delivered',

        ];
        else      $rules = [
            'title' => 'required|unique:orders',
            'description' => 'required',
            'price' => 'required|numeric',
            'status' => 'in:pending,processing,shipped,delivered',

        ];

        $messages = [
            'title.required' => __("Title is required"),
            'title.unique' => __("Title already exists,change it"),
            'description.required' => __("Description is required"),
            'price.required' => __("Price is required"),
            'price.numeric' => __("Price should be numeric"),
//            'status.required' => __("Status is required"),
            'status.in' => __("Invalid status value"),
            // Add other custom messages for validation errors
        ];

        return Validator::validate($data, $rules, $messages);
    }

    public function createOrder(array $data,): array
    {
        try {
            $validated = $this->validateOrderAttributes($data,0);

            $user = Auth::user();
            $order = new Order($validated);
            $user->orders()->save($order);

            return [
                'success' => true,
                'message' => 'Order created successfully',
                'status_code' => 201,
                'data' => $order,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'status_code' => $e->getCode() ?: 400, // Default to 400 Bad Request
            ];
        }
    }

    public function getAllOrders(): array
    {
        $user = Auth::user();
        return [
            'success' => true,
            'status_code' => 201,
            'data' => $user->orders()->get()->toArray(),
        ];
    }

    public function getOrderById(int $id): array
    {
        $user = Auth::user();
        $order = $user->orders()->find($id);

        if (!$order) {
            return [
                'success' => false,
                'message' => 'Order not found',
                'status_code' => 404,
            ];
        }
//dd($order);
        return [
            'success' => true,
            'status_code' => 201,
            'data' => $order,
        ];
    }

    public function updateOrder(int $id, array $data): array
    {
        try {
            $validated = $this->validateOrderAttributes($data,1);

            $user = Auth::user();
            $order = $user->orders()->find($id);

            if (!$order) {
                return [
                    'success' => false,
                    'message' => 'Order not found',
                    'status_code' => 404,
                ];
            }

            $order->update($validated);

            return [
                'success' => true,
                'message' => 'Order updated successfully',
                'status_code' => 201,
                'data' => $order,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'status_code' => $e->getCode() ?: 400, // Default to 400 Bad Request
            ];
        }
    }

    public function deleteOrder(int $id): array
    {
        $user = Auth::user();
        $order = $user->orders()->find($id);

        if (!$order) {
            return [
                'success' => false,
                'message' => 'Order not found',
                'status_code' => 404,
            ];
        }

        $order->delete();

        return [
            'success' => true,
            'message' => 'Order deleted successfully',
            'status_code' => 201,
        ];
    }

    public function searchOrders(string $query): array
    {
        $user = Auth::user();
        $orders = $user->orders()->where('title', 'like', '%' . $query . '%')->get()->toArray();

        return [
            'success' => true,
            'status_code' => 201,
            'data' => $orders,
        ];
    }
}
