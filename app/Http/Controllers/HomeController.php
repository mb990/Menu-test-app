<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $currencies = $this->currencyService->all();

        return view('home', compact('currencies'));
    }

    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function config(Request $request): Factory|View|Application
    {
        $currencies = $this->currencyService->all();

        return view('config', compact('currencies'));
    }
}
