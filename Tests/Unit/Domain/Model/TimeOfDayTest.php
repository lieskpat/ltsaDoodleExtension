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
 * Test case for class \Schmidtch\Survey\Domain\Model\TimeOfDay.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Christof Schmidt <schmidt.christof@gmx.de>
 */
class TimeOfDayTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \Schmidtch\Survey\Domain\Model\TimeOfDay
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \Schmidtch\Survey\Domain\Model\TimeOfDay();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTimevalueReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTimeValue()
		);
	}

	/**
	 * @test
	 */
	public function setTimevalueForStringSetsTimevalue()
	{
		$this->subject->setTimeValue('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'timevalue',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTimecheckReturnsInitialValueForPoll()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getTimecheck()
		);
	}

	/**
	 * @test
	 */
	public function setTimecheckForObjectStorageContainingPollSetsTimecheck()
	{
		$timecheck = new \Schmidtch\Survey\Domain\Model\Poll();
		$objectStorageHoldingExactlyOneTimecheck = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneTimecheck->attach($timecheck);
		$this->subject->setTimecheck($objectStorageHoldingExactlyOneTimecheck);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneTimecheck,
			'timecheck',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addTimecheckToObjectStorageHoldingTimecheck()
	{
		$timecheck = new \Schmidtch\Survey\Domain\Model\Poll();
		$timecheckObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$timecheckObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($timecheck));
		$this->inject($this->subject, 'timecheck', $timecheckObjectStorageMock);

		$this->subject->addTimecheck($timecheck);
	}

	/**
	 * @test
	 */
	public function removeTimecheckFromObjectStorageHoldingTimecheck()
	{
		$timecheck = new \Schmidtch\Survey\Domain\Model\Poll();
		$timecheckObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$timecheckObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($timecheck));
		$this->inject($this->subject, 'timecheck', $timecheckObjectStorageMock);

		$this->subject->removeTimecheck($timecheck);

	}
}
