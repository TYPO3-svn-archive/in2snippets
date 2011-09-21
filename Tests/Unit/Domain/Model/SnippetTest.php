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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Tx_In2snippets_Domain_Model_Snippet.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage in2snippets
 *
 * @author David Richter <david.richter@in2code.de>
 */
class Tx_In2snippets_Domain_Model_SnippetTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_In2snippets_Domain_Model_Snippet
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_In2snippets_Domain_Model_Snippet();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() { 
		$this->fixture->setTitle('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTitle()
		);
	}
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getTagsReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTagsForStringSetsTags() { 
		$this->fixture->setTags('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTags()
		);
	}
	
	/**
	 * @test
	 */
	public function getCommentsReturnsInitialValueForObjectStorageContainingTx_In2snippets_Domain_Model_Comment() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getComments()
		);
	}

	/**
	 * @test
	 */
	public function setCommentsForObjectStorageContainingTx_In2snippets_Domain_Model_CommentSetsComments() { 
		$comment = new Tx_In2snippets_Domain_Model_Comment();
		$objectStorageHoldingExactlyOneComments = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneComments->attach($comment);
		$this->fixture->setComments($objectStorageHoldingExactlyOneComments);

		$this->assertSame(
			$objectStorageHoldingExactlyOneComments,
			$this->fixture->getComments()
		);
	}
	
	/**
	 * @test
	 */
	public function addCommentToObjectStorageHoldingComments() {
		$comment = new Tx_In2snippets_Domain_Model_Comment();
		$objectStorageHoldingExactlyOneComment = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneComment->attach($comment);
		$this->fixture->addComment($comment);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneComment,
			$this->fixture->getComments()
		);
	}

	/**
	 * @test
	 */
	public function removeCommentFromObjectStorageHoldingComments() {
		$comment = new Tx_In2snippets_Domain_Model_Comment();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($comment);
		$localObjectStorage->detach($comment);
		$this->fixture->addComment($comment);
		$this->fixture->removeComment($comment);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getComments()
		);
	}
	
	/**
	 * @test
	 */
	public function getCategoriesReturnsInitialValueForObjectStorageContainingTx_In2snippets_Domain_Model_Category() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getCategories()
		);
	}

	/**
	 * @test
	 */
	public function setCategoriesForObjectStorageContainingTx_In2snippets_Domain_Model_CategorySetsCategories() { 
		$category = new Tx_In2snippets_Domain_Model_Category();
		$objectStorageHoldingExactlyOneCategories = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneCategories->attach($category);
		$this->fixture->setCategories($objectStorageHoldingExactlyOneCategories);

		$this->assertSame(
			$objectStorageHoldingExactlyOneCategories,
			$this->fixture->getCategories()
		);
	}
	
	/**
	 * @test
	 */
	public function addCategoryToObjectStorageHoldingCategories() {
		$category = new Tx_In2snippets_Domain_Model_Category();
		$objectStorageHoldingExactlyOneCategory = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneCategory->attach($category);
		$this->fixture->addCategory($category);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneCategory,
			$this->fixture->getCategories()
		);
	}

	/**
	 * @test
	 */
	public function removeCategoryFromObjectStorageHoldingCategories() {
		$category = new Tx_In2snippets_Domain_Model_Category();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($category);
		$localObjectStorage->detach($category);
		$this->fixture->addCategory($category);
		$this->fixture->removeCategory($category);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getCategories()
		);
	}
	
	/**
	 * @test
	 */
	public function getCodesReturnsInitialValueForObjectStorageContainingTx_In2snippets_Domain_Model_Code() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getCodes()
		);
	}

	/**
	 * @test
	 */
	public function setCodesForObjectStorageContainingTx_In2snippets_Domain_Model_CodeSetsCodes() { 
		$code = new Tx_In2snippets_Domain_Model_Code();
		$objectStorageHoldingExactlyOneCodes = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneCodes->attach($code);
		$this->fixture->setCodes($objectStorageHoldingExactlyOneCodes);

		$this->assertSame(
			$objectStorageHoldingExactlyOneCodes,
			$this->fixture->getCodes()
		);
	}
	
	/**
	 * @test
	 */
	public function addCodeToObjectStorageHoldingCodes() {
		$code = new Tx_In2snippets_Domain_Model_Code();
		$objectStorageHoldingExactlyOneCode = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneCode->attach($code);
		$this->fixture->addCode($code);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneCode,
			$this->fixture->getCodes()
		);
	}

	/**
	 * @test
	 */
	public function removeCodeFromObjectStorageHoldingCodes() {
		$code = new Tx_In2snippets_Domain_Model_Code();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($code);
		$localObjectStorage->detach($code);
		$this->fixture->addCode($code);
		$this->fixture->removeCode($code);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getCodes()
		);
	}
	
}
?>