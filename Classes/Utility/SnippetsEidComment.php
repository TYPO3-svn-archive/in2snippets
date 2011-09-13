<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 David Richter <david.richter@in2code.de>, in2code.de
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
***************************************************************/

/**
* This class could called with AJAX via eID and should store the kind of view
*
* @author David Richter <david.richter@in2code.de>, in2code.
* @package TYPO3
* @subpackage snippetsEidSearch
*/
class snippetsEidComment {

	/**
	* configuration
	*
	* @var array
	*/
	protected $configuration;

	/**
	* bootstrap
	*
	* @var array
	*/
	protected $bootstrap;

	/**
	* Generates the output
	*
	* @return string  from action
	*/
	public function main() {
		return $this->bootstrap->run('', $this->configuration);
	}

	/**
	* Initialize Extbase
	*
	* @return void
	*/
	public function __construct() {
		$this->configuration = array(
			'pluginName' => 'Pi1',
			'extensionName' => 'In2snippets',
			'controller' => 'Comment',
			'action' => 'create',
			'mvc' => array(
				'requestHandlers' => array(
					'Tx_Extbase_MVC_Web_FrontendRequestHandler' => 'Tx_Extbase_MVC_Web_FrontendRequestHandler'
				)
			),
			'settings' => array()
		);
		$_POST['tx_in2snippets_pi1']['action'] = 'create'; // set action
		$_POST['tx_in2snippets_pi1']['controller'] = 'Comment'; // set action

		$this->bootstrap = new Tx_Extbase_Core_Bootstrap();
		//$this->bootstrap->cObj = t3lib_div::makeInstance('tslib_cObj'); // example for cObj instance

		$userObj = tslib_eidtools::initFeUser();
		$temp_TSFEclassName = t3lib_div::makeInstance('tslib_fe');
		$GLOBALS['TSFE'] = new $temp_TSFEclassName($TYPO3_CONF_VARS, 32, 0, true);
		$GLOBALS['TSFE']->connectToDB();
		$GLOBALS['TSFE']->fe_user = $userObj;
		$GLOBALS['TSFE']->id = t3lib_div::_GET('id');
		$GLOBALS['TSFE']->determineId();
		$GLOBALS['TSFE']->getCompressedTCarray();
		$GLOBALS['TSFE']->initTemplate();
		$GLOBALS['TSFE']->getConfigArray();
		$GLOBALS['TSFE']->includeTCA();
	}
}

$eid = t3lib_div::makeInstance('snippetsEidComment'); // make instance
echo $eid->main(); // print content
?>