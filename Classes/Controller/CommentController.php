<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 David Richter <david.richter@in2code.de>, in2code
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 *
 *
 * @package in2snippets
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_In2snippets_Controller_CommentController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * Repository for snippets
	 * 
	 * @var Tx_In2snippets_Domain_Repository_SnippetRepository $snippetRepository
	 */
	protected $snippetRepository;

	/**
	 * action new
	 *
	 * @param Tx_In2snippets_Domain_Model_Snippet $snippet
	 * @param Tx_In2snippets_Domain_Model_Comment $newComment
	 * @dontvalidate $newComment
	 * @return void
	 */
	public function newAction(Tx_In2snippets_Domain_Model_Snippet $snippet, Tx_In2snippets_Domain_Model_Comment $newComment = NULL) {
		$this->view->assign('newComment', $newComment);
		$this->view->assign('snippet', $snippet);
	}

	/**
	 * action create
	 *
	 * @param Tx_In2snippets_Domain_Model_Comment $newComment
	 * @dontvalidate $newComment
	 * @return void
	 */
	public function createAction(Tx_In2snippets_Domain_Model_Comment $newComment) {
		$snippet = $this->snippetRepository->findByUid($this->request->getArgument('snippet'));
		$GLOBALS['TSFE']->clearPageCacheContent_pidList($GLOBALS['TSFE']->id); // clearing cache after creation (because we don't want an uncached detail page)

		//Simple validation of the entered data
		if (!$newComment->getCreator() || !$newComment->getText()) { // if no text or sender
			if (!t3lib_div::_GP('eID')) { // called classic
				$this->flashMessageContainer->add('You forgot to fill out some fields!');
				$this->redirect('detail', 'Snippet', NULL, array('snippet' => $snippet));
			}
		} else { // all ok
			$snippet_creator = $this->snippetRepository->getBeNameFromSnippetId($snippet->getUid());
			$mail_rec = $snippet_creator['email'];
			if ($mail_rec) {
				//Sending comment-notification to snippet creator
				$this->utility = t3lib_div::makeInstance('Tx_In2snippets_Utility_Utility');
				$this->utility->sendTemplateEmail(
					array(
						$mail_rec => 'Recipient Name'
					),
					array(
						$this->settings['commentNotification']['senderEmail'] => $this->settings['commentNotification']['senderName'],
					),
					$this->settings['commentNotification']['subject'],
					$this->settings['commentNotification']['templateName'],
					$this->objectManager,
					$this->configurationManager,
					array(
						'creator' => $newComment->getCreator(),
						'text' => $newComment->getText(),
						'www' => $newComment->getWww(),
						'snippet' => $snippet,
					)
				);
			}
			$snippet->addComment($newComment);
			
			if (!t3lib_div::_GP('eID')) { // called classic
				$this->flashMessageContainer->add('Your new Comment was created.');
				$this->redirect('detail', 'Snippet', NULL, array('snippet' => $snippet));
			}
		}
	}
	
	/**
	 * 
	 * @param Tx_In2snippets_Domain_Repository_SnippetRepository $snippetRepository 
	 */
	public function injectSnippetRepository(Tx_In2snippets_Domain_Repository_SnippetRepository $snippetRepository) {
		$this->snippetRepository = $snippetRepository;
	}
	
	/**
	 * 
	 * @param Tx_In2snippets_Utility_Utility $utility 
	 */
	public function injectUtility(Tx_In2snippets_Utility_Utility $utility) {
		$this->utility = $utility;
	}
}

?>