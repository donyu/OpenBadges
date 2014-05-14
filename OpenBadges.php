<?php
/**
 * OpenBadges Extension. Based on Mozilla OpenBadges
 *
 *
 *
 * @file
 * @ingroup Extensions
 * @author chococookies, and the rest
 * @license GNU General Public Licence 2.0 or later
 */

$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'OpenBadges',
	'author' => array(
		'chococookies',
		'Don Yu',
		'Stephen Zhou',
	),
	'version'  => '0.1',
	'url' => 'https://www.mediawiki.org/wiki/OpenBadges',
	'descriptionmsg' => 'ob-desc',
);

// Files
$wgAutoloadClasses['SpecialBadgeIssue'] = __DIR__ . '/SpecialBadgeIssue.php';
$wgAutoloadClasses['SpecialBadgeCreate'] = __DIR__ . '/SpecialBadgeCreate.php';
$wgAutoloadClasses['SpecialBadgeView'] = __DIR__ . '/SpecialBadgeView.php';
$wgAutoloadClasses['ApiOpenBadgesHost'] = __DIR__ . '/ApiOpenBadgesHost.php';
$wgAutoloadClasses['ApiOpenBadgesInfo'] = __DIR__ . '/ApiOpenBadgesInfo.php';
$wgAutoloadClasses['ApiOpenBadgesClass'] = __DIR__ . '/ApiOpenBadgesClass.php';
$wgAutoloadClasses['ApiOpenBadgesCriteria'] = __DIR__ . '/ApiOpenBadgesCriteria.php';
$wgAutoloadClasses['ApiOpenBadgesIssuer'] = __DIR__ . '/ApiOpenBadgesIssuer.php';
$wgMessagesDirs['OpenBadges'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['OpenBadges'] = __DIR__ . '/OpenBadges.i18n.php';
$wgExtensionMessagesFiles['OpenBadgesAlias'] = __DIR__ . '/OpenBadges.i18n.alias.php';

// Map module name to class name
$wgAPIModules['openbadges-host'] = 'ApiOpenBadgesHost';
$wgAPIModules['openbadges-info'] = 'ApiOpenBadgesInfo';
$wgAPIModules['openbadges-badge-class'] = 'ApiOpenBadgesClass';
$wgAPIModules['openbadges-issuer'] = 'ApiOpenBadgesIssuer';
$wgAPIModules['openbadges-badge-criteria'] = 'ApiOpenBadgesCriteria';

// Special pages
$wgSpecialPages['BadgeIssue'] = 'SpecialBadgeIssue';
$wgSpecialPageGroups['BadgeIssue'] = 'other';
$wgSpecialPages['BadgeCreate'] = 'SpecialBadgeCreate';
$wgSpecialPageGroups['BadgeCreate'] = 'other';
$wgSpecialPages['BadgeView']= 'SpecialBadgeView';
$wgSpecialPageGroups['BadgeView'] = 'other';

// Permissions
// TODO: Add custom create and issue groups
$wgGroupPermissions['sysop']['issuebadge'] = true;
$wgGroupPermissions['sysop']['createbadge'] = true;
$wgGroupPermissions['user']['viewbadge'] = true;
$wgAvailableRights[] = array(
	'issuebadge',
	'createbadge',
	'viewbadge'
);

$wgResourceModules['ext.openbadges'] = array(
	'scripts' => array( 'openbadges_hooks.js' ),
	'styles' => array( 'openbadges.css' ),
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'OpenBadges',
);

// Register hooks
$wgHooks['LoadExtensionSchemaUpdates'][] = 'createTable';
$wgHooks['BeforePageDisplay'][] = 'efAddOpenBadgesModule';

// Function to hook up our tables
function createTable( DatabaseUpdater $dbU ) {
        $dbU->addExtensionTable( 'openbadges_assertion', __DIR__ . '/OpenBadgesAssertion.sql', true );
        $dbU->addExtensionTable( 'openbadges_class', __DIR__ . '/OpenBadgesClass.sql', true );
        return true;
}

/**
 * Add the Persona module to the OutputPage.
 *
 * @param OutputPage &$out
 *
 * @return bool true
 */
function efAddOpenBadgesModule( OutputPage &$out ) {

	$out->addModules( 'ext.openbadges' );
	$out->addHeadItem( 'openbadges-jquery-ui-js',
		Html::linkedScript( 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js' ) );
	$out->addHeadItem( 'openbadges-issuer-api',
		Html::linkedScript( 'https://backpack.openbadges.org/issuer.js' ) );
	$out->addHeadItem( 'openbadges-jquery-ui-css',
		Html::linkedStyle( 'https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css' ) );
	return true;
}
