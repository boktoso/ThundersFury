(function ($) {
	
	$(document).on('ready' function(){
		$.ajax({
			url: '/getInitialLoad',
			success: function(data) {
				var messages = data.messages;
				var textWrapper = $('#worldText');
				$.each(messages, function(k, msg){
					// Format the message
					addToWorldText(msg);
				});
			},
			error: function(xhr) {
			
			}
		});
	});
	
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
				// Leave looks here for future whisper and specific chat hooks
				var action = 'generalmessage';
				var msgData = {
					message: usermessage
				}
				processMessage(action, msgData);
			}
		}
	});
	
	function processMessage(action, msgData){
		var info = {
			'action' : action,
			'msgData' : msgData
		};
		info = JSON.stringify(info);
		$.ajax({
			url     : '/process',
			data    : info,
			type    : 'Post',
			headers : {'Content-Type': 'application/json'},
			success : function (data) {
				addToWorldText(data.message);
				if(data.logout == true){
					setTimeout(function(){
						location.reload(true);
					}, 1000);
				}
			},
			error   : function (xhr, ajaxOptions, thrownError) {
				// processing the error and log the error
				
				addToWorldText('[' + moment().format('YYYY-MM-DD hh:mm:ss A') + '] (SYSTEM) There was an error processing the action.');
			}
		});
	}
	
	function addToWorldText(msgData){
		var msgDate = moment(msgData.date);
		var msg = '<div class="message">';
		msgDateFormatted = msgDate.format('YYYY-MM-DD hh:mm:ss A')
		msg += '[' + msgDateFormatted + ']';
		msg += ' (' + msgData.author + ') ';
		msg += message;
		msg += '</div>';
		$('#worldText').append(msg);
		var element = document.getElementById('world-text-wrapper');
		element.scrollTop = element.scrollHeight - element.clientHeight;
	}
})(jQuery);
