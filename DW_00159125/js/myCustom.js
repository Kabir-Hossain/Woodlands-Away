	function changeSideBarTitle(){
		//var tempVar = document.getElementById('shop-name-side-bar').innerHTML;
		var tempVar = $('#shop-name-side-bar').html();
		//document.getElementById('shop-name-side-bar').innerHTML = myVar;
		$('#shop-name-side-bar').html(tempVar);
		myVar = tempVar;
	}


	$('#shop-name-side-bar').click(function(){
		var tempVar = $('#shop-name-side-bar').html();
		$('#shop-name-side-bar').html(myVar);
		myVar = tempVar;
	});

	$('#currency').change(function(){
	$('.package-base-price').each(function(){
		var toCurrency = $('#currency').val();
		
		var pPriceObj = $(this);
		var amount = pPriceObj.val();
		if(toCurrency != 'GBP'){
			$.ajax({
				method: "POST",
				url: "googleCurrencyConverter.php",
				data: { toCur: toCurrency, fromCur: fromCurrency, amnt: amount}
			}).done(function( price ) {
				pPriceObj.siblings('.package-price').html(price);
				//alert( "Data: " + msg );
			});
		}else{
			pPriceObj.siblings('.package-price').html(amount);
		}
	});
});