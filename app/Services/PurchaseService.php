<?php

namespace App\Services;

use App\Mail\OrderPurchased;
use App\Models\Currency;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class PurchaseService
{
    private OrderService $orderService;
    private CurrencyService $currencyService;

    /**
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService, CurrencyService $currencyService)
    {
        $this->orderService = $orderService;
        $this->currencyService = $currencyService;
    }

    /**
     * @param array $data
     */
    public function purchase(array $data): void
    {
        $currency = $this->currencyService->find($data['currencyId']);
        $preparedData = $this->prepareOrderData($currency, $data);
        $order = $this->orderService->store($preparedData);

        // if GBP send an email with order details
        $this->sendEmailForGbpExchange($currency, $order);
    }

    /**
     * @param Currency $currency
     * @param array $data
     * @return array
     */
    public function prepareOrderData(Currency $currency, array $data): array
    {
        $surchargeAmount = $currency->surcharge / 100 * $data['amountToPay'];
        $discountAmount = $currency->discount_percentage ? $currency->discount_percentage / 100 * $data['amount'] : 0;
        return [
            'currency_id' => $currency->id,
            'exchange_rate' => $currency->exchange_rate,
            'surcharge_percentage' => $currency->surcharge,
            'surcharge_amount' => (float) $surchargeAmount,
            'amount_purchased' => (float) $data['amount'],
            'amount_payed_usd' => (float) $data['amountToPay'],
            'discount_percentage' => $currency->discount_percentage ?? 0,
            'discount_amount' => (float) $discountAmount,
        ];
    }

    /**
     * @param Currency $currency
     * @param Order $order
     */
    public function sendEmailForGbpExchange(Currency $currency, Order $order): void
    {
        if ($currency->shortcut === 'GBP' && filter_var(env('MAIL_TO_ADDRESS'), FILTER_VALIDATE_EMAIL)) {
            Mail::to(env('MAIL_TO_ADDRESS'))->send(new OrderPurchased($order));
        }
    }
}
