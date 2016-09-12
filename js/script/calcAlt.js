$(window).load(function(){
	$(".sideAdmin >ul >li >ul >li").each(function() {
	  $(this).find('div >div').css({"height": $(this).height(), "margin-top": -($(this).height())})
	});
});