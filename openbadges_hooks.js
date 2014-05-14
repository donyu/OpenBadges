( function( $, mw ) {
	'use strict';

	$( function( $ ) {
		var api = new mw.Api();

		api.post( {
			'action': 'openbadges-info',
			'format': 'json'
		} )
		.done( function ( data ) {
			$( '#mw-input-wpBadgeName' ).autocomplete( { source:data.availableBadges } );
			$( '#mw-input-wpName' ).autocomplete( { source:data.availableUsers } );
		} )
		.fail( function ( error ) {
			mw.notify( mw.message( error ).text() );
		} );

		$( '.badge-to-backpack-button' ).click( function( e ) {
			console.log($(e.target));
			var badgeHostUrl = window.location.origin + '/api.php?action=openbadges-host&obl_badge_id=' +
				$(e.target).context.id + '&obl_receiver=' + mw.user.getId() + '&format=json';
			console.log(badgeHostUrl);
			OpenBadges.issue( [ badgeHostUrl ], function( errors, successes ) { } );
		});
	} );

} )( jQuery, mediaWiki );
