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
		$this->setHeaders();
		$this->outputHeader();
		$formFields = array(
				'userfield' => array('label-message' => 'ob-badgemanager-user',
				'class' => 'HTMLTextField',
				'required' => true,
				),
				'badgefield' => array('label-message' => 'ob-badgemanager-type',
				'class' => 'HTMLTextField',
				'required' => true,
				),
				);
		$htmlForm = new HTMLForm($formFields, $this->getContext() );
		$htmlForm->setSubmitText(wfMessage('ob-badgemanager-submit'));
		$htmlForm->setSubmitCallback( array( 'BadgeManager', 'addBadge'));
		$htmlForm->show();
	}

        # TODO: Load Database table, then:
        # TODO: Add DB logic to give a new badge to a new user.
	static function addBadge( $formInput ) {
		#return false to redisplay the form, not sure how to 'refresh' the page
		return false;
	}
}
