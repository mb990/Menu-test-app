<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Order Details</h1>
    <p>Currency: {{ $order->currency->name }}</p>
    <p>Exchange Rate: {{ $order->exchange_rate }}</p>
    <p>Surcharge %: {{ $order->surcharge_percentage }}</p>
    <p>Surcharge Amount: {{ round($order->surcharge_amount, 6) }}</p>
    <p>Amount Purchased: {{ round($order->amount_purchased, 6) }}</p>
    <p>Amount Payed (in USD): {{ round($order->amount_payed_usd, 6) }}</p>
    <p>Discount %: {{ $order->discount_percentage }}</p>
    <p>Discount Amount: {{ round($order->discount_amount, 6) }}</p>
    <p>Date: {{ date('Y-m-d', strtotime($order->created_at)) }}</p>
</body>
</html>
