<?php
//currency converter Google api

	function currencyConverter($fromCurrency,$toCurrency,$amount) {
		$fromCurrency = urlencode($fromCurrency);
		$toCurrency = urlencode($toCurrency);
		$get = file_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$fromCurrency&to=$toCurrency");
		$get = explode("<span class=bld>",$get);
		$get = explode("</span>",$get[1]);
		$converted_currency = preg_replace("/[^0-9\.]/", null, $get[0]);
		return $converted_currency;
	}
	$fromCurrency = $_POST['fromCur'];
	$toCurrency = $_POST['toCur'];
	$amount = $_POST['amnt'];

	echo currencyConverter($fromCurrency,$toCurrency,$amount);
?>