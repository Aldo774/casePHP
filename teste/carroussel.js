$(function(){
	var width = (parseInt($('.carrossel .item').outerWidth() + parseInt($('.carrossel .item').css('margin-right')))) * $('.carrossel .item').length;
	$('.carrossel').css('width', width);

	var numImages = 1;
	var MarginPadding = 30;
	var ident = 0;
	var count = ($('.carrossel .item').length / numImages) - 1;
	var slide = (numImages * MarginPadding) + ($('.carrossel img').outerWidth() * numImages);

	$('.forth').click(function(){		
		if(ident < count){
		console.log(count);
		console.log(ident);			
			ident++;
			$('.carrossel').animate({'margin-left': '-=' + slide + 'px'}, '500');	
		}
	});

	$('.back').click(function(){
		if(ident >= 1){
		console.log(count);
		console.log(ident);			
			ident--;
			$('.carrossel').animate({'margin-left': '+=' + slide + 'px'}, '500');	
		}
	});

	function automatizar(segundos) {
		var back = null;
	 
		var auto = setInterval(function () {
			if ($('.carrossel').css('margin-left') === '0px') {
				ident = '0';
			}
	 
			if (ident < count && back === null) {
				ident++;
				$('.carrossel').animate({'margin-left': '-=' + slide + 'px'}, 500);
			} else {
				if (ident === 1) {
					back = null;
				} else {
					back = true;
				}
				
				ident--;
				$('.carrossel').animate({'margin-left': '+=' + slide + 'px'}, 500);
			}
	 
			$('.forth, .back').click(function () {
				clearInterval(auto);
			});
		}, segundos * 1000);
	}

	//automatizar(2);	

});