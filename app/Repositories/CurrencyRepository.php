<?php

namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

class CurrencyRepository
{
    private Currency $currency;

    /**
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->currency
            ::orderBy('name')
            ->get();
    }

    /**
     * @param int $id
     * @return Currency
     */
    public function find(int $id): Currency
    {
        return $this->currency
            ::find($id);
    }

    /**
     * @param string $shortcut
     * @return Currency
     */
    public function findByShortcut(string $shortcut): Currency
    {
        return $this->currency
            ::where('shortcut', $shortcut)
            ->first();
    }

    /**
     * @param array $data
     * @return Currency
     */
    public function store(array $data): Currency
    {
        return $this->currency
            ::create($data);
    }

    /**
     * @param Currency $currency
     * @param array $params
     */
    public function update(Currency $currency, array $params): void
    {
        $currency->update($params);
    }
}
