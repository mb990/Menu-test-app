<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\Order;
use App\Repositories\OrderRepository;

class OrderService
{
    private OrderRepository $orderRepository;
    private CurrencyService $currencyService;

    /**
     * @param OrderRepository $orderRepository
     * @param CurrencyService $currencyService
     */
    public function __construct(OrderRepository $orderRepository, CurrencyService $currencyService)
    {
        $this->orderRepository = $orderRepository;
        $this->currencyService = $currencyService;
    }

    /**
     * @param array $data
     * @return Order
     */
    public function store(array $data): Order
    {
        return $this->orderRepository->store($data);
    }

    /**
     * @param array $data
     * @return float
     */
    public function getAmountToPay(array $data): float
    {
        $currency = $this->currencyService->find($data['currencyId']);
        $amount = $data['amount'];

        // Apply a discount if it exists for the currency
        if ($currency->discount_percentage) {
            $amountToPay = $this->calculateAmountToPay($amount, $currency);
            return $amountToPay - ($amountToPay * $currency->discount_percentage / 100);
        }

        return $this->calculateAmountToPay($amount, $currency);
    }

    /**
     * @param mixed $amount
     * @param Currency $currency
     * @return float|int
     */
    public function calculateAmountToPay(mixed $amount, Currency $currency): int|float
    {
        $amountToPay = $amount / $currency->exchange_rate;
        return $amountToPay + ($amountToPay * ($currency->surcharge / 100));
    }
}
