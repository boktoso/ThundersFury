(function ($) {
	$.each($(document).find(".main-wrapper"), function(){
		// set the height of the sidebar-wrapper and -sidebar-inner-wrapper
		$(this).height($(window).height() - $("#wrapper2").offset().top);
		$(".main-inner-wrapper").height($(this).height() - 5);
		
		$(".world-text-wrapper").height($(this).height() - $(".user-text-wrapper").height());
	});
	
	$(window).resize(function(){
		// set the height of the sidebar-wrapper and -sidebar-inner-wrapper
		$(".main-wrapper").height($(window).height() - $("#wrapper2").offset().top);
		$(".main-inner-wrapper").height($(".main-wrapper").height() - 5);
		
		$(".world-text-wrapper").height($(".main-wrapper").height() - $(".user-text-wrapper").height());
	});
})(jQuery);