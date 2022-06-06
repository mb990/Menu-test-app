<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Calculate amount to pay
Route::get('amount-to-pay', 'OrderController@amountToPay')->name('order.amount-to-pay');
// Make a purchase
Route::post('purchase', 'PurchaseController')->name('order.purchase');
// Get discount percentage for a currency
Route::get('get-discount-percentage', 'CurrencyController@getDiscountPercentage')->name('currency.get-discount-percentage');
// Update discount percentage for a currency
Route::put('update-discount-percentage', 'CurrencyController@updateDiscountPercentage')->name('currency.update-discount-percentage');
// Update currencies exchange rates
Route::put('update-exchange-rates', 'CurrencyController@updateCurrenciesExchangeRates')->name('currency.update-exchange-rates');
