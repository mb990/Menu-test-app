<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetDiscountPercentageRequest;
use App\Http\Requests\UpdateDiscountPercentageRequest;
use App\Services\CurrencyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    private CurrencyService $currencyService;

    /**
     * @param CurrencyService $currencyService
     */
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * @param GetDiscountPercentageRequest $request
     * @return JsonResponse
     */
    public function getDiscountPercentage(GetDiscountPercentageRequest $request): JsonResponse
    {
        $discountPercentage = $this->currencyService->getDiscountPercentageForCurrency($request->currencyId);

        return response()->json(compact('discountPercentage'));
    }

    /**
     * @param UpdateDiscountPercentageRequest $request
     * @return JsonResponse
     */
    public function updateDiscountPercentage(UpdateDiscountPercentageRequest $request): JsonResponse
    {
        $this->currencyService->updateDiscountPercentage($request->validated());

        return response()->json(['message' => 'Discount percentage updated']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateCurrenciesExchangeRates(Request $request): JsonResponse
    {
        $this->currencyService->updateExchangeRates();

        return response()->json(['message' => 'Exchange rates updated']);
    }
}
