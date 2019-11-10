(function ($, root, undefined) {

	$(function () {

		'use strict';

		// vars
		var scrolltimer;


		// Pageload
		toggle_topnav();


		// scroll handler
		$(window).scroll(function() {

			var scrolltimer = setTimeout(function (){

				toggle_topnav();
			}, 50)
		});

		// functions
		function toggle_topnav() {

			if ( $(document).scrollTop() > 40 ) {
				$('body').addClass('scrolled');
			}
			else  {
				$('body').removeClass('scrolled');
			}
		}

	});

})(jQuery, this);
