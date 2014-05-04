<?php
/**
 * OpenBadges special page to view all the badges assigned to a user.
 *
 * @file
 * @ingroup Extensions
 */

class SpecialBadgeView extends SpecialPage {
	public function __construct() {
		parent::__construct( 'BadgeView', 'viewbadge' );
	}

	/**
	 * Shows the page to the user.
	 * @param string $sub: The subpage string argument (if any).
	 *  [[Special:BadgeManager/subpage]].
	 */
	public function execute( $sub ) {
		$this->setHeaders();
		$this->checkPermissions();
		$this->outputHeader();

		$html = $this->getOutput();
		$html->addHtml( $this->getBadgeHtml() );
	}

	public function getBadgeHtml() {
		global $wgUser;

		$userId = $wgUser->getId();

		$dbr = wfGetDB( DB_SLAVE );
		$badgeRes = $dbr->select(
			array( 'openbadges_assertion', 'openbadges_class' ),
			array( 'obl_name', 'openbadges_assertion.obl_badge_image' ),
			'obl_receiver = ' . $userId,
			__METHOD__,
			array(),
			array(
				'openbadges_class' => array(
					'INNER JOIN', array (
						'openbadges_assertion.obl_badge_id=openbadges_class.obl_badge_id' ) ) )
		);

		$badgeLi = '';
		foreach ( $badgeRes as $row ) {
			$badgeName = Html::element( 'p', array(), $row->obl_name );
			$badgeImage = Html::rawElement(
				'img',
				array( 'src' => $row->obl_badge_image, 'height' => 160, )
			);
			$addButton = Html::rawElement( 'button', array(), 'Add badge to Backpack');
			$badgeLi .= Html::rawElement( 'li', array(), $badgeName . $badgeImage . $addButton );
		}

		$badgeUl = Html::rawElement( 'ul', array(), $badgeLi );

		return $badgeUl;
	}

}
