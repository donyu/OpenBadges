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
	),
	'version'  => '0.1',
	'url' => 'https://www.mediawiki.org/wiki/OpenBadges',
	'descriptionmsg' => 'ob-desc',
);

/* Setup */

$dir = __DIR__;

// Register files
$wgAutoloadClasses['BadgeManager'] = $dir . '/manage/BadgeManager.php';
$wgAutoloadClasses['AddBadge'] = $dir . '/manage/AddBadge.php';
$wgAutoloadClasses['ViewBadges'] = $dir . '/manage/ViewBadges.php';
$wgExtensionMessagesFiles['OpenBadges'] = $dir . '/OpenBadges.i18n.php';
$wgExtensionMessagesFiles['OpenBadgesAlias'] = $dir . '/OpenBadges.i18n.alias.php';

// Register special pages
$wgSpecialPages['BadgeManager'] = 'BadgeManager';
$wgSpecialPageGroups['BadgeManager'] = 'other';
$wgSpecialPages['AddBadge'] = 'AddBadge';
$wgSpecialPageGroups['AddBadge'] = 'other';
$wgSpecialPages['ViewBadges'] = 'ViewBadges';
$wgSpecialPageGroups['ViewBadges'] = 'other';


// Register hooks
$wgHooks['LoadExtensionSchemaUpdates'][] = 'createTable';

// Function to hook up our tables
function createTable( DatabaseUpdater $dbU ) {
        $dbU->addExtensionTable( 'openbadges_assertion', __DIR__ .
                                 '/OpenBadgesAssertion.sql', true );
        $dbU->addExtensionTable( 'openbadges_class', __DIR__ .
                                 '/OpenBadgesClass.sql', true );
        return true;
}

/* Configuration */

