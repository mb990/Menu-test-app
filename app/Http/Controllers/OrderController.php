<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateAmountToPayRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderService $orderService;

    /**
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param CalculateAmountToPayRequest $request
     * @return JsonResponse
     */
    public function amountToPay(CalculateAmountToPayRequest $request): JsonResponse
    {
        $amountToPay = $this->orderService->getAmountToPay($request->validated());

        return response()->json(compact('amountToPay'));
    }
}
