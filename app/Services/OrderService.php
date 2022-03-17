<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function store($data)
    {
        $order = Order::create($data);
        foreach ($data['products'] as $item) {
            $order->products()->attach($item);
        }
        return response('', 200);
    }

    public function getUserOrder($userId)
    {
        return Order::where('user_id', $userId)->with('user', 'products')->get();
    }

    public function getOrderById($orderId)
    {
        return Order::where('id', $orderId)->with('user', 'products')->get();
    }
}
