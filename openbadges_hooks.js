( function( $, mw ) {
	'use strict';

	$( function( $ ) {
		var api = new mw.Api();

		api.post( {
			'action': 'openbadges-info',
			'format': 'json'
		} )
		.done( function ( data ) {
			$('#mw-input-wpBadgeName').autocomplete( { source:data.availableBadges } );
			$('#mw-input-wpName').autocomplete( { source:data.availableUsers } );
		} )
		.fail( function ( error ) {
			mw.notify( mw.message( error ).text() );
		} );
	} );

} )( jQuery, mediaWiki );
