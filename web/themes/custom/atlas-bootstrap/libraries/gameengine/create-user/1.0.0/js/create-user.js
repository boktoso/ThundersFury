// preset class sets
var greenCheck = 'fa fa-check green-color';
var redX = 'fa fa-times red-color';
var spinner = 'fa fa-spinner fa-spin grey-color';

(function ($){
	// check if username is not taken
	$('#username').on('change', function(){
		if($(this).val().length > 3){
			var testUsername = $(this).val();
			var icon = $('#username-icon');
			icon
				.removeClass(greenCheck)
				.removeClass(redX)
				.addClass(spinner);
			$.ajax({
				url     : '/checkusername/' + testUsername,
				method  : 'GET',
				success : function(data) {
					if (data.available == true){
						// name is available
						icon
							.removeClass(spinner)
							.addClass(greenCheck);
					} else {
						// name is taken
						icon
							.removeClass(spinner)
							.addClass(redX);
					}
				},
				error   : function(xhr) {
					console.log(xhr);
					icon
						.removeClass(spinner)
						.addClass(redX);
				}
			})
		} else {
			var icon = $('#username-icon');
			icon
				.removeClass(greenCheck)
				.removeClass(redX)
				.removeClass(spinner);
		}
	});
	
	// check if character name is not taken
	
})(jQuery);