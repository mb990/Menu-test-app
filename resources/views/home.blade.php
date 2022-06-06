@extends('layouts.app')

@section('title')

    {{ config('app.name', 'Laravel') }}

@endsection


@section('content')



        <div class="row text-center mt-4">

            <div class="col-lg-4">

                <label class="lead" for="currencyId">Currencies:</label>
                <select class="form-control js-currency" name="currencyId">
                    @forelse($currencies as $key => $currency)

                        <option value="{{ $currency->id }}">{{ $currency->name }} ({{ $currency->shortcut }})</option>

                    @empty

                    @endforelse
                </select>

            </div>

            <div class="col-lg-4">

                <label for="amount" class="lead">Amount to exchange:</label>
                <input class="form-control js-amount" type="number" name="amount" value="0" min="1">

            </div>

            <div class="col-lg-4">

                <label for="amountToPay" class="lead">Amount to pay (USD):</label>
                <input class="form-control js-amount-to-pay" name="amountToPay" value="0" type="number" disabled>

            </div>

        </div>

        <div class="row text-center mt-5">

            <div class="col-lg-12">

                <button type="submit" class="btn btn-primary js-purchase">Purchase</button>

            </div>

        </div>

    <script>

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let currencyIdSelector = $('.js-currency');
            let amountSelector = $('.js-amount');
            let amountToPaySelector = $('.js-amount-to-pay');

            let currencyId = currencyIdSelector.val();
            let amount = amountSelector.val();
            let amountToPay = amountToPaySelector.val();

            function calculateAmountToPay() {
                $.ajax({
                    url: "{{ route('order.amount-to-pay') }}",
                    data: {
                        currencyId: currencyId,
                        amount: amount,
                    },
                    success: function (data) {
                        amountToPay = data.amountToPay;
                        amountToPaySelector.val(amountToPay);
                    }
                });
            }

            function purchase() {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('order.purchase') }}",
                    data: {
                        currencyId: currencyId,
                        amount: amount,
                        amountToPay: amountToPay
                    },
                    success: function (data) {
                        alert(data.message);
                    }
                });
            }


            currencyIdSelector.change(function () {
               currencyId = $(this).val();
                if (amount > 0) {
                    calculateAmountToPay();
                }
            });

           amountSelector.on('input', function () {
               amount = $(this).val();
               if (amount > 0) {
                   calculateAmountToPay();
               }
           })


            $('.js-purchase').click(function () {

                if (amount && amount > 0) {
                    if (confirm('Are you sure you want to proceed with the purchase?') && amount > 0) {
                        purchase();
                    }
                }
                else {
                    alert('Please enter the amount')
                }
            })

        })

    </script>

@endsection
