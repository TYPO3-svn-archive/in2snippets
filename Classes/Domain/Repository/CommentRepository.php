<?php

/* * *************************************************************
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
 * ************************************************************* */

/**
 * Repository for Tx_In2snippets_Domain_Model_Comment
 */
class Tx_In2snippets_Domain_Repository_CommentRepository extends Tx_Extbase_Persistence_Repository {
	
	/**
	 * get all comments by snippet id
	 * 
	 * @param int $snippetUid
	 * @return object comments
	 */
	public function findBySnippet($snippetUid) {
		$query = $this->createQuery();
		$query->matching($query->equals('snippet', $snippetUid));
		
		return $query
			->setOrderings(
				array(
					'crdate' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING
				)
			)
			->execute();
	}
}

?>