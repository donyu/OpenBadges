<?php
/**
 * OpenBadges special page to assign new badges to users
 *
 * @file
 * @ingroup Extensions
 */

class SpecialBadgeIssue extends FormSpecialPage {
	/** @var LoginForm **/
	private $mLoginForm;

	function __construct() {
		parent::__construct( 'BadgeIssue' );
		$this->mLoginForm = new LoginForm();
	}

	/**
	 * @return string
	 */
	function getMessagePrefix() {
		return 'badge-issue';
	}

	/**
	 * @return bool
	 */
	function requiresWrite() {
		return true;
	}

	/**
	 * @return array form fields
	 */
	function getFormFields() {
		return array(
			'Name' => array(
				'type' => 'text',
				'label-message' => 'ob-issue-user',
				'required' => true,
			),
			'BadgeName' => array(
				'type' => 'text',
				'label-message' => 'ob-issue-type',
				'required' => true,
			),
		);
	}

	/**
	 * @param array $data
	 * @return Status|bool
	 */
	function onSubmit( array $data ) {
		$status = self::validateFormFields( $data );

		if ( !$status->isOK() ) {
			return $status;
		}


		// Inserts the new assertion into the database
		return wfGetDB( DB_MASTER )->insert(
			'openbadges_assertion',
			// TODO: correct insert fields for assertion
			// obl_timestamp => current time function call
			// obl_receiver => $status->value['Name']
			// obl_badge_id => $status->value['BadgeId']
			// obl_badge_title => $status->value['Image']
			array(
			),
			__METHOD__
		);
	}

	/**
	 * Validates whether the user and badge exists. Returns a good Status and
	 * the relevant Open Badge assertion fields if it does. Otherwise, returns
	 * an error Status.
	 *
	 * @return Status
	 */
	function validateFormFields( array $data ) {
		$status = Status::newGood();
		$fields = '*';

		$dbr = wfGetDB( DB_MASTER );
		$userRes = $dbr->select(
			'user',
			$fields,
			array( 'user_name' => $data['Name'] )
		);

		$badgeRes = $dbr->select(
			'openbadges_class',
			$fields,
			array( 'obl_name' => $data['BadgeName'] )
		);

		if ( $userRes === false || $badgeRes === false ) {
			$status->fatal('ob-db-error');
		}
		else if ( $userRes->numRows() == 1 && $badgeRes->numRows() == 1 ) {
			$assertionRes = array(
				'Receiver' => $userRes->user_name,
				'BadgeId' => $badgeRes->obl_badge_id,
				'Image' => $badgeRes->obl_badge_image,
			);
		}
		else {
			if ( $userRes->numRows() == 0) {
				$status->fatal( 'ob-db-user-not-found' );
			}
			if ( $userRes->numRows() > 0 ) {
				$status->fatal( 'ob-db-multiple-users' );
			}
			if ( $badgeRes->numRows() == 0 ) {
				$status->fatal( 'ob-db-badge-not-found' );
			}
		}

		return $status;
	}

	function onSuccess() {
		$this->output->addWikiMsg( 'ob-issue-success' );
	}


}
