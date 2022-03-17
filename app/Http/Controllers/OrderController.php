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

    public function store(Request $request)
    {
        return $this->orderService->store($request->all());
    }

    public function getUserOrder($userId)
    {
        return $this->orderService->getUserOrder($userId);
    }

    public function getOrderById($orderId)
    {
        return $this->orderService->getOrderById($orderId);
    }
}
