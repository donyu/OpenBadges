<?php
/**
 * OpenBadges special page to add new badge types to the database.
 *
 * @file
 * @ingroup Extensions
 */

class AddBadge extends SpecialPage {
	public function __construct() {
		parent::__construct( 'AddBadge' );
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
				'userfield' => array('label-message' => 'ob-addbadge-name',
						'class' => 'HTMLTextField',
						'required' => true,
						),
				'badgefield' => array('label-message' => 'ob-addbadge-info',
						'class' => 'HTMLTextField',
						'required' => true,
						),
				);
		$htmlForm = new HTMLForm($formFields, $this->getContext() );
		$htmlForm->setSubmitText(wfMessage('ob-addbadge-submit'));
		$htmlForm->setSubmitCallback( array( 'AddBadge', 'addBadgeType'));
		$htmlForm->show();
	}

        # TODO: Load Database table, then:
        # TODO: Add DB logic to add a new badge to the database
  static function addBadgeType( $formInput ) {
		#return false to redisplay the form, not sure how to 'refresh' the page
    return false;
  }
}
