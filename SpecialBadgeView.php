<?php
/**
 * OpenBadges special page to view all the badges assigned to a user.
 *
 * @file
 * @ingroup Extensions
 */

class SpecialBadgeView extends SpecialPage {
	public function __construct() {
		parent::__construct( 'BadgeView' );
	}

	/**
	 * Shows the page to the user.
	 * @param string $sub: The subpage string argument (if any).
	 *  [[Special:BadgeManager/subpage]].
	 */
	public function execute( $sub ) {
		$this->setHeaders();
		$this->outputHeader();
		$html = $this->getOutput();

		$userId = $this->getUser()->getId();

		$dbr = wfGetDB( DB_SLAVE );
		$badgeRes = $dbr->select(
			array( 'openbadges_assertion', 'openbadges_class' ),
			array( 'obl_name', 'openbadges_assertion.obl_badge_image' ),
			'obl_receiver = ' . $userId,
			__METHOD__,
			array(),
			array( 'openbadges_class' => array( 'INNER JOIN', array (
				'openbadges_assertion.obl_badge_id=openbadges_class.obl_badge_id' ) ) )
		);

		$htmlList = '<ul>';
		foreach ( $badgeRes as $row ) {
			$htmlList .= "<li><p>$row->obl_name</p><img src=\"$row->obl_badge_image\" /></li>";
			$htmlList .= '<button>Issue badge to backpack</button>';
		}
		$htmlList .= '</ul>';
		$html->addHTML( $htmlList );
	}

    # TODO: Load Database table, then:
    # TODO: Display all the badges a user has.
	static function viewBadges( $formInput ) {
		#return false to redisplay the form, not sure how to 'refresh' the page
		return false;
	}
}
