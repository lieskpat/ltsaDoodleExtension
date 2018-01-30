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
 * Test case for class \Schmidtch\Survey\Domain\Model\Appiontment.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Christof Schmidt <schmidt.christof@gmx.de>
 */
class AppiontmentTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \Schmidtch\Survey\Domain\Model\Appointment
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \Schmidtch\Survey\Domain\Model\Appointment();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getAppiontmentdateReturnsInitialValueForDateTime()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getAppointmentdate()
		);
	}

	/**
	 * @test
	 */
	public function setAppiontmentdateForDateTimeSetsAppiontmentdate()
	{
		$dateTimeFixture = new \DateTime();
		$this->subject->setAppointmentdate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'appiontmentdate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTimeOfDayReturnsInitialValueForTimeOfDay()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getTimeOfDay()
		);
	}

	/**
	 * @test
	 */
	public function setTimeOfDayForObjectStorageContainingTimeOfDaySetsTimeOfDay()
	{
		$timeOfDay = new \Schmidtch\Survey\Domain\Model\TimeOfDay();
		$objectStorageHoldingExactlyOneTimeOfDay = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneTimeOfDay->attach($timeOfDay);
		$this->subject->setTimeOfDay($objectStorageHoldingExactlyOneTimeOfDay);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneTimeOfDay,
			'timeOfDay',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addTimeOfDayToObjectStorageHoldingTimeOfDay()
	{
		$timeOfDay = new \Schmidtch\Survey\Domain\Model\TimeOfDay();
		$timeOfDayObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$timeOfDayObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($timeOfDay));
		$this->inject($this->subject, 'timeOfDay', $timeOfDayObjectStorageMock);

		$this->subject->addTimeOfDay($timeOfDay);
	}

	/**
	 * @test
	 */
	public function removeTimeOfDayFromObjectStorageHoldingTimeOfDay()
	{
		$timeOfDay = new \Schmidtch\Survey\Domain\Model\TimeOfDay();
		$timeOfDayObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$timeOfDayObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($timeOfDay));
		$this->inject($this->subject, 'timeOfDay', $timeOfDayObjectStorageMock);

		$this->subject->removeTimeOfDay($timeOfDay);

	}
}
