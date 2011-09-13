<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'snippet'
);

//$pluginSignature = str_replace('_','',$_EXTKEY) . '_' . pi1;
//$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
//t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_' .pi1. '.xml');






t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/Main', 'Main Template');
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/AJAX', 'AJAX');
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/RSS', 'RSS Feed');
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/CSS', 'Default CSS');


t3lib_extMgm::addLLrefForTCAdescr('tx_in2snippets_domain_model_category', 'EXT:in2snippets/Resources/Private/Language/locallang_csh_tx_in2snippets_domain_model_category.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_in2snippets_domain_model_category');
$TCA['tx_in2snippets_domain_model_category'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:in2snippets/Resources/Private/Language/locallang_db.xml:tx_in2snippets_domain_model_category',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Category.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_in2snippets_domain_model_category.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_in2snippets_domain_model_snippet', 'EXT:in2snippets/Resources/Private/Language/locallang_csh_tx_in2snippets_domain_model_snippet.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_in2snippets_domain_model_snippet');
$TCA['tx_in2snippets_domain_model_snippet'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:in2snippets/Resources/Private/Language/locallang_db.xml:tx_in2snippets_domain_model_snippet',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Snippet.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_in2snippets_domain_model_snippet.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_in2snippets_domain_model_comment', 'EXT:in2snippets/Resources/Private/Language/locallang_csh_tx_in2snippets_domain_model_comment.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_in2snippets_domain_model_comment');
$TCA['tx_in2snippets_domain_model_comment'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:in2snippets/Resources/Private/Language/locallang_db.xml:tx_in2snippets_domain_model_comment',
		'label' => 'creator',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Comment.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_in2snippets_domain_model_comment.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_in2snippets_domain_model_code', 'EXT:in2snippets/Resources/Private/Language/locallang_csh_tx_in2snippets_domain_model_code.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_in2snippets_domain_model_code');
$TCA['tx_in2snippets_domain_model_code'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:in2snippets/Resources/Private/Language/locallang_db.xml:tx_in2snippets_domain_model_code',
		'label' => 'type',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Code.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_in2snippets_domain_model_code.gif'
	),
);

?>