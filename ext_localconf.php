<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Pi1',
	array(
		'Snippet' => 'search, list, detail, sendMail, update, rss, listEid, detailEid',
		'Comment' => 'new, create',
		
	),
	// non-cacheable actions
	array(
		'Snippet' => 'search, list, sendMail, update, rss, listEid, detailEid',
		'Comment' => 'new, create',
	)
);

// AJAX call - show list view below search field
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['in2snippets_search'] = 'EXT:in2snippets/Classes/Utility/SnippetsEidSearch.php';

// AJAX call - show detail view below search field
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['in2snippets_detail'] = 'EXT:in2snippets/Classes/Utility/SnippetsEidDetail.php';

// AJAX call - add comment
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['in2snippets_comment'] = 'EXT:in2snippets/Classes/Utility/SnippetsEidComment.php';

// AJAX call - tip a friend
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['in2snippets_tipafriend'] = 'EXT:in2snippets/Classes/Utility/SnippetsEidTipafriend.php';

// AJAX call - vote
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['in2snippets_vote'] = 'EXT:in2snippets/Classes/Utility/SnippetsEidVote.php';

?>