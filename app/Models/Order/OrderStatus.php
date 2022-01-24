<?php

namespace App\Models\Order;

enum OrderStatus {
    case Pending;
    case Processed;
    case Delivered;
}
