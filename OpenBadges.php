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
$wgAutoloadClasses['ApiOpenBadges'] = __DIR__ . '/ApiOpenBadges.php';
$wgMessagesDirs['OpenBadges'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['OpenBadges'] = __DIR__ . '/OpenBadges.i18n.php';
$wgExtensionMessagesFiles['OpenBadgesAlias'] = __DIR__ . '/OpenBadges.i18n.alias.php';

// Map module name to class name
$wgAPIModules['openbadges'] = 'ApiOpenBadges';

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

// Register hooks
$wgHooks['LoadExtensionSchemaUpdates'][] = 'createTable';

// Function to hook up our tables
function createTable( DatabaseUpdater $dbU ) {
        $dbU->addExtensionTable( 'openbadges_assertion', __DIR__ . '/OpenBadgesAssertion.sql', true );
        $dbU->addExtensionTable( 'openbadges_class', __DIR__ . '/OpenBadgesClass.sql', true );
        return true;
}
