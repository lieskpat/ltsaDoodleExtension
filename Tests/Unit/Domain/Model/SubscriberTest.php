<?php

namespace Schmidtch\Survey\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Christof Schmidt <schmidt.christof@gmx.de>, Landtag von Sachsen-Anhalt
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
 * Test case for class \Schmidtch\Survey\Domain\Model\Subscriber.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Christof Schmidt <schmidt.christof@gmx.de>
 */
class SubscriberTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \Schmidtch\Survey\Domain\Model\Subscriber
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \Schmidtch\Survey\Domain\Model\Subscriber();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNameSubscriberReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getNameSubscriber()
		);
	}

	/**
	 * @test
	 */
	public function setNameSubscriberForStringSetsNameSubscriber()
	{
		$this->subject->setNameSubscriber('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'nameSubscriber',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCommentsReturnsInitialValueForComment()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getComments()
		);
	}

	/**
	 * @test
	 */
	public function setCommentsForObjectStorageContainingCommentSetsComments()
	{
		$comment = new \Schmidtch\Survey\Domain\Model\Comment();
		$objectStorageHoldingExactlyOneComments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneComments->attach($comment);
		$this->subject->setComments($objectStorageHoldingExactlyOneComments);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneComments,
			'comments',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addCommentToObjectStorageHoldingComments()
	{
		$comment = new \Schmidtch\Survey\Domain\Model\Comment();
		$commentsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$commentsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($comment));
		$this->inject($this->subject, 'comments', $commentsObjectStorageMock);

		$this->subject->addComment($comment);
	}

	/**
	 * @test
	 */
	public function removeCommentFromObjectStorageHoldingComments()
	{
		$comment = new \Schmidtch\Survey\Domain\Model\Comment();
		$commentsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$commentsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($comment));
		$this->inject($this->subject, 'comments', $commentsObjectStorageMock);

		$this->subject->removeComment($comment);

	}

	/**
	 * @test
	 */
	public function getSubcheckReturnsInitialValueForPoll()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getSubcheck()
		);
	}

	/**
	 * @test
	 */
	public function setSubcheckForObjectStorageContainingPollSetsSubcheck()
	{
		$subcheck = new \Schmidtch\Survey\Domain\Model\Poll();
		$objectStorageHoldingExactlyOneSubcheck = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneSubcheck->attach($subcheck);
		$this->subject->setSubcheck($objectStorageHoldingExactlyOneSubcheck);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneSubcheck,
			'subcheck',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addSubcheckToObjectStorageHoldingSubcheck()
	{
		$subcheck = new \Schmidtch\Survey\Domain\Model\Poll();
		$subcheckObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$subcheckObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($subcheck));
		$this->inject($this->subject, 'subcheck', $subcheckObjectStorageMock);

		$this->subject->addSubcheck($subcheck);
	}

	/**
	 * @test
	 */
	public function removeSubcheckFromObjectStorageHoldingSubcheck()
	{
		$subcheck = new \Schmidtch\Survey\Domain\Model\Poll();
		$subcheckObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$subcheckObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($subcheck));
		$this->inject($this->subject, 'subcheck', $subcheckObjectStorageMock);

		$this->subject->removeSubcheck($subcheck);

	}
}
