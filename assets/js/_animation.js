(function ($, root, undefined) {

	$(function () {

		'use strict';

		// vars
		var scrolltimer;


		// Pageload
		toggle_topnav();
		setParallaxScroll();
		prepareProjects();

		// scroll handler
		$(window).scroll(function() {

			var scrolltimer = setTimeout(function (){

				toggle_topnav();
				setParallaxScroll();
			}, 50)
		});

		// functions
		function toggle_topnav() {

			if ( $(document).scrollTop() > 20 ) {
				$('body').addClass('scrolled');
			}
			else {
				$('body').removeClass('scrolled');
			}
			if ( $(document).scrollTop() > ($('.hero').outerHeight()/2) ) {
				$('body').addClass('scrolled_half_hero');
			}
			else {
				$('body').removeClass('scrolled_half_hero');
			}
			if ( $(document).scrollTop() > (($('.contact').offset().top - $('.contact').height())+$('.footer').height()) ) {
				$('body').addClass('scrolled_footer');
			}
			else {
				$('body').removeClass('scrolled_footer');
			}
		}

		function setParallaxScroll() {

			$('[data-parallax-multiplier]:visible').each( function() {

				var scrolled = $(window).scrollTop();
				var initY = $(this).offset().top;
				//var height = $(this).height();
				var multiplier = parseFloat($(this).attr('data-parallax-multiplier'));

				// Check if the element is in the viewport.
				if($(this).visible(true)) {
					var diff = scrolled - initY;
					var ratio = Math.round(diff/10);
					$(this).css('transform','translateY(' + parseInt(-(ratio * multiplier)) +'px)');
				}
			});
		}

		function prepareProjects() {
			if ( $('section.projects').length > 0 ) {
				$('body').append('<div class="project_popup"> </div>');
			}
		}

		// handlers
		$('.projects li').click(function(e){
			var project_info = $(this).html();

			$('.project_popup').html(project_info);
			$('body').addClass('popup_open');
			attachCloseHandler();
		});

		function attachCloseHandler() {

			// Project popup close button handler
			$('.project_popup .close').click(function(e){

				$('body').removeClass('popup_open');

			});
		}


	});

})(jQuery, this);
