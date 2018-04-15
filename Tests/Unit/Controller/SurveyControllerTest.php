<?php
namespace Schmidtch\Survey\Tests\Unit\Controller;
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
 * Test case for class Schmidtch\Survey\Controller\SurveyController.
 *
 * @author Christof Schmidt <schmidt.christof@gmx.de>
 */
class SurveyControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \Schmidtch\Survey\Controller\SurveyController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('Schmidtch\\Survey\\Controller\\SurveyController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllSurveysFromRepositoryAndAssignsThemToView()
	{

		$allSurveys = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$surveyRepository = $this->getMock('Schmidtch\\Survey\\Domain\\Repository\\SurveyRepository', array('findAll'), array(), '', FALSE);
		$surveyRepository->expects($this->once())->method('findAll')->will($this->returnValue($allSurveys));
		$this->inject($this->subject, 'surveyRepository', $surveyRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('surveys', $allSurveys);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenSurveyToView()
	{
		$survey = new \Schmidtch\Survey\Domain\Model\Survey();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('survey', $survey);

		$this->subject->showAction($survey);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenSurveyToSurveyRepository()
	{
		$survey = new \Schmidtch\Survey\Domain\Model\Survey();

		$surveyRepository = $this->getMock('Schmidtch\\Survey\\Domain\\Repository\\SurveyRepository', array('add'), array(), '', FALSE);
		$surveyRepository->expects($this->once())->method('add')->with($survey);
		$this->inject($this->subject, 'surveyRepository', $surveyRepository);

		$this->subject->createAction($survey);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenSurveyToView()
	{
		$survey = new \Schmidtch\Survey\Domain\Model\Survey();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('survey', $survey);

		$this->subject->editAction($survey);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenSurveyInSurveyRepository()
	{
		$survey = new \Schmidtch\Survey\Domain\Model\Survey();

		$surveyRepository = $this->getMock('Schmidtch\\Survey\\Domain\\Repository\\SurveyRepository', array('update'), array(), '', FALSE);
		$surveyRepository->expects($this->once())->method('update')->with($survey);
		$this->inject($this->subject, 'surveyRepository', $surveyRepository);

		$this->subject->updateAction($survey);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenSurveyFromSurveyRepository()
	{
		$survey = new \Schmidtch\Survey\Domain\Model\Survey();

		$surveyRepository = $this->getMock('Schmidtch\\Survey\\Domain\\Repository\\SurveyRepository', array('remove'), array(), '', FALSE);
		$surveyRepository->expects($this->once())->method('remove')->with($survey);
		$this->inject($this->subject, 'surveyRepository', $surveyRepository);

		$this->subject->deleteAction($survey);
	}
}
