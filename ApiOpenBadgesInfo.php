<?php

class ApiOpenBadgesInfo extends ApiBase {

	public function getDescription() {
		return 'Get json with available users and badges available to be issued.';
	}

	public function getVersion() {
		return __CLASS__ . ': $Id$';
	}

	public function isReadMode() {
		return true;
	}

	public function execute() {

		// run SQL query to get all badges that can be issued
		$dbr = wfGetDB( DB_SLAVE );
		$badgesRes = $dbr->select(
			'openbadges_class',
			'obl_name',
			'',
			__METHOD__,
			array()
		);

		// get the possible badges to issue
		$availableBadges = array();
		foreach( $badgesRes as $row ) {
		        $availableBadges[] = $row->obl_name;
		}
		$this->getResult()->addValue( null, 'availableBadges',  $availableBadges );

		// run SQL query to get all users who can get badges
		$usersRes = $dbr->select(
			'user',
			'user_name',
			'',
			__METHOD__,
			array()
		);

		// get the possible users to receive badges
		$availableUsers = array();
		foreach( $usersRes as $row ) {
		        $availableUsers[] = $row->user_name;
		}
		$this->getResult()->addValue( null, 'availableUsers',  $availableUsers );
	}
}
