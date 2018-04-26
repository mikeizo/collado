$(document).ready(function () {
	
	var menu = $('.navbar');
	var origOffsetY = menu.offset().top + 10;

	function scroll() {
		if ($(window).scrollTop() >= origOffsetY) {
			menu.addClass('fixed-top');
		} else {
			menu.removeClass('fixed-top');
		}
	}

	document.onscroll = scroll;

});