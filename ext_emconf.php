<?php

########################################################################
# Extension Manager/Repository config file for ext "in2snippets".
#
# Auto generated 21-09-2011 13:42
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'in2snippets',
	'description' => 'A little extension for adding and searching/filtering Code-Snippets.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '0.1.2',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'alpha',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'David Richter',
	'author_email' => 'david.richter@in2code.de',
	'author_company' => 'in2code',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.5.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:78:{s:12:"ext_icon.gif";s:4:"e91a";s:17:"ext_localconf.php";s:4:"2367";s:14:"ext_tables.php";s:4:"6ce5";s:14:"ext_tables.sql";s:4:"0197";s:10:"index.html";s:4:"d41d";s:40:"Classes/Controller/CommentController.php";s:4:"eff2";s:40:"Classes/Controller/SnippetController.php";s:4:"69bc";s:33:"Classes/Domain/Model/Category.php";s:4:"a637";s:29:"Classes/Domain/Model/Code.php";s:4:"07a3";s:32:"Classes/Domain/Model/Comment.php";s:4:"4e5e";s:32:"Classes/Domain/Model/Snippet.php";s:4:"d768";s:29:"Classes/Domain/Model/User.php";s:4:"6a17";s:48:"Classes/Domain/Repository/CategoryRepository.php";s:4:"a103";s:47:"Classes/Domain/Repository/CommentRepository.php";s:4:"c574";s:47:"Classes/Domain/Repository/SnippetRepository.php";s:4:"c074";s:38:"Classes/Utility/SnippetsEidComment.php";s:4:"bcec";s:37:"Classes/Utility/SnippetsEidDetail.php";s:4:"2645";s:37:"Classes/Utility/SnippetsEidSearch.php";s:4:"fa4d";s:41:"Classes/Utility/SnippetsEidTipafriend.php";s:4:"4388";s:35:"Classes/Utility/SnippetsEidVote.php";s:4:"c047";s:27:"Classes/Utility/Utility.php";s:4:"7da4";s:43:"Classes/ViewHelpers/CdataWrapViewHelper.php";s:4:"37d6";s:56:"Classes/ViewHelpers/HtmlSpecialCharsEncodeViewHelper.php";s:4:"9428";s:42:"Classes/ViewHelpers/MarkTermViewHelper.php";s:4:"f559";s:47:"Classes/ViewHelpers/RssDateFormatViewHelper.php";s:4:"18a2";s:30:"Configuration/TCA/Category.php";s:4:"7f27";s:26:"Configuration/TCA/Code.php";s:4:"9ec7";s:29:"Configuration/TCA/Comment.php";s:4:"fb2b";s:29:"Configuration/TCA/Snippet.php";s:4:"624f";s:39:"Configuration/TypoScript/AJAX/setup.txt";s:4:"36ec";s:38:"Configuration/TypoScript/CSS/setup.txt";s:4:"0de6";s:43:"Configuration/TypoScript/Main/constants.txt";s:4:"96b7";s:39:"Configuration/TypoScript/Main/setup.txt";s:4:"e05c";s:42:"Configuration/TypoScript/RSS/constants.txt";s:4:"2375";s:38:"Configuration/TypoScript/RSS/setup.txt";s:4:"f0a1";s:40:"Resources/Private/Language/locallang.xml";s:4:"8e77";s:81:"Resources/Private/Language/locallang_csh_tx_in2snippets_domain_model_category.xml";s:4:"66fe";s:77:"Resources/Private/Language/locallang_csh_tx_in2snippets_domain_model_code.xml";s:4:"821e";s:80:"Resources/Private/Language/locallang_csh_tx_in2snippets_domain_model_comment.xml";s:4:"3f0a";s:80:"Resources/Private/Language/locallang_csh_tx_in2snippets_domain_model_snippet.xml";s:4:"10d0";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"be5c";s:35:"Resources/Private/Layouts/Ajax.html";s:4:"3562";s:38:"Resources/Private/Layouts/Default.html";s:4:"f5b3";s:50:"Resources/Private/Partials/Snippet/Properties.html";s:4:"b063";s:44:"Resources/Private/Templates/Comment/New.html";s:4:"7315";s:57:"Resources/Private/Templates/Comment/NotificationMail.html";s:4:"c874";s:47:"Resources/Private/Templates/Snippet/Detail.html";s:4:"01c2";s:50:"Resources/Private/Templates/Snippet/DetailEid.html";s:4:"8391";s:45:"Resources/Private/Templates/Snippet/List.html";s:4:"21b7";s:48:"Resources/Private/Templates/Snippet/ListEid.html";s:4:"c554";s:45:"Resources/Private/Templates/Snippet/Mail.html";s:4:"cd28";s:49:"Resources/Private/Templates/Snippet/MailConf.html";s:4:"911c";s:44:"Resources/Private/Templates/Snippet/Rss.html";s:4:"f5a6";s:47:"Resources/Private/Templates/Snippet/Search.html";s:4:"36ed";s:49:"Resources/Private/Templates/Snippet/SendMail.html";s:4:"64d4";s:47:"Resources/Private/Templates/Snippet/Update.html";s:4:"4fbd";s:44:"Resources/Public/CSS/in2snippets_default.css";s:4:"45d1";s:32:"Resources/Public/Icons/icons.png";s:4:"d4c1";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:63:"Resources/Public/Icons/tx_in2snippets_domain_model_category.gif";s:4:"1103";s:59:"Resources/Public/Icons/tx_in2snippets_domain_model_code.gif";s:4:"1103";s:62:"Resources/Public/Icons/tx_in2snippets_domain_model_comment.gif";s:4:"1103";s:62:"Resources/Public/Icons/tx_in2snippets_domain_model_snippet.gif";s:4:"1103";s:41:"Resources/Public/Icons/Stuff/quote_48.png";s:4:"3e83";s:44:"Resources/Public/Icons/Stuff/star_filled.png";s:4:"4bb1";s:44:"Resources/Public/Icons/Stuff/star_normal.png";s:4:"e712";s:39:"Resources/Public/JS/in2snippets_ajax.js";s:4:"f165";s:44:"Resources/Public/JS/in2snippets_essential.js";s:4:"bc0c";s:50:"Resources/Public/Tools/SyntaxHighlighter/demo.html";s:4:"4fcb";s:67:"Resources/Public/Tools/SyntaxHighlighter/jquery.beautyOfCode-min.js";s:4:"0edd";s:63:"Resources/Public/Tools/SyntaxHighlighter/jquery.beautyOfCode.js";s:4:"1d0d";s:47:"Tests/Unit/Controller/CommentControllerTest.php";s:4:"d27f";s:47:"Tests/Unit/Controller/SnippetControllerTest.php";s:4:"f8ad";s:40:"Tests/Unit/Domain/Model/CategoryTest.php";s:4:"14be";s:36:"Tests/Unit/Domain/Model/CodeTest.php";s:4:"1782";s:39:"Tests/Unit/Domain/Model/CommentTest.php";s:4:"a7d1";s:39:"Tests/Unit/Domain/Model/SnippetTest.php";s:4:"d92a";s:14:"doc/manual.sxw";s:4:"c518";}',
	'suggests' => array(
	),
);

?>