<?php

namespace App\Services;

use App\Models\Currency;
use App\Repositories\CurrencyRepository;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;

class CurrencyService
{
    private CurrencyRepository $currencyRepository;

    /**
     * @param CurrencyRepository $currencyRepository
     */
    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->currencyRepository->all();
    }

    /**
     * @param int $id
     * @return Currency|string
     */
    public function find(int $id): Currency|string
    {
        try {
            return $this->currencyRepository->find($id);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Store initially available currencies to database
     *
     * @return bool
     */
    public function seedInitialCurrencies(): bool
    {
        $currencies = $this->setInitialCurrencies();

        foreach ($currencies as $currency) {
            $this->currencyRepository->store($currency);
        }

        return true;
    }

    /**
     * @return array[]
     */
    public function setInitialCurrencies(): array
    {
        return [
            [
                'name' => 'Japanese Yen',
                'shortcut' => 'JPY',
                'exchange_rate' => 107.17,
                'surcharge' => 7.5,
                'discount_percentage' => null
            ],
            [
                'name' => 'Euro',
                'shortcut' => 'EUR',
                'exchange_rate' => 0.884872,
                'surcharge' => 5,
                'discount_percentage' => 2
            ],
            [
                'name' => 'British Pound',
                'shortcut' => 'GBP',
                'exchange_rate' => 0.711178,
                'surcharge' => 5,
                'discount_percentage' => null
            ],
        ];
    }

    /**
     * Update exchange rates by connecting to https://currencylayer.com/ API and fetching the live data
     */
    public function updateExchangeRates(): void
    {
        $baseUrl = env('EXCHANGE_RATE_API_BASE_URL');
        $accessKey = env('EXCHANGE_RATE_API_KEY');

        $url = $baseUrl . '?source=USD&currencies=JPY,EUR,GBP&apikey=' . $accessKey;

        $response = Http::get($url);

        foreach ($response->json('quotes') as $currency => $exchangeRate) {
            $currency = $this->currencyRepository->findByShortcut(substr($currency, '3'));
            $updateParams = ['exchange_rate' => $exchangeRate];
            $this->currencyRepository->update($currency, $updateParams);
        }
    }

    /**
     * @param int $currencyId
     * @return int|mixed
     */
    public function getDiscountPercentageForCurrency(int $currencyId)
    {
        $currency = $this->find($currencyId);

        return $currency->discount_percentage ?? 0;
    }

    /**
     * @param array $data
     */
    public function updateDiscountPercentage(array $data): void
    {
        $currency = $this->find($data['currencyId']);
        $updateParams = ['discount_percentage' => $data['discountPercentage']];

        $this->currencyRepository->update($currency, $updateParams);
    }
}
