<?php
/**
 * OpenBadges special page to assign new badges to users
 *
 * @file
 * @ingroup Extensions
 */

class SpecialBadgeIssue extends SpecialPage {
	public function __construct() {
		parent::__construct( 'BadgeIssue' );
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
			'userfield' => array(
				'label-message' => 'ob-issue-user',
				'class' => 'HTMLTextField',
				'required' => true,
			),
			'badgefield' => array(
			    'label-message' => 'ob-issue-type',
				'class' => 'HTMLTextField',
				'required' => true,
			),
		);
		$htmlForm = new HTMLForm($formFields, $this->getContext() );
		$htmlForm->setSubmitText(wfMessage('ob-issue-submit'));
		$htmlForm->setSubmitCallback( array( 'BadgeIssue', 'issueBadge'));
		$htmlForm->show();
	}

		# TODO: Load Database table, then:
		# TODO: Add DB logic to give a new badge to a new user.
	static function issueBadge( $formInput ) {
		#return false to redisplay the form, not sure how to 'refresh' the page
		return false;
	}
}
