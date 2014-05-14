<?php

class ApiOpenBadgesHost extends ApiBase {

	public function getDescription() {
		return 'Get hosted assertion for an OpenBadge.';
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
			'obl_receiver' => array(
				ApiBase::PARAM_TYPE => 'integer',
				ApiBase::PARAM_REQUIRED => true
			),
		);
	}

	public function getParamDescription() {
		return array(
			'obl_badge_id' => 'OpenBadge received from Wikimedia',
			'obl_receiver' => 'User who received the OpenBadge.',
		);
	}

	public function execute() {
		$badgeID = $this->getMain()->getVal( 'obl_badge_id' );
		$receiverID = $this->getMain()->getVal( 'obl_receiver' );

		// run SQL query to get all relevant info for JSON
		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select(
			array( 'openbadges_assertion', 'user' ),
			array( 'obl_id', 'obl_timestamp', 'user_email' ),
			array(
				'obl_badge_id = ' . $badgeID,
				'obl_receiver = ' . $receiverID,
			),
			__METHOD__,
			array(),
			array(
				'user' => array(
					'INNER JOIN', array (
						'openbadges_assertion.obl_receiver=user.user_id'
					)
				)
			)
		);

		// get the unique identifier for this assertion
		$this->getResult()->addValue( null, 'uid',  $res->current()->obl_id );

		// get the date that the badge was issued on
		$this->getResult()->addValue( null, 'issuedOn', $res->current()->obl_timestamp );

		// add information about the recipient user
		$this->getResult()->addValue( null, 'recipient', array(
				'type' => 'email',
				'hashed' => false,
				'identify' => $res->current()->user_email,
			)
		);

		// get the url for the badge class JSON
		$this->getResult()->addValue( null, 'badge', 'unknown' );

		// set how the badge will be verified
		$this->getResult()->addValue( null, 'verify', array(
				'type' => 'hosted',
				'url' => 'unknown',
			)
		);
	}
}
