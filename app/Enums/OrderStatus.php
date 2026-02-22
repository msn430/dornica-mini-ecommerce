<?php

namespace App\Enums;

enum OrderStatus :int
{
    case PENDING = 0;
    case PROCESSING = 1;
    case SENT = 2;
    case CANCELLED = 3;
    case DELIVERED = 4;

    case REFUNDED = 5;
}
