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
class Tx_In2snippets_Domain_Model_Code extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * type
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $type;
	/**
	 * code
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $code;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		
	}
		
	/**
	 * Returns the faketype (because we 'highlight' typoscript as 'plain' and jquery as 'javascript')
	 *
	 * @return integer $type
	 */
	public function getFaketype() {
		$faketype = $this->type;
		if ($faketype == 'typoscript') {
			$faketype = 'plain';
		}
		if ($faketype == 'jquery') {
			$faketype = 'javascript';
		}
		return $faketype;
	}
	
	/**
	 * Returns the type
	 *
	 * @return integer $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type
	 *
	 * @param integer $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Returns the code
	 *
	 * @return string $code
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * Sets the code
	 *
	 * @param string $code
	 * @return void
	 */
	public function setCode($code) {
		$this->code = $code;
	}

}

?>