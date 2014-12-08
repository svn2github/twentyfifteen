( function( $ ) {
	var $body   = $( 'body' ),
	    $window = $( window );

	/**
	 * Add a body class for less than 955 viewport.
	 * This is only for Custom Colors that doesn't handle media queries.
	 */
	function bodyClass() {
		if ( $window.width() <= 954 ) {
			$body.addClass( 'small-screen' );
		} else {
			$body.removeClass( 'small-screen' );
		}
	}

	function debouncedBodyClass() {
		var timeout;
		return function() {
			clearTimeout( timeout );
			timeout = setTimeout( function() {
				timeout = null;
				bodyClass();
			}, 150 );
		};
	}

	$( document ).ready( function() {
		$window
			.on( 'load.twentyfifteen', bodyClass() )
			.on( 'resize.twentyfifteen', debouncedBodyClass() );
	} );

} )( jQuery );
