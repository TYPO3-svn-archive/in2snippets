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
class Tx_In2snippets_Domain_Model_Snippet extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;
	
	/**
	 * description
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $description;
	
	/**
	 * tags
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $tags;
	
	/**
	 * cruserId
	 *
	 * @var Tx_In2snippets_Domain_Model_User
	 */
	protected $cruserId;
	
	/**
     * Create-Date
     *
     * @var DateTime
     * @validate NotEmpty
     */
	protected $crdate;
	
	/**
	 * comments
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_In2snippets_Domain_Model_Comment>
	 */
	protected $comments;
	
	/**
	 * categories
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_In2snippets_Domain_Model_Category>
	 */
	protected $categories;
	
	/**
	 * codes
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_In2snippets_Domain_Model_Code>
	 */
	protected $codes;

	/**
	 * votesCount
	 *
	 * @var int
	 */
	protected $votesCount;

	/**
	 * codes
	 *
	 * @var float
	 */
	protected $votesCalc;
	
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
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the tags
	 *
	 * @return string $tags
	 */
	public function getTags() {
		return $this->tags;
	}

	/**
	 * Sets the tags
	 *
	 * @param string $tags
	 * @return void
	 */
	public function setTags($tags) {
		$this->tags = $tags;
	}

	/**
	 * Returns the creator
	 *
	 * @return Tx_In2snippets_Domain_Model_User $cruserId
	 */
	public function getCruserId() {
		$snippetRepository = t3lib_div::makeInstance('Tx_In2snippets_Domain_Repository_SnippetRepository');
		return $snippetRepository->getBeNameFromSnippetId($this->getUid());
		//return $this->cruserId;
	}

	/**
	 * Sets the creator
	 *
	 * @param Tx_In2snippets_Domain_Model_User $cruserId
	 * @return void
	 */
	public function setCruserId($cruserId) {
		$this->cruserId = $cruserId;
	}
	
	/**
	 * Returns the create date
	 *
	 * @return DateTime
	 */
	public function getCrdate() {
		return $this->crdate;
	}

	/**
	 * Sets the create date
	 *
	 * @param DateTime $crdate
	 * @return void
	 */
	public function setCrdate($crdate) {
		$this->crdate = $crdate;
	}

	/**
	 * Adds a Comment
	 *
	 * @param Tx_In2snippets_Domain_Model_Comment $comment
	 * @return void
	 */
	public function addComment(Tx_In2snippets_Domain_Model_Comment $comment) {
		$this->comments->attach($comment);
	}

	/**
	 * Removes a Comment
	 *
	 * @param Tx_In2snippets_Domain_Model_Comment $commentToRemove The Comment to be removed
	 * @return void
	 */
	public function removeComment(Tx_In2snippets_Domain_Model_Comment $commentToRemove) {
		$this->comments->detach($commentToRemove);
	}

	/**
	 * Returns the comments
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_In2snippets_Domain_Model_Comment> $comments
	 */
	public function getComments() {
		$commentRepository = t3lib_div::makeInstance('Tx_In2snippets_Domain_Repository_CommentRepository');
		return $commentRepository->findBySnippet($this->getUid());
		//return $this->comments;
	}

	/**
	 * Sets the comments
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_In2snippets_Domain_Model_Comment> $comments
	 * @return void
	 */
	public function setComments(Tx_Extbase_Persistence_ObjectStorage $comments) {
		$this->comments = $comments;
	}

	/**
	 * Adds a Category
	 *
	 * @param Tx_In2snippets_Domain_Model_Category $category
	 * @return void
	 */
	public function addCategory(Tx_In2snippets_Domain_Model_Category $category) {
		$this->categories->attach($category);
	}

	/**
	 * Removes a Category
	 *
	 * @param Tx_In2snippets_Domain_Model_Category $categoryToRemove The Category to be removed
	 * @return void
	 */
	public function removeCategory(Tx_In2snippets_Domain_Model_Category $categoryToRemove) {
		$this->categories->detach($categoryToRemove);
	}

	/**
	 * Returns the categories
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_In2snippets_Domain_Model_Category> $categories
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * Sets the categories
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_In2snippets_Domain_Model_Category> $categories
	 * @return void
	 */
	public function setCategories(Tx_Extbase_Persistence_ObjectStorage $categories) {
		$this->categories = $categories;
	}

	/**
	 * Adds a Code
	 *
	 * @param Tx_In2snippets_Domain_Model_Code $code
	 * @return void
	 */
	public function addCode(Tx_In2snippets_Domain_Model_Code $code) {
		$this->codes->attach($code);
	}

	/**
	 * Removes a Code
	 *
	 * @param Tx_In2snippets_Domain_Model_Code $codeToRemove The Code to be removed
	 * @return void
	 */
	public function removeCode(Tx_In2snippets_Domain_Model_Code $codeToRemove) {
		$this->codes->detach($codeToRemove);
	}

	/**
	 * Returns the codes
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_In2snippets_Domain_Model_Code> $codes
	 */
	public function getCodes() {
		return $this->codes;
	}

	/**
	 * Sets the codes
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_In2snippets_Domain_Model_Code> $codes
	 * @return void
	 */
	public function setCodes(Tx_Extbase_Persistence_ObjectStorage $codes) {
		$this->codes = $codes;
	}
	
	/**
	 * Returns the count of votes
	 *
	 * @return int votesCount
	 */
	public function getVotesCount() {
		return $this->votesCount;
	}

	/**
	 * Sets the count of votes
	 *
	 * @param int $votesCount
	 * @return void
	 */
	public function setVotesCount($votesCount) {
		$this->votesCount = $votesCount;
	}

	/**
	 * Returns the result of all votes
	 *
	 * @return double votesCalc
	 */
	public function getVotesCalc() {
		return $this->votesCalc;
	}

	/**
	 * Sets the result of all votes
	 *
	 * @param double $votesCount
	 * @return void
	 */
	public function setVotesCalc($votesCalc) {
		$this->votesCalc = $votesCalc;
	}
	
	/**
	 * returns the tags, clear in an array
	 * 
	 * @return array $tagsarray
	 */
	public function getTagsarray() {
		$tags = $this->getTags();
		$tags = str_replace(array(' ', ';', '.'), ',', $tags);
		return t3lib_div::trimExplode(',', $tags, 1);
	}

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
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
		$this->users = new Tx_Extbase_Persistence_ObjectStorage();
	}

}

?>