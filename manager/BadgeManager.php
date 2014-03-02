<?php
/**
 * OpenBadges special page to assign new badges to users
 *
 * @file
 * @ingroup Extensions
 */

class BadgeManager extends SpecialPage {
	public function __construct() {
		parent::__construct( 'BadgeManager' );
	}

	/**
	 * Shows the page to the user.
	 * @param string $sub: The subpage string argument (if any).
	 *  [[Special:BadgeManager/subpage]].
	 */
	public function execute( $sub ) {
		$out = $this->getOutput();

		$out->setPageTitle( $this->msg( 'BadgeManager' ) );
		$out->addWikiMsg( 'ob-manager-header' );
	}
}
