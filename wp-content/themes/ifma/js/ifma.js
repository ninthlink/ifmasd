// ifma.js

(function($){

	function matchheight(i) {

		// get heights
		var e1 = $('#container'),
			e2 = $('#sidebar'),
			e3 = $('#sidebar #nav-sidebar'),
			e4 = $('#sidebar #primary'),
			e5 = $('#sidebar #secondary'),
			h1 = e1.height(),
			h2 = e2.height(),
			sb = 0,
			sn = 0,
			t = 10; // max number of checks where heights match

		if ( h1 == h2 && i >= t ) {
			// if heights match we check up to 't' times (counter below)
			return true;
		}
		else if ( h1 > h2 ) { // if container is taller than sidebar
			e2.height( h1 ); // set sidebar equal to container height
			var h = 0;
			if (e3.length > 0 ) {
				h += e3.height() + 10 + 16 + 10;
			}
			if (e4.length > 0 ) {
				h += e4.height() + 10 + 16 + 10;
			}
			e5.height( h1 - ( h + 26 ) );
		}
		else if ( h2 > h1 ) { // if sidebar is taller than container
			e1.height( h2 ); // set container equal to sidebar height
			i = 0; // reset counter
		}
		else {
			// if heights match increment counter
			i++;
		}

		setTimeout( function(){
			matchheight( i );
		}, 100);

	}

	matchheight( 0 );

})(jQuery);

