<?php
namespace Schmidtch\Survey\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Christof Schmidt <schmidt.christof@gmx.de>, Landtag von Sachsen-Anhalt
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
 ***************************************************************/

/**
 * TimeofdayController
 */
class TimeofdayController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{	
	 /**
     * @var \Schmidtch\Survey\Domain\Repository\TimeofdayRepository
     */
    protected $timeofdayRepository;
	
	/**
	 * @param \Schmidtch\Survey\Domain\Repository\TimeofdayRepository $timeofdayRepository
	 */
	public function injectTimeofdayRepository(\Schmidtch\Survey\Domain\Repository\TimeofdayRepository $timeofdayRepository) 
	{
		$this->timeofdayRepository = $timeofdayRepository;
	}   
	
	/**
	 * @param \Schmidtch\Survey\Domain\Model\Survey $survey
	 * @param \Schmidtch\Survey\Domain\Model\Appointment $appiontment
	 * @param \Schmidtch\Survey\Domain\Model\TimeOfDay $timeofday = NULL
	 */
	public function ajaxAddAction(
		\Schmidtch\Survey\Domain\Model\Survey $survey,
		\Schmidtch\Survey\Domain\Model\Appointment $appiontment, 
		\Schmidtch\Survey\Domain\Model\TimeOfDay $timeofday = NULL )
	{
		// Wenn das Uhrzeitfeld leer ist, wird nicht persistiert
        if ($timeofday->getTimeValue()=="") return FALSE;
		
        // Uhrzeit zum Termin hinzufügen hinzufügen
        $appiontment->addTimeOfDay($timeofday);
		$this->objectManager->get('Schmidtch\\Survey\\Domain\\Repository\\AppiontmentRepository')->update($appiontment);
        $this->objectManager->get( 'TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager' )->persistAll();
		
        $timeofdays = $appiontment->getTimeOfDay();
        foreach ($timeofdays as $timeofday){
            $json[$timeofday->getUid()] = array(
                'timevalue'=>$timeofday->getTimeValue(),
            );
        }
        return json_encode($json);	
	}
	
	/**
	 * @param \Schmidtch\Survey\Domain\Model\Survey $survey
	 * @param \Schmidtch\Survey\Domain\Model\Appointment $appiontment
	 * @param \Schmidtch\Survey\Domain\Model\TimeOfDay $timeofday
	 */
	public function addFormTimeAction(
		\Schmidtch\Survey\Domain\Model\Survey $survey,
		\Schmidtch\Survey\Domain\Model\Appointment $appiontment, 
		\Schmidtch\Survey\Domain\Model\TimeOfDay $timeofday = NULL)
	{
		$this->view->assign('survey', $survey);
		$this->view->assign('appiontment', $appiontment);
		$this->view->assign('timeofday', $this->objectManager->get('Schmidtch\\Survey\\Domain\\Repository\\TimeofdayRepository')->findAll());
	}
	
	/**
	 * @param \Schmidtch\Survey\Domain\Model\Appointment $appiontment
	 */
	public function updateFormAction(\Schmidtch\Survey\Domain\Model\Appointment $appiontment)
	{
		$this->view->assign('appiontment',$appiontment);
	}
	 
	 /**
	 * @param \Schmidtch\Survey\Domain\Model\Appointment $appiontment
	 */
	public function updateAction(\Schmidtch\Survey\Domain\Model\Appointment $appiontment)
	{
		$this->appiontmentRepository->update($repository);
		$this->redirect('list');
	}
	
	/**
	 * @param \Schmidtch\Survey\Domain\Model\Appointment $appiontment
	 */
	public function deleteConfirmAction(\Schmidtch\Survey\Domain\Model\Appointment $appiontment)
	{
		$this->view->assign('appiontment',$appiontment);
	}
	
	/**
	 * @param \Schmidtch\Survey\Domain\Model\Survey $survey
	 * @param \Schmidtch\Survey\Domain\Model\Appointment $appiontment
	 * @param \Schmidtch\Survey\Domain\Model\TimeOfDay $timeofday
	 */
	public function deleteAction(
		\Schmidtch\Survey\Domain\Model\Survey $survey,
		\Schmidtch\Survey\Domain\Model\Appointment $appiontment, 
		\Schmidtch\Survey\Domain\Model\TimeOfDay $timeofday)
	{
		$appiontment->removeTimeOfDay($timeofday);
        $this->objectManager->get('Schmidtch\\Survey\\Domain\\Repository\\appiontmentRepository')->update($appiontment);
		$this->timeofdayRepository->remove($timeofday);
		$this->redirect('show', 'Survey', NULL, array('survey' => $survey));
	}
	
	/**
	 * @param \Schmidtch\Survey\Domain\Model\Survey $survey
	 * @param \Schmidtch\Survey\Domain\Model\Appointment $appiontment
	 * @param \Schmidtch\Survey\Domain\Model\TimeOfDay $timeofday
	 */
	public function deleteUpdateSurveyAction(
		\Schmidtch\Survey\Domain\Model\Survey $survey,
		\Schmidtch\Survey\Domain\Model\Appointment $appiontment, 
		\Schmidtch\Survey\Domain\Model\TimeOfDay $timeofday)
	{
		$appiontment->removeTimeOfDay($timeofday);
        $this->objectManager->get('Schmidtch\\Survey\\Domain\\Repository\\appiontmentRepository')->update($appiontment);
		$this->timeofdayRepository->remove($timeofday);
		$this->redirect('updateForm', 'Survey', NULL, array('survey' => $survey));
	}
	
	public function deleteUpdateAppiontmentAction(
		\Schmidtch\Survey\Domain\Model\Survey $survey,
		\Schmidtch\Survey\Domain\Model\Appointment $appiontment, 
		\Schmidtch\Survey\Domain\Model\TimeOfDay $timeofday)
	{
		$appiontment->removeTimeOfDay($timeofday);
        $this->objectManager->get('Schmidtch\\Survey\\Domain\\Repository\\appiontmentRepository')->update($appiontment);
		$this->timeofdayRepository->remove($timeofday);
		$this->redirect('updateForm', 'Appiontment', NULL, array('survey' => $survey, 'appiontment' => $appiontment));
	}
	
	public function deleteAddAppiontmentAction(
		\Schmidtch\Survey\Domain\Model\Survey $survey,
		\Schmidtch\Survey\Domain\Model\Appointment $appiontment, 
		\Schmidtch\Survey\Domain\Model\TimeOfDay $timeofday)
	{
		$appiontment->removeTimeOfDay($timeofday);
        $this->objectManager->get('Schmidtch\\Survey\\Domain\\Repository\\appiontmentRepository')->update($appiontment);
		$this->timeofdayRepository->remove($timeofday);
		$this->redirect('addFormTime', 'Appiontment', NULL, array('survey' => $survey, 'appiontment' => $appiontment));
	}
	
	/**
	 * @param \Schmidtch\Survey\Domain\Model\Survey $survey
	 * @param \Schmidtch\Survey\Domain\Model\Appointment $appiontment
	 * @param \Schmidtch\Survey\Domain\Model\Timeofday $timeofday
	 */
	public function showAction(
		\Schmidtch\Survey\Domain\Model\Survey $survey,
		\Schmidtch\Survey\Domain\Model\Appointment $appiontment,
		\Schmidtch\Survey\Domain\Model\Timeofday $timeofday)
	{
		$this->view->assign('survey',$survey);
		$this->view->assign('appiontment',$appiontment);
		$this->view->assign('timeofday',$timeofday);
	}
	 

}