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
class Tx_In2snippets_Domain_Model_Comment extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * creator
	 *
	 * @var string
	 */
	protected $creator;
	
	/**
	 * text
	 *
	 * @var string
	 */
	protected $text;
	
	/**
	 * www
	 *
	 * @var string
	 */
	protected $www;
	
	/**
	 * creation date
	 *
	 * @var DateTime
     * @validate NotEmpty
	 */
	protected $crdate;
	
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
	 * Returns the creator
	 *
	 * @return string $creator
	 */
	public function getCreator() {
		return $this->creator;
	}

	/**
	 * Sets the creator
	 *
	 * @param string $creator
	 * @return void
	 */
	public function setCreator($creator) {
		$this->creator = $creator;
	}

	/**
	 * Returns the text
	 *
	 * @return string $text
	 */
	public function getText() {
		return $this->text;
	}

	/**
	 * Sets the text
	 *
	 * @param string $text
	 * @return void
	 */
	public function setText($text) {
		$this->text = $text;
	}

	/**
	 * Returns the Website
	 *
	 * @return string $www
	 */
	public function getWww() {
		return $this->www;
	}

	/**
	 * Sets the Website
	 *
	 * @param string $www
	 * @return void
	 */
	public function setWww($www) {
		$this->www = $www;
	}

	/**
	 * Returns the creation date
	 *
	 * @return DateTime $crdate
	 */
	public function getCrdate() {
		return $this->crdate;
	}

	/**
	 * Sets the creation date
	 *
	 * @param DateTime $crdate
	 * @return void
	 */
	public function setCrdate($crdate) {
		$this->crdate = $crdate;
	}
	
	/**
	 * Returns the Snippet-Object
	 *
	 * @return Tx_In2snippets_Domain_Model_Snippet $snippet
	 */
	public function getSnippet() {
		return $this->snippet;
	}

	/**
	 * Sets the snippet-objects
	 *
	 * @param Tx_In2snippets_Domain_Model_Snippet $snippet
	 * @return void
	 */
	public function setSnippet($snippet) {
		$this->snippet = $snippet;
	}


}

?>