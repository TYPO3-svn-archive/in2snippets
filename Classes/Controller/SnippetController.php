<?php

/***************************************************************
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
class Tx_In2snippets_Controller_SnippetController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * action search
	 *
	 * @return void
	 */
	public function searchAction() {
		$this->view->assign('pid', $GLOBALS['TSFE']->id);
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		if ($this->piVars['snippetSearch']) {
			$snippets = $this->snippetRepository->filterList($this->piVars['snippetSearch']);
		} else {
			$snippets = $this->snippetRepository->findAll();
		}
		$categories = $this->categoryRepository->findAll();
		
		$this->view->assign('snippets', $snippets);
		$this->view->assign('categories', $categories);
	}

	/**
	 * action list (called via AJAX)
	 *
	 * @return void
	 */
	public function listEidAction() {
		$this->listAction();
	}
	
	/**
	 * action detail
	 *
	 * @param Tx_In2snippets_Domain_Model_Snippet
	 * @return void
	 */
	public function detailAction(Tx_In2snippets_Domain_Model_Snippet $snippet) {
		$this->view->assign('snippet', $snippet);
	}

	/**
	 * action detail (called via AJAX)
	 *
	 * @return void
	 */
	public function detailEidAction() {
		$snippet = $this->snippetRepository->findByUid($this->piVars['snippet']);
		$this->view->assign('snippet', $snippet);
	}

	/**
	 * action rss -> shows the list in xml/rss
	 * 
	 * @return void
	 */
	public function rssAction() {
		$snippets = $this->snippetRepository->findAll();
		$this->view->assign('snippets', $snippets);
		$this->view->assign('storagePid', $this->configuration['persistence']['storagePid']);
	}
	
	/**
	 * updates the snippet object
	 *
	 * @param Tx_In2snippets_Domain_Model_Snippet
	 * @return void
	 */
	public function updateAction(Tx_In2snippets_Domain_Model_Snippet $snippet) {
		$newVote = $this->piVars['votenum'];
		$oldVotesSum = $snippet->getVotesCalc() * $snippet->getVotesCount(); // amount * voting
		$newVotesSum = $oldVotesSum + $newVote; // adding new voting
		$newVotesCount = $snippet->getVotesCount() + 1; // increasing amount
		$newVotesCalc = $newVotesSum / $newVotesCount; // geting new voting
		
		$snippet->setVotesCalc(floatval($newVotesCalc));
		$snippet->setVotesCount($newVotesCount);
		$this->snippetRepository->update($snippet);
		$GLOBALS['TSFE']->clearPageCacheContent_pidList($GLOBALS['TSFE']->id); // clearing cache after creation (because we don't want an uncached detail page)
		if (!t3lib_div::_GP('eID')) { // called classic
			$this->redirect('detail', 'Snippet', NULL, array('snippet' => $snippet));
			$this->flashMessageContainer->add('Thanks for voting!');
		} else { // AJAX called
			$this->view->assign('votesCount', $newVotesCalc);
		}
	}
	
	/**
	 * this action just validates the data and jumps in main-function: sendTemplateEmail
	 * 
	 * @return void
	 */
	public function sendMailAction() {
		$mail_rec = $this->piVars['mail'];
		$mail_sender = $this->piVars['mailOwn'];
		
		$snippet = $this->snippetRepository->findByUid($this->request->getArgument('snippet'));
		$GLOBALS['TSFE']->clearPageCacheContent_pidList($GLOBALS['TSFE']->id); // clearing cache after creation (because we don't want an uncached detail page)
		//Simple validation of the entered Email-Addresses
		if (empty($mail_rec) || empty($mail_sender)) {
			if (!t3lib_div::_GP('eID')) { // called classic
				$this->flashMessageContainer->add('You forgot to fill out both Email fields!');
				$this->redirect('detail', 'Snippet', NULL, array('snippet' => $snippet));
			}
		} elseif (!t3lib_div::validEmail($mail_rec) || !t3lib_div::validEmail($mail_sender)) {
			if (!t3lib_div::_GP('eID')) { // called classic
				$this->flashMessageContainer->add('Please enter a valid Email-Address in both fields!');
				$this->redirect('detail', 'Snippet', NULL, array('snippet' => $snippet));
			}
		} else {
			$this->utility = t3lib_div::makeInstance('Tx_In2snippets_Utility_Utility');			
			//Sending Tip to Tip-Recipient
			$this->utility->sendTemplateEmail(
				array(
					$mail_rec => 'Recipient Name'
				),
				array(
					$this->settings['tipafriend']['senderEmail'] => $this->settings['tipafriend']['senderName'],
				),
				$this->settings['tipafriend']['subject'],
				$this->settings['tipafriend']['templateName'],
				$this->objectManager,
				$this->configurationManager,
				array(
					'text' => $this->piVars['text'],
					'email' => $this->piVars['mail'],
					'emailOwn' => $this->piVars['mailOwn'],
					'snippet' => $snippet,
				)
			);

			//Sending Confirmation to Sender
			$this->utility->sendTemplateEmail(
				array(
					$this->piVars['mailOwn'] => 'Recipient Name'
				),
				array(
					$this->settings['tipafriend']['senderEmail'] => $this->settings['tipafriend']['senderName'],
				),
				$this->settings['tipafriend']['subjectConf'],
				$this->settings['tipafriend']['templateNameConf'],
				$this->objectManager,
				$this->configurationManager,
				array(
					'text' => $this->piVars['text'],
					'email' => $this->piVars['mail'],
					'emailOwn' => $this->piVars['mailOwn'],
					'snippet' => $snippet
				)
			);
			if (!t3lib_div::_GP('eID')) { // called classic
				$this->flashMessageContainer->add('Your tip was sent!');
				$this->redirect('detail', 'Snippet', NULL, array('snippet' => $snippet));
			}
		}
	}
	
	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->piVars = $this->request->getArguments();

		// error if no storagePid
		$this->configuration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		if (empty($this->configuration['persistence']['storagePid'])) {
			$this->flashMessageContainer->add($this->extensionName . ': No Storage PID given. Please add a storage page in the plugin or constants!');
		}
		// error if no staticTemplate
		if (!isset($this->configuration['settings']['staticTemplate'])) {
			$this->flashMessageContainer->add($this->extensionName . ': TypoScript Template is missing. Please include the static template!');
		}

		// enable different repositories
		$this->snippetRepository = t3lib_div::makeInstance('Tx_In2snippets_Domain_Repository_SnippetRepository');
		$this->categoryRepository = t3lib_div::makeInstance('Tx_In2snippets_Domain_Repository_CategoryRepository');
	}

}

?>