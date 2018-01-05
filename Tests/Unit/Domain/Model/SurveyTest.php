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
 * Test case for class \Schmidtch\Survey\Domain\Model\Survey.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Christof Schmidt <schmidt.christof@gmx.de>
 */
class SurveyTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \Schmidtch\Survey\Domain\Model\Survey
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \Schmidtch\Survey\Domain\Model\Survey();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle()
	{
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription()
	{
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostdateReturnsInitialValueForDateTime()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getPostdate()
		);
	}

	/**
	 * @test
	 */
	public function setPostdateForDateTimeSetsPostdate()
	{
		$dateTimeFixture = new \DateTime();
		$this->subject->setPostdate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'postdate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOrganizernameReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getOrganizername()
		);
	}

	/**
	 * @test
	 */
	public function setOrganizernameForStringSetsOrganizername()
	{
		$this->subject->setOrganizername('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'organizername',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDeadlineReturnsInitialValueForDateTime()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getDeadline()
		);
	}

	/**
	 * @test
	 */
	public function setDeadlineForDateTimeSetsDeadline()
	{
		$dateTimeFixture = new \DateTime();
		$this->subject->setDeadline($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'deadline',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getVisibleReturnsInitialValueForBool()
	{
		$this->assertSame(
			FALSE,
			$this->subject->getVisible()
		);
	}

	/**
	 * @test
	 */
	public function setVisibleForBoolSetsVisible()
	{
		$this->subject->setVisible(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'visible',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCommentVisibleReturnsInitialValueForBool()
	{
		$this->assertSame(
			FALSE,
			$this->subject->getCommentVisible()
		);
	}

	/**
	 * @test
	 */
	public function setCommentVisibleForBoolSetsCommentVisible()
	{
		$this->subject->setCommentVisible(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'commentVisible',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOrganizerReturnsInitialValueForOrganizer()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getOrganizer()
		);
	}

	/**
	 * @test
	 */
	public function setOrganizerForOrganizerSetsOrganizer()
	{
		$organizerFixture = new \Schmidtch\Survey\Domain\Model\Organizer();
		$this->subject->setOrganizer($organizerFixture);

		$this->assertAttributeEquals(
			$organizerFixture,
			'organizer',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAppiontmentsReturnsInitialValueForAppiontment()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getAppiontments()
		);
	}

	/**
	 * @test
	 */
	public function setAppiontmentsForObjectStorageContainingAppiontmentSetsAppiontments()
	{
		$appiontment = new \Schmidtch\Survey\Domain\Model\Appiontment();
		$objectStorageHoldingExactlyOneAppiontments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneAppiontments->attach($appiontment);
		$this->subject->setAppiontments($objectStorageHoldingExactlyOneAppiontments);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneAppiontments,
			'appiontments',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addAppiontmentToObjectStorageHoldingAppiontments()
	{
		$appiontment = new \Schmidtch\Survey\Domain\Model\Appiontment();
		$appiontmentsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$appiontmentsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($appiontment));
		$this->inject($this->subject, 'appiontments', $appiontmentsObjectStorageMock);

		$this->subject->addAppiontment($appiontment);
	}

	/**
	 * @test
	 */
	public function removeAppiontmentFromObjectStorageHoldingAppiontments()
	{
		$appiontment = new \Schmidtch\Survey\Domain\Model\Appiontment();
		$appiontmentsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$appiontmentsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($appiontment));
		$this->inject($this->subject, 'appiontments', $appiontmentsObjectStorageMock);

		$this->subject->removeAppiontment($appiontment);

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
	public function getSubscribersReturnsInitialValueForSubscriber()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getSubscribers()
		);
	}

	/**
	 * @test
	 */
	public function setSubscribersForObjectStorageContainingSubscriberSetsSubscribers()
	{
		$subscriber = new \Schmidtch\Survey\Domain\Model\Subscriber();
		$objectStorageHoldingExactlyOneSubscribers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneSubscribers->attach($subscriber);
		$this->subject->setSubscribers($objectStorageHoldingExactlyOneSubscribers);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneSubscribers,
			'subscribers',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addSubscriberToObjectStorageHoldingSubscribers()
	{
		$subscriber = new \Schmidtch\Survey\Domain\Model\Subscriber();
		$subscribersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$subscribersObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($subscriber));
		$this->inject($this->subject, 'subscribers', $subscribersObjectStorageMock);

		$this->subject->addSubscriber($subscriber);
	}

	/**
	 * @test
	 */
	public function removeSubscriberFromObjectStorageHoldingSubscribers()
	{
		$subscriber = new \Schmidtch\Survey\Domain\Model\Subscriber();
		$subscribersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$subscribersObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($subscriber));
		$this->inject($this->subject, 'subscribers', $subscribersObjectStorageMock);

		$this->subject->removeSubscriber($subscriber);

	}
}
