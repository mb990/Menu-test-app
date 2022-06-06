window.getCurrencyDiscountPercentage = function (url, currencyId) {

    $.ajax({
        url: url,
        data: {
            currencyId: currencyId
        },
        success: function (data) {
            $('.js-discount-percentage').val(data.discountPercentage);
        }
    })
}

window.updateCurrencyDiscountPercentage = function (url, currencyId, discountPercentage) {
    $.ajax({
        method: 'PUT',
        url: url,
        data: {
            currencyId: currencyId,
            discountPercentage: discountPercentage
        },
        success: function (data) {
            alert(data.message);
        }
    })
}

window.updateCurrenciesExchangeRates = function (url) {
    $.ajax({
        method: 'PUT',
        url: url,
        success: function (data) {
            alert(data.message);
        }
    })
}
