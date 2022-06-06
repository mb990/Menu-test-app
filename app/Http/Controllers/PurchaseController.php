<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Services\PurchaseService;
use Illuminate\Http\JsonResponse;

class PurchaseController extends Controller
{
    private PurchaseService $purchaseService;

    /**
     * @param PurchaseService $purchaseService
     */
    public function __construct(PurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    /**
     * Handle the incoming request.
     *
     * @param PurchaseRequest $request
     * @return JsonResponse
     */
    public function __invoke(PurchaseRequest $request): JsonResponse
    {
        $this->purchaseService->purchase($request->validated());

        return response()->json(['message' => 'Purchased successfully']);
    }
}
