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
 * UTF8-Encode ViewHelper
 *
 * @package in2snippets
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_In2snippets_ViewHelpers_MarkTermViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
     * Encodes a string trhough utf8 encode
     *
     * @param	string	Any string
     * @return	string	changed string
     */
    public function render($string) {
		// settings
		$piVars = t3lib_div::_GP('tx_in2snippets_pi1');
		if (!isset($piVars['snippetSearch']) || empty($piVars['snippetSearch'])) {
			return $string;
		}
		// Possible Todo: Make tags changable
		$tags = array(
			'<span class="term">',
			'</span>'
		);

		// let's go
		$piVars['snippetSearch'] = str_replace('%', '\%', $piVars['snippetSearch']);
		$tmp_searchterm = t3lib_div::trimExplode(' ', $piVars['snippetSearch'], 1);
		$searchterms = '%(' . implode('|', $tmp_searchterm) . ')%i'; // generate "(term1|term2|term3)"
		$string = preg_replace($searchterms, $tags[0] . '$0' . $tags[1], $string);

		return $string;
    }
}
?>