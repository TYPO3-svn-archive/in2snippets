<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_in2snippets_domain_model_snippet'] = array(
	'ctrl' => $TCA['tx_in2snippets_domain_model_snippet']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, tags, comments, categories, codes, votes_count, votes_calc, cruser_id',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, description;;;richtext, tags, comments, categories, codes, votes_count, votes_calc, cruser_id,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_in2snippets_domain_model_snippet',
				'foreign_table_where' => 'AND tx_in2snippets_domain_model_snippet.pid=###CURRENT_PID### AND tx_in2snippets_domain_model_snippet.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:in2snippets/Resources/Private/Language/locallang_db.xml:tx_in2snippets_domain_model_snippet.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:in2snippets/Resources/Private/Language/locallang_db.xml:tx_in2snippets_domain_model_snippet.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim,required',
				'wizards' => array(
        			'_PADDING' => 4,
        			'RTE' => array(
        				'notNewRecords' => 1,
        				'RTEonly' => 1,
        				'type' => 'script',
        				'title' => 'LLL:EXT:cms/locallang_ttc.php:bodytext.W.RTE',
        				'icon' => 'wizard_rte2.gif',
        				'script' => 'wizard_rte.php',
        			),
        		),
			),
		),
		'tags' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:in2snippets/Resources/Private/Language/locallang_db.xml:tx_in2snippets_domain_model_snippet.tags',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'comments' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:in2snippets/Resources/Private/Language/locallang_db.xml:tx_in2snippets_domain_model_snippet.comments',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_in2snippets_domain_model_comment',
				'foreign_field' => 'snippet',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapse' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'categories' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:in2snippets/Resources/Private/Language/locallang_db.xml:tx_in2snippets_domain_model_snippet.categories',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_in2snippets_domain_model_category',
				'MM' => 'tx_in2snippets_snippet_category_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'minitems' => 1,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_in2snippets_domain_model_category',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'codes' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:in2snippets/Resources/Private/Language/locallang_db.xml:tx_in2snippets_domain_model_snippet.codes',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_in2snippets_domain_model_code',
				'foreign_field' => 'snippet',
				'maxitems'      => 9999,
				'minitems'=> 1
			),
		),
		'crdate' => Array (
            'exclude' => 1,
            'label' => 'LLL:EXT:in2snippets/Resources/Private/Language/locallang_db.xml:tx_in2snippets_domain_model_snippet.crdate',
            'config' => Array (
                'type' => 'none',
                'format' => 'date',
                'eval' => 'date',
            )
        ),
		'cruser_id' => Array (
            'exclude' => 1,
            'label' => 'LLL:EXT:in2snippets/Resources/Private/Language/locallang_db.xml:tx_in2snippets_domain_model_snippet.cruser_id',
            'config' => Array (
                'type' => 'select',
				'foreign_table' => 'be_users',
				'foreign_field' => 'uid',
				'maxitems' => 1
            )
        ),
		'votes_count' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:in2snippets/Resources/Private/Language/locallang_db.xml:tx_in2snippets_domain_model_snippet.votes_count',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'readOnly' => 1
			),
		),
		'votes_calc' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:in2snippets/Resources/Private/Language/locallang_db.xml:tx_in2snippets_domain_model_snippet.votes_calc',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'readOnly' => 1
			),
		),
	),
);
?>