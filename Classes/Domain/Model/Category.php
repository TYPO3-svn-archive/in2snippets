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
class Tx_In2snippets_Domain_Model_Category extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;
	
	/**
	 * snippet
	 *
	 * @var Tx_In2snippets_Domain_Model_Snippet
	 */
	protected $snippet;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * returns a snippet object from the repository
	 * 
	 * @return Tx_In2snippets_Domain_Model_Snippet
	 */
	public function getSnippet() {
		$search = t3lib_div::_GP('tx_in2snippets_pi1');
		
		$snippetRepository = t3lib_div::makeInstance('Tx_In2snippets_Domain_Repository_SnippetRepository');
		return $snippetRepository->filterListAndCat($search['snippetSearch'], $this->getUid()); // get all snippets within this cat
	}

	/**
	 * Sets the snippet
	 * 
	 * @param Tx_In2snippets_Domain_Model_Snippet $snippet
	 * @return void
	 */
	public function setSnippet($snippet) {
		$this->snippet = $snippet;
	}
}

?>