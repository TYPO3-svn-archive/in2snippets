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
* This class is a little Utility-Class for some functions stuff
*
* @author David Richter <david.richter@in2code.de>, in2code.
* @package TYPO3
*/
class Tx_In2snippets_Utility_Utility {
	
	/**
	 * This is the main-function for sending the Email
	 * 
	 * @param array $recipient recipient of the email in the format array('recipient@domain.tld' => 'Recipient Name')
	 * @param array $sender sender of the email in the format array('sender@domain.tld' => 'Sender Name')
	 * @param string $subject subject of the email
	 * @param string $templateName template name (UpperCamelCase)
	 * @param $objectManager
	 * @param $configurationManager
	 * @param array $variables variables to be passed to the Fluid view
	 * @return boolean TRUE on success, otherwise false
	 */
	public function sendTemplateEmail(array $recipient, array $sender, $subject, $templateName, $objectManager, $configurationManager, array $variables = array()) {
		$emailView = $objectManager->create('Tx_Fluid_View_StandaloneView');
		$emailView->setFormat('html');
		$extbaseFrameworkConfiguration = $configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
		$templatePathAndFilename = $templateRootPath . $templateName . '.html';
		$emailView->setTemplatePathAndFilename($templatePathAndFilename);
		$emailView->assignMultiple($variables);
		$emailBody = $emailView->render();
		$message = t3lib_div::makeInstance('t3lib_mail_Message');
		$message->setTo($recipient)
		   ->setFrom($sender)
		   ->setSubject($subject);

		// Plain text example
		$message->setBody($emailBody, 'text/plain');

		// HTML Email
		$message->setBody($emailBody, 'text/html');
		
		$message->send();
		return $message->isSent();
	}
}
?>