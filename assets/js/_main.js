(function ($, root, undefined) {

	$(function () {

		'use strict';

		var scrolltimer;

		// scroll handler
		$(window).scroll(function() {

			var scrolltimer = setTimeout(function (){
				var scrollTop = $(document).scrollTop();

				console.log(scrollTop);

				if (scrollTop > 40) {
					$('body').addClass('scrolled');
				}
				else  {
					$('body').removeClass('scrolled');
				}

				// if (scrollTop > 100) {
				// 	$('body').addClass('scrolled_hard');
				// }
				// else  {
				// 	$('body').removeClass('scrolled_hard');
				// }
			}, 50)
		});

	});

})(jQuery, this);

console.log('loaded');
