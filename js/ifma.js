// ifma.js

(function($){

	//deprecated - do not use
	function matchheightTimer(i) {

		// get heights
		var e1 = $('#container'),
			e2 = $('#sidebar'),
			e3 = $('#nav-sidebar'),
			e4 = $('#secondary'),
			e5 = $('#content'),
			h1 = e1.height(),
			h2 = e2.height(),
			h3 = e3.height(),
			sidebarCompensation = 26, // sidebar padding, margins, borders total
			contentCompensation = 30, // content padding, margins, borders total
			t = 10; // max number of checks where heights match
			p = 100; // period interval to check heights

		if ( $('body').hasClass('page-gallery') ) {
			p = 250; // longer interval for slower loading pages
		}


		if ( h1 == h2 && i >= t ) {
			// if heights match we check up to 't' times (counter below)
			return true;
		}
		else if ( h1 > h2 ) { // if container is taller than sidebar
			e2.height( h1 ); // set sidebar equal to container height
			if ( e3.length ) {
				e4.height( h1 - h3 - ( 2 * sidebarCompensation + 10 ) );
			}
			else {
				e4.height( h1 - sidebarCompensation );
			}
		}
		else if ( h2 > h1 ) { // if sidebar is taller than container
			e1.height( h2 ); // set container equal to sidebar height
			e5.height( h2 - contentCompensation );
			i = 0; // reset counter
		}
		else {
			// if heights match increment counter
			i++;
		}


		setTimeout( function(){
			matchheight( i );
		}, p);

	}

	function matchheight() {

		// get heights
		var e1 = $('#container'),
			e2 = $('#sidebar'),
			e3 = $('#nav-sidebar'),
			e4 = $('#secondary'),
			e5 = $('#content'),
			h1 = e1.height(),
			h2 = e2.height(),
			h3 = e3.height(),
			sidebarCompensation = 26, // sidebar padding, margins, borders total
			contentCompensation = 30; // content padding, margins, borders total

		if ( h1 == h2 ) {
			// if heights match we check up to 't' times (counter below)
			return true;
		}
		else if ( h1 > h2 ) { // if container is taller than sidebar
			e2.height( h1 ); // set sidebar equal to container height
			if ( e3.length ) {
				e4.height( h1 - h3 - ( 2 * sidebarCompensation + 10 ) );
			}
			else {
				e4.height( h1 - sidebarCompensation );
			}
			return true;
		}
		else if ( h2 > h1 ) { // if sidebar is taller than container
			e1.height( h2 ); // set container equal to sidebar height
			e5.height( h2 - contentCompensation );
			return true;
		}

		return false;

	}

	$(window).bind("load", function() {
		matchheight();
	});


})(jQuery);
