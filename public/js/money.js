$(document).ready(function() {
    $("#moneyInput, #money_input, .currency_input, .money").maskMoney({ thousands:'.', decimal:',', affixesStay: false, precision: 0});
});