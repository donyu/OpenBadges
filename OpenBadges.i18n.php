<?php
/**
 * Internationalisation file for OpenBadges
 *
 * @file
 * @ingroup Extensions
 */
// Use ob- for all OpenBadges related messages.

$messages = array();

/** English
 */
$messages['en'] = array(
	'ob-desc' => 'Extension to implement Mozilla OpenBadges',
	'badgecreate' => 'Create a Badge',
	'ob-create-badge-submit' => 'Add badge to Database',
	'ob-create-badge-name' => 'Badge Name',
	'ob-create-badge-description' => 'Badge Description',
	'ob-create-badge-image' => 'Badge Image Upload',
	'ob-create-badge-criteria' => 'Badge Criteria for Earning',
	'badgeview' => 'My Badges',
	'ob-view-submit' => 'Display badges',
	'ob-view-user' => 'Username',
	'badgeissue' => 'Issue a Badge',
	'badge-issue-legend' => 'Issue a badge to a user',
	'ob-issue-submit' => 'Assign Badge',
	'ob-issue-user' => 'Username',
	'ob-issue-type' => 'Badge',
	'ob-db-user-not-found' => 'User doesn\'t exist',
	'ob-db-multiple-users' => 'Multiple users exist',
	'ob-db-badge-not-found' => 'Badge doesn\'t exist',
	'ob-db-unknown-error' => 'Unknown database error',
	'ob-issue-success' => 'Badge issued successfully',
);

/** Message documentation (Message documentation)
 * @author chococookies
 */
$messages['qqq'] = array(
	'ob-desc' => 'Short description of the openbadges extension (implements Mozilla OpenBadges',
	'badgecreate' => 'Describe that this page to add new types of badges to the database.',
	'ob-create-submit' => 'Form submit button, adds badge to database',
	'ob-create-name' => 'Form field, name designation for a new badge',
	'ob-create-info' => 'Form field, badge information for new badge added',
	'badgeview' => 'Describe that this page is to view badges assigned to a user',
	'ob-view-submit' => 'Form submit button to display badges',
	'ob-view-user' => 'Username, form field. View badges from this user',
	'badgeissue' => 'Describe that this special page is to add, edit, or modify badge assignments to users.',
	'badge-issue-legend' => 'Legend field for SpecialBadgeIssue',
	'ob-issue-submit' => 'Form submit button, assign badge to the username',
	'ob-issue-user' => 'Username, form field',
	'ob-issue-type' => 'Name or type of badge, form field to input the name of the badge that will be assigned.',
	'ob-db-user-not-found' => 'Error message if user does not exist',
	'ob-db-multiple-users' => 'Error message if multiple users exist',
	'ob-db-badge-not-found' => 'Error message if badge does not exist',
	'ob-db-unknown-error' => 'Error message for unknown database error',
	'ob-issue-success' => 'Success message for badge issue',
);
