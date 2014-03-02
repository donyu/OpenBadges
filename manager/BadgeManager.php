<?php
/**
 * OpenBadges special page to assign new badges to users
 *
 * @file
 * @ingroup Extensions
 */

class BadgeManager extends SpecialPage {
	public function __construct() {
		parent::__construct( 'BadgeManager' );
	}

	/**
	 * Shows the page to the user.
	 * @param string $sub: The subpage string argument (if any).
	 *  [[Special:BadgeManager/subpage]].
	 */
	public function execute( $sub ) {
		$out = $this->getOutput();
		$out->setPageTitle( $this->msg( 'BadgeManager' ) );
		$out->addWikiMsg( 'ob-manager-header' );
                $formFields = array(
                              'userfield' => array('label' => 'Username to Add',
                                                   'class' => 'HTMLTextField',
                                                   'required' => true,
						  ),
                              'badgefield' => array('label' => 'Name/Type of badge',
                                                    'class' => 'HTMLTextField',
                                                    'required' => true,
                                                  ),
                                   );
                $htmlForm = new HTMLForm($formFields, $this->getContext() );
                $htmlForm->setSubmitText( 'Award Badge to User');
                $htmlForm->setSubmitCallback( array( 'BadgeManager', 'addBadge'));
                $htmlForm->show();

	}

        # TODO: Load Database table, then:
        # TODO: Add DB logic to give a new badge to a new user.
        static function addBadge( $formInput ) {
                #return false to redisplay the form, not sure how to 'refresh' the page
                return false;
        }
        
        # TODO: Add DB logic to add a new type of badge to the database.
        static function addBadgeType( $formInput ) {
                return false;
        }

}
