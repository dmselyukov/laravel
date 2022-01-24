<?php

namespace App\UseCases\Orders;

use App\Models\Order\Order;
use App\Models\Order\OrderStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderService
{
    public static function create(array $request): Order
    {
        $order = new Order();
        $order->content = $request;
        $order->status = OrderStatus::Pending->name;
        $order->save();

        return $order;
    }

    public static function changeStatus(int $order, string $status): Order
    {
        $order = Order::where('id', $order)->first();

        if (!$order) {
            throw new NotFoundHttpException('Order does not find');
        }
        $order->status = $status;
        $order->update();

        return $order;
    }

    public static function search(Request $request, Order $orders): Collection|array
    {
        $ordersObjects = $orders->newQuery();

        if ($request->has('name')) {
            $ordersObjects->whereJsonContains('content->user',  [['name' => $request->get('name')]]);
        }

        return $ordersObjects->get();
    }
}
