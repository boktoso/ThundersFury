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
	
	// if the user clicks on the world text wrapper
	// have their focus go to the user input field
	$(".world-text-wrapper").on('click', function(){
		$("#userInput").focus();
	});
	
	$("#userInput").on('keyup', function(e){
		if(e.keyCode == 13){
			var usermessage = $(this).val();
			// don't process empty string
			if (usermessage != ''){
				$(this).val('');
				var split = usermessage.split(" ");
				var action = split[0];
				var target = 'none';
				if(split.length > 1){
					target = split[1];
				}
				addToWorldText(usermessage);
				processMessage(action, target);
			}
		}
	});
	
	function processMessage(action, target){
		var info = {
			'action' : action,
			'target' : target
		};
		info = JSON.stringify(info);
		$.ajax({
			url     : '/process',
			data    : info,
			type    : 'Post',
			headers : {'Content-Type': 'application/json'},
			success : function (data) {
				addToWorldText(data.message);
			},
			error   : function (xhr, ajaxOptions, thrownError) {
				// processing the error and log the error
				addToWorldText('SYSTEM: There was an error processing the action.');
			}
		});
	}
	
	function addToWorldText(message){
		var msg = '<div class="message">';
		msg += message;
		msg += '</div>';
		$('#worldText').append(msg);
	}
})(jQuery);