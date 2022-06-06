<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    private Order $order;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @param array $data
     * @return Order
     */
    public function store(array $data): Order
    {
        return $this->order
            ::create($data);
    }
}
