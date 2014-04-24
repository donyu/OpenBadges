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

// Files
$wgAutoloadClasses['SpecialBadgeIssue'] = __DIR__ . '/SpecialBadgeIssue.php';
$wgAutoloadClasses['SpecialBadgeCreate'] = __DIR__ . '/SpecialBadgeCreate.php';
$wgAutoloadClasses['SpecialBadgeView'] = __DIR__ . '/SpecialBadgeView.php';
$wgExtensionMessagesFiles['OpenBadges'] = __DIR__ . '/OpenBadges.i18n.php';
$wgExtensionMessagesFiles['OpenBadgesAlias'] = __DIR__ . '/OpenBadges.i18n.alias.php';

// Special pages
$wgSpecialPages['BadgeIssue'] = 'SpecialBadgeIssue';
$wgSpecialPageGroups['BadgeIssue'] = 'other';
$wgSpecialPages['BadgeCreate'] = 'SpecialBadgeCreate';
$wgSpecialPageGroups['BadgeCreate'] = 'other';
$wgSpecialPages['BadgeView']= 'SpecialBadgeView';
$wgSpecialPageGroups['BadgeView'] = 'other';


// Hooks
$wgHooks['LoadExtensionSchemaUpdates'][] = 'createTable';

function createTable( DatabaseUpdater $dbU ) {
        $dbU->addExtensionTable( 'openbadges_assertion', __DIR__ .
                                 '/OpenBadgesAssertion.sql', true );
        $dbU->addExtensionTable( 'openbadges_class', __DIR__ .
                                 '/OpenBadgesClass.sql', true );
        return true;
}

/* Configuration */

