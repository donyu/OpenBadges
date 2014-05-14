<?php

class ApiOpenBadgesClass extends ApiBase {

	public function getDescription() {
		return 'Get information about a badge and what it means within OpenBadges.';
	}

	public function getVersion() {
		return __CLASS__ . ': $Id$';
	}

	public function isReadMode() {
		return true;
	}

	public function getAllowedParams() {
		return array(
			'obl_badge_id' => array(
				ApiBase::PARAM_TYPE => 'integer',
				ApiBase::PARAM_REQUIRED => true
			),
		);
	}

	public function getParamDescription() {
		return array(
			'obl_badge_id' => 'OpenBadge received from Wikimedia',
		);
	}

	public function execute() {
		global $wgServer;

		$badgeID = $this->getMain()->getVal( 'obl_badge_id' );

		// run SQL query to get all relevant info for badge id 
		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select(
			'openbadges_class',
			array( 'obl_name', 'obl_description', 'obl_badge_image', 'obl_criteria' ),
			'obl_badge_id = ' . $badgeID,
			__METHOD__,
			array()
		);

		// get the unique identifier for this badge 
		$this->getResult()->addValue( null, 'name',  $res->current()->obl_name );

		// get the description for this badge
		$this->getResult()->addValue( null, 'description', $res->current()->obl_description );

		// add url for the image associated with badge
		$this->getResult()->addValue( null, 'image', $res->current()->obl_badge_image );

		// get the criteria for the badge class JSON
		$this->getResult()->addValue( null, 'criteria', $res->current()->obl_criteria );

		// set the issuer which is us
		$this->getResult()->addValue( null, 'issuer', 
			"$wgServer/api.php?action=openbadges-issuer&format=json"
		);
	}
}
