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
class Tx_In2snippets_Domain_Model_User extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * username
	 *
	 * @var string
	 */
	protected $username;

	
	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		die('ingetname');
		return 'x'.$this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the username
	 *
	 * @return string $username
	 */
	public function getUsername() {
		return 'x'.$this->username;
	}

	/**
	 * Sets the username
	 *
	 * @param string $username
	 * @return void
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
		die('test');
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->comments = new Tx_Extbase_Persistence_ObjectStorage();
		$this->categories = new Tx_Extbase_Persistence_ObjectStorage();
		$this->codes = new Tx_Extbase_Persistence_ObjectStorage();
		$this->snippets = new Tx_Extbase_Persistence_ObjectStorage();
	}
}

?>