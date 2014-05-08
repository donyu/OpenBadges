<?php
/**
 * OpenBadges special page to add new badge types to the database.
 *
 * @file
 * @ingroup Extensions
 */

class SpecialBadgeCreate extends SpecialPage {

	public function __construct() {
		parent::__construct( 'BadgeCreate', 'createbadge' );
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

		$formFields = array(
			'Name' => array(
				'label-message' => 'ob-create-badge-name',
				'type' => 'text',
				'required' => true,
				'validation-callback' => array( 'SpecialBadgeCreate', 'validateBadgeName' ),
			),
			'Image' => array(
				'label-message' => 'ob-create-badge-image',
				'type' => 'text',
				'required' => true,
			),
			'Description' => array(
				'label-message' => 'ob-create-badge-description',
				'type' => 'textarea',
				'required' => true,
				'cols' => 30,
				'rows' => 5,
			),
			'Criteria' => array(
				'label-message' => 'ob-create-badge-criteria',
				'type' => 'textarea',
				'required' => true,
				'cols' => 30,
				'rows' => 5,
			),
		);
		$htmlForm = new HTMLForm( $formFields, $this->getContext() );
		$htmlForm->setSubmitText(wfMessage( 'ob-create-badge-submit' ));
		$htmlForm->setSubmitCallback( array( 'SpecialBadgeCreate', 'createBadge' ) );
		$htmlForm->show();
	}

	static function createBadge( $data ) {
		$badgeName = $data['Name'];
		$badgeImage = $data['Image'];
		$badgeDescription = $data['Description'];
		$badgeCriteria = $data['Criteria'];

		// Inserts the new badge class into the database
		$dbw = wfGetDB( DB_MASTER );
		$dbw->begin();
		$result = $dbw->insert(
			'openbadges_class',
			array(
				'obl_name' => $badgeName,
				'obl_description' => $badgeDescription,
				'obl_badge_image' => $badgeImage,
				'obl_criteria' => $badgeCriteria,
			),
			__METHOD__
		);
		$dbw->commit();
		return $result;
	}

	static function validateBadgeName( $nameTextField, $data ) {
		$dbr = wfGetDB( DB_SLAVE );
		// TODO check for duplicate badge name here
		return true;
	}

}