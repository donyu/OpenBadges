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
		$this->mMaxUploadSize['file'] = UploadBase::getMaxUploadSize( 'file' );
		$selectedSourceType = strtolower( $this->getRequest()->getText( 'wpSourceType', 'File' ) );

		$formFields = array(
			'Image' => array(
				'class' => 'UploadSourceField',
				'section' => 'ob-create-badge-image',
				'type' => 'file',
				'id' => 'wpUploadFile',
				'radio-id' => 'wpSourceTypeFile',
				'label-message' => 'sourcefilename',
				'upload-type' => 'File',
				'radio' => &$radio,
				'help' => $this->msg( 'upload-maxfilesize',
					$this->getContext()->getLanguage()->formatSize( $this->mMaxUploadSize['file'] )
				)->parse() .
					$this->msg( 'word-separator' )->escaped() .
					$this->msg( 'upload_source_file' )->escaped(),
				'checked' => $selectedSourceType == 'file',
			),
			'Extensions' => array(
				'type' => 'info',
				'section' => 'ob-create-badge-image',
				'default' => $this->getExtensionsMessage(),
				'raw' => true,
			),
			'Name' => array(
				'label-message' => 'ob-create-badge-name',
				'section' => 'ob-create-badge-information',
				'type' => 'text',
				'required' => true,
				'validation-callback' => array( 'SpecialBadgeCreate', 'validateBadgeName' ),
			),
			'Description' => array(
				'label-message' => 'ob-create-badge-description',
				'section' => 'ob-create-badge-information',
				'type' => 'textarea',
				'required' => true,
				'cols' => 30,
				'rows' => 5,
			),
			'Criteria' => array(
				'section' => 'ob-create-badge-information',
				'label-message' => 'ob-create-badge-criteria',
				'type' => 'textarea',
				'required' => true,
				'cols' => 30,
				'rows' => 5,
			),
		);
		$htmlForm = new HTMLForm( $formFields, $this->getContext() );
		$htmlForm->addPreText( '<div id="ob-create-badge-text">' .
			$this->msg( 'ob-create-badge-text' ) . '</div>' );
		$htmlForm->setSubmitText(wfMessage( 'ob-create-badge-submit' ));
		$htmlForm->setSubmitCallback( array( 'SpecialBadgeCreate', 'createBadge' ) );
		$htmlForm->show();
	}

	/**
	 * Get the messages indicating which extensions are allowed for badge image
	 *
	 * @return string HTML string containing the message
	 */
	protected function getExtensionsMessage() {
		# Print a list of allowed file extensions, if so configured.  We ignore
		# MIME type here, it's incomprehensible to most people and too long.
		global $wgCheckFileExtensions, $wgStrictFileExtensions,
			$wgFileExtensions, $wgFileBlacklist;

		if ( $wgCheckFileExtensions ) {
			if ( $wgStrictFileExtensions ) {
				# Everything not permitted is banned
				$extensionsList =
					'<div id="mw-upload-permitted">' .
					$this->msg(
						'upload-permitted',
						$this->getContext()->getLanguage()->commaList( array_unique( $wgFileExtensions ) )
					)->parseAsBlock() .
					"</div>\n";
			} else {
				# We have to list both preferred and prohibited
				$extensionsList =
					'<div id="mw-upload-preferred">' .
						$this->msg(
							'upload-preferred',
							$this->getContext()->getLanguage()->commaList( array_unique( $wgFileExtensions ) )
						)->parseAsBlock() .
					"</div>\n" .
					'<div id="mw-upload-prohibited">' .
						$this->msg(
							'upload-prohibited',
							$this->getContext()->getLanguage()->commaList( array_unique( $wgFileBlacklist ) )
						)->parseAsBlock() .
					"</div>\n";
			}
		} else {
			# Everything is permitted.
			$extensionsList = '';
		}

		return $extensionsList;
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