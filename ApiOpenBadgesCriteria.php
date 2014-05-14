<?php

class ApiOpenBadgesCriteria extends ApiBase {

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
			array( 'obl_criteria' ),
			'obl_badge_id = ' . $badgeID,
			__METHOD__,
			array()
		);

		// get the criteria for the badge class JSON
		$this->getResult()->addValue( null, 'criteria', $res->current()->obl_criteria );
	}
}
