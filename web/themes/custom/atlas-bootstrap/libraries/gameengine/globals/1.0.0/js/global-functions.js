/**
 * @file
 * Global JS Functions.
 */

function createOverlay(text){
	jQuery.LoadingOverlay("show", {
		image: smallSpinner,
		imagePosition: "center 35vh",
		custom: "<h3>"+text+"</h3>"
	});
	return true;
}

function killOverlay() {
	jQuery.LoadingOverlay("hide");
	return true;
}

function displayErrorDialog(text) {
	jQuery("#errorDialog").find('#errorDialog--Content').html(text);
	jQuery("#errorDialog").find("#closeErrorDialog").off('click').on('click', function(){
		errorDialog.hide();
	});
	var errorDialog = AJS.dialog2("#errorDialog");
	errorDialog.show();
}

//please set table html attribute `data-ss="something"` to properly call this js
// ss is short for SharedSize
function resizeTables(sharedSize){
	var tableArr = jQuery('table[data-ss='+sharedSize+']');
	var cellWidths = new Array();
	jQuery(tableArr).each(function() {
		for(var j = 0; j < jQuery(this)[0].rows[0].cells.length; j++){
			var cell = jQuery(jQuery(this)[0].rows[0].cells[j]);
			if (!cellWidths[j] || cellWidths[j] < cell.width()) cellWidths[j] = cell.width();
		}
	});
	jQuery(tableArr).each(function() {
		for(var j = 0; j < jQuery(this)[0].rows[0].cells.length; j++){
			jQuery(this)[0].rows[0].cells[j].style.width = cellWidths[j]+'px';
		}
	});
}

jQuery.fn.removeInlineCss = (function(){
	var rootStyle = document.documentElement.style;
	var remover =
		rootStyle.removeProperty    // modern browser
		|| rootStyle.removeAttribute   // old browser (ie 6-8)
	return function removeInlineCss(properties){
		if(properties == null)
			return this.removeAttr('style');
		proporties = properties.split(/\s+/);
		return this.each(function(){
			for(var i = 0 ; i < proporties.length ; i++)
				remover.call(this.style, proporties[i]);
		});
	};
})();
