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
 * Repository for Tx_In2snippets_Domain_Model_Snippet
 */
class Tx_In2snippets_Domain_Repository_SnippetRepository extends Tx_Extbase_Persistence_Repository {
	
	/**
	 * Just Returns all snippet objects
	 *
	 * @return	object	Name of a backend user
	 */
	public function findAll() {
		$query = $this->createQuery();
		$query->greaterThan('uid', 0);
		
		return $query
			->setOrderings(
				array(
					'crdate' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING
				)
			)
			->execute();
	}
	
	/**
	 * filters the list, for search-vars
	 *
	 * @param	string	Vars from Snippet-Search
	 * @return	array	filtered list items
	 */
	public function filterList($snippetSearchVars) {
		$query = $this->createQuery();
		$and = array();
		$and[] = $query->greaterThan('uid', 0); // always true like 1=1

		if (!empty($snippetSearchVars)) {
			$snippetSearchVars = t3lib_div::trimExplode(' ', $snippetSearchVars, 1);
			for ($i = 0; $i < count($snippetSearchVars); $i++) {
				$or = array();
				$or[] = $query->like('title', '%' . $snippetSearchVars[$i] . '%');
				$or[] = $query->like('tags', '%' . $snippetSearchVars[$i] . '%');
				$or[] = $query->like('description', '%' . $snippetSearchVars[$i] . '%');
				$or[] = $query->like('codes.code', '%' . $snippetSearchVars[$i] . '%');
				$or[] = $query->like('codes.links', '%' . $snippetSearchVars[$i] . '%');
				$or[] = $query->like('categories.title', '%' . $snippetSearchVars[$i] . '%');
				//$or[] = $query->like('comments.text', '%' . $snippetSearchVars[$i] . '%');
				$and[] = $query->logicalOr($or); // create where object with OR
			}
		}
		$constraint = $query->logicalAnd($and); // create where object with OR
		$query->matching($constraint); // use constraint

		return $query
			->setOrderings(
				array(
					'crdate' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING
				)
			)
			->execute();
	}

	/**
	 * returns the list filtered for categories
	 * 
	 * @param	string	Vars from Snippet-Search
	 * @param	int		snippet uid
	 * @return	array	filtered list items
	 */
	public function filterListAndCat($snippetSearchVars, $uid) {
		$query = $this->createQuery();
		$and = array();
		$and[] = $query->greaterThan('uid', 0); // always true like 1=1
		$and[] = $query->contains('categories', $uid); // from current category

		if (!empty($snippetSearchVars)) {
			$searchterms = t3lib_div::trimExplode(' ', $snippetSearchVars, 1); // split every keyword
			for ($i = 0; $i < count($searchterms); $i++) { // one loop for every keyword
				$or = array();
				$or[] = $query->like('title', '%' . $searchterms[$i] . '%');
				$or[] = $query->like('tags', '%' . $searchterms[$i] . '%');
				$or[] = $query->like('description', '%' . $searchterms[$i] . '%');
				$or[] = $query->like('codes.code', '%' . $searchterms[$i] . '%');
				$or[] = $query->like('codes.links', '%' . $snippetSearchVars[$i] . '%');
				$or[] = $query->like('categories.title', '%' . $searchterms[$i] . '%');
				//$or[] = $query->like('comments.text', '%' . $searchterms[$i] . '%');
				$and[] = $query->logicalOr($or); // create where object with OR
			}
		}

		$constraint = $query->logicalAnd($and); // create where object with OR
		$query->matching($constraint); // use constraint

		return $query
			->setOrderings(
				array(
					'crdate' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING
				)
			)
			->execute();
	}

	/**
	 * Get Snippets by Category
	 *
	 * @param	integer	Category uid
	 * @return	object	query object
	 */
	public function findByCategory($uid) {
		$query = $this->createQuery(); // initialize query
		$and = array();
		$and[] = $query->greaterThan('uid', 0); // always true like 1=1
		$and[] = $query->contains('categories', $uid);

		$constraint = $query->logicalAnd($and); // create where object with AND
		$query->matching($constraint); // use constraint
		return $query
			->setOrderings(
				array(
					'crdate' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING
				)
			)
			->execute();
	}

	/**
	 * Get BE-Name of snippet-creator
	 *
	 * @param	int		Snippet Uid
	 * @return	string	Name of a backend user
	 */
	public function getBeNameFromSnippetId($snippetId) {
		$query = $this->createQuery();
		$sql = '
			select be_users.realName, be_users.username, be_users.email
			from
				tx_in2snippets_domain_model_snippet
				LEFT JOIN be_users ON tx_in2snippets_domain_model_snippet.cruser_id = be_users.uid
			where tx_in2snippets_domain_model_snippet.uid = ' . intval($snippetId) . '
		';
		$query->getQuerySettings()->setReturnRawQueryResult(true);
		$result = $query->statement($sql)->execute();

		return $result[0];
	}
	
}

?>