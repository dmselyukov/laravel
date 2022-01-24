<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateRequest;
use App\Http\Requests\Order\DeliveredRequest;
use App\Http\Requests\Order\ProcessedRequest;
use App\Http\Resources\Orders\OrdersResource;
use App\Models\Order\Order;
use App\UseCases\Orders\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\Pure;

class OrdersController extends Controller
{
    public function store(CreateRequest $request): OrdersResource
    {
        $order = OrderService::create($request->validated());

        return new OrdersResource($order);
    }

    public function setProcessedOrderStatus(ProcessedRequest $request): OrdersResource
    {
        if ($request->validated()) {
            $order = OrderService::changeStatus($request->route('order'), $request['status']);
        }

        return new OrdersResource($order);
    }

    public function setDeliveredOrderStatus(DeliveredRequest $request): OrdersResource
    {
        if ($request->validated()) {
            $order = OrderService::changeStatus($request->route('order'), $request['status']);
        }

        return new OrdersResource($order);
    }

    public function index(Request $request, Order $orders): AnonymousResourceCollection
    {
        $orderObjects = OrderService::search($request, $orders);

        return OrdersResource::collection($orderObjects);
    }

    #[Pure]
    public function show(Order $order): OrdersResource
    {
        return new OrdersResource($order);
    }
}
