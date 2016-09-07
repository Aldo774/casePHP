$(window).load(function(){
	$(".sideAdmin >ul >li >ul >li").each(function() {
	  console.log($(this).height());
	  $(this).find('div >div').css({"height": $(this).height(), "margin-top": -($(this).height())})
	});
/*	$(".sideAdmin >ul >li >ul >li div >div").one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',   
    function(){
	    $('.sideAdmin >ul >li >ul >li div >div').animate({
	        width: '0%'
	    }, 1000);    	
    }*/
});