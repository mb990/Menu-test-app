@extends('layouts.app')

@section('title')

    Basic config page

@endsection

@section('content')

    <div class="row text-center">

        <h2 class="mb-5 mt-5">Change currency discount percentage</h2>

        <div class="col-lg-6">

            <label class="lead" for="currency">Currencies</label>
            <select class="form-control js-currency-id" name="currencyId" id="currency">
                <option value="" disabled selected>--Choose currency</option>
                @forelse($currencies as $currency)

                    <option value="{{ $currency->id }}">
                        {{ $currency->name }} ({{ $currency->shortcut }} )
                    </option>

                @empty

                @endforelse

            </select>

        </div>

        <div class="col-lg-6">

            <label class="lead" for="discount_percentage">Discount Percentage</label><br>
            <input class="form-control js-discount-percentage" type="number" id="discount_percentage" name="discount_percentage" value="" max=99>

        </div>

    </div>

    <div class="row text-center mt-5">

        <div class="col-lg-12">

            <button class="btn btn-primary js-update-discount-percentage">Update</button>

        </div>

    </div>

    <div class="row text-center mt-5 mb-5">

        <h2 class="mb-5 mt-5">Update currencies exchange rates</h2>

        <div class="offset-lg-3 col-lg-6">

            <button class="btn btn-primary js-update-exchange-rates">
                Update Exchange Rates
            </button>

        </div>


    </div>

    <script>

        $(document).ready(function () {

            let getCurrencyDiscountPercentageUrl = "{{ route('currency.get-discount-percentage') }}";
            let updateCurrencyDiscountUrl = "{{ route('currency.update-discount-percentage') }}";
            let updateCurrenciesExchangeRatesUrl = "{{ route('currency.update-exchange-rates') }}";

            $('.js-currency-id').change(function () {
                let currencyId = $('.js-currency-id').val();
                getCurrencyDiscountPercentage(getCurrencyDiscountPercentageUrl, currencyId);
            })

            $('.js-update-discount-percentage').click(function () {
                let currencyId = $('.js-currency-id').val();
                let discountPercentage = $('.js-discount-percentage').val();
                if (currencyId && discountPercentage && discountPercentage < 100) {
                    if (confirm('Are you sure you want to update the discount percentage?')) {
                        updateCurrencyDiscountPercentage(updateCurrencyDiscountUrl, currencyId, discountPercentage);
                    }
                }
                else {
                    alert('Please select a currency and enter a proper discount percentage')
                }
            })

            $('.js-update-exchange-rates').click(function () {
                updateCurrenciesExchangeRates(updateCurrenciesExchangeRatesUrl);
            })

        })

    </script>

@endsection
