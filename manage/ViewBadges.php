<?php
/**
 * OpenBadges special page to view all the badges assigned to a user.
 *
 * @file
 * @ingroup Extensions
 */

class ViewBadges extends SpecialPage {
	public function __construct() {
		parent::__construct( 'ViewBadges' );
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
				'userfield' => array('label-message' => 'ob-viewbadges-user',
				'class' => 'HTMLTextField',
				'required' => true,),
				);
		$htmlForm = new HTMLForm($formFields, $this->getContext() );
		$htmlForm->setSubmitText(wfMessage('ob-viewbadges-submit'));
		$htmlForm->setSubmitCallback( array( 'ViewBadges', 'viewBadges'));
		$htmlForm->show();
	}

        # TODO: Load Database table, then:
        # TODO: Display all the badges a user has.
        static function viewBadges( $formInput ) {
                #return false to redisplay the form, not sure how to 'refresh' the page
                return false;
        }
}
