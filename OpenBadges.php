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
	'descriptionmsg' => 'openbadges-desc',
);


/* Setup */

$dir = dirname( __FILE__ );

// Register files
$wgAutoloadClasses['BadgeManager'] = $dir . '/manager/BadgeManager.php';
$wgExtensionMessagesFiles['OpenBadges'] = $dir . '/OpenBadges.i18n.php';
$wgExtensionMessagesFiles['OpenBadgesAlias'] = $dir . '/OpenBadges.i18n.alias.php';

// Register special pages
$wgSpecialPages['BadgeManager'] = 'BadgeManager';
$wgSpecialPageGroups['BadgeManager'] = 'other';


/* Configuration */

