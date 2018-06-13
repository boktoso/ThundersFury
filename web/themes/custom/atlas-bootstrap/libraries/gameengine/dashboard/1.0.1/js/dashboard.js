var lastIndex = 0;
var sendingMessage = false;
(function ($) {

  $.ajax({
    url: '/getInitialLoad',
    success: function(data) {
      if(data.messages !== undefined) {
        lastIndex = data.lastIndex;
        var messages = data.messages;
        var textWrapper = $('#worldText');
        $.each(messages, function(k, msg){
          // Format the message
          addToWorldText(msg);
        });
        // set up the fuction to query every second
        setInterval(getNewMessages, 2000);
      } else {
        postErrorMessage();
      }
    },
    error: function(xhr) {
      postErrorMessage();
    }
  });

  function getNewMessages(){
    if(!sendingMessage) {
      $.ajax({
        url: '/getNewMessages/' + lastIndex,
        success: function(data) {
          lastIndex = data.lastIndex;
          var messages = data.messages;
          var textWrapper = $('#worldText');
          $.each(messages, function(k, msg){
            // Format the message
            addToWorldText(msg);
          });
        },
        error: function(xhr) {
          postErrorMessage();
        }
      });
    }
  }

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
    sendingMessage = true;
		$.ajax({
			url     : '/process',
			data    : info,
			type    : 'Post',
			headers : {'Content-Type': 'application/json'},
			success : function (data) {
        lastIndex = data.lastIndex;
				addToWorldText(data.message);
        sendingMessage = false;
			},
			error   : function (xhr, ajaxOptions, thrownError) {
				// processing the error and log the error
        sendingMessage = false;
				postErrorMessage();
			}
		});
	}

	function addToWorldText(msgData){
		var msgDate = moment(msgData.date);
		var msg = '<div class="message">';
		msgDateFormatted = msgDate.format('YYYY-MM-DD hh:mm:ss A')
		msg += '[' + msgDateFormatted + ']';
		msg += ' (' + msgData.author + ') ';
		msg += msgData.message;
		msg += '</div>';
		$('#worldText').append(msg);
		var element = document.getElementById('world-text-wrapper');
		element.scrollTop = element.scrollHeight - element.clientHeight;
	}

  function postErrorMessage(){
    var errorMsg = {
      date: new Date(),
      author: "SYSTEM",
      message: "There was an error sending the message."
    }
    addToWorldText(errorMsg);
  }
})(jQuery);
