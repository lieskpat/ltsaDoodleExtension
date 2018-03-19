<?php

namespace Schmidtch\Survey\Controller;

/* * *************************************************************
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
 * ************************************************************* */

/**
 * AppointmentController
 */
class AppointmentController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * @var \Schmidtch\Survey\Domain\Repository\AppointmentRepository
     */
    protected $appointmentRepository;

    /**
     * @var \Schmidtch\Survey\Domain\Repository\TimeOfDayRepository
     * @inject
     *
     */
    protected $timeOfDayRepository;

    /**
     * 
     * @var \Schmidtch\Survey\Domain\Repository\SurveyRepository 
     * 
     */
    protected $surveyRepository;

    /**
     * @param \Schmidtch\Survey\Domain\Repository\AppointmentRepository $appointmentRepository
     */
    public function injectAppointmentRepository(
    \Schmidtch\Survey\Domain\Repository\AppointmentRepository $appointmentRepository) {
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * 
     * @param \Schmidtch\Survey\Domain\Repository\SurveyRepository $surveyRepository
     * 
     */
    public function injectSurveyRepository(\Schmidtch\Survey\Domain\Repository\SurveyRepository $surveyRepository) {
        $this->surveyRepository = $surveyRepository;
    }

    /**
     * action initialize
     * reset default date format
     * @return void
     */
    public function initializeAddAction() {
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->arguments->getArgument('survey'));
        $surveyRequestArray = $this->request->getArgument('survey');
        $converter = new \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter();
        $dateTimeObject = \DateTime::createFromFormat('Y-m-d', $surveyRequestArray['appointments'][0]['appointmentDate']);
        //$dateTimeObject = \DateTime::createFromFormat('Y-m-d', '2018-03-13');
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($dateTimeObject);
        
        
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($surveyRequestArray['appointments'][0]['appointmentDate']);
        
        $bool = $converter->canConvertFrom($surveyRequestArray, 'DateTime');
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($bool);
        if ($bool) {
          $dateTime = $converter->convertFrom($surveyRequestArray['appointments'][0]['appointmentDate'], 'DateTime');
          \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($dateTime);
        }
        
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->arguments->getArgumentNames());
        
        if ($this->arguments->hasArgument('survey')) {
            // $survey ist vom Typ Argument
            $survey = $this->arguments->getArgument('survey');
            //vom Typ MvcPropertyMappingConfiguration
            $proppertyMappingConfiguration = $survey
                    ->getPropertyMappingConfiguration();
            //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->arguments['survey']);
            
            $proppertyMappingConfiguration->forProperty('appointments.0.appointmentDate');
            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($proppertyMappingConfiguration);
            

            $proppertyMappingConfiguration->setTypeConverterOption(
                    'TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
                    //\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::class, 
                    \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 
                    'd-m-Y');
            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($proppertyMappingConfiguration);
        }
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump();
    }

    /**
     * Update the survey object with appointments.
     * 
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * 
     * 
     * 
     * 
     */
    public function addAction(\Schmidtch\Survey\Domain\Model\Survey $survey) {

        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($survey);
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->surveyRepository);

        $this->surveyRepository->update($survey);
        $persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        $persistenceManager->persistAll();

        //$this->redirect('addFormTime', 'Appointment', NULL, array('survey' => $survey));
        $this->redirect('addFormTime', 'Appointment');
        //$survey2 = $this->surveyRepository->findByUid(4);
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($survey2);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointment
     */
    public function addFormDateAction(
    \Schmidtch\Survey\Domain\Model\Survey $survey, \Schmidtch\Survey\Domain\Model\Appointment $appointment = NULL) {
        $this->view->assign('survey', $survey);
    }

    /**
     *
     * 
     */
    public function addFormTimeAction() {

        $survey = $this->surveyRepository->findAll();
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($survey);
        //$this->view->assign('survey', $survey);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointment
     * @param \Schmidtch\Survey\Domain\Model\TimeOfDay $timeOfDay
     */
    public function ajaxAddAction(
    \Schmidtch\Survey\Domain\Model\Appointment $appointment, \Schmidtch\Survey\Domain\Model\TimeOfDay $timeOfDay = NULL) {
        // Wenn das Feld leer ist, wird nicht persistiert
        if ($timeOfDay->getTimeValue() == "")
            return FALSE;

        // Uhrzeit zum Termin hinzufühgen
        $appointment->addTimeOfDay($timeOfDay);

        $this->appointmentRepository->update($appointment);
        $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager')->persistAll();

        $timeOfDays = $appointment->getTimeOfDay();
        foreach ($timeOfDays as $timeOfDay) {
            $json[$timeOfDay->getUid()] = array(
                'timevalue' => $timeOfDay->getTimeValue()
            );
        }
        return json_encode($json);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointment
     */
    public function updateFormAction(
    \Schmidtch\Survey\Domain\Model\Survey $survey, \Schmidtch\Survey\Domain\Model\Appointment $appointment) {
        $this->view->assign('survey', $survey);
        $this->view->assign('appointment', $appointment);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointment
     */
    public function updateFormAppointmentAction(
    \Schmidtch\Survey\Domain\Model\Survey $survey, \Schmidtch\Survey\Domain\Model\Appointment $appointment) {
        $this->view->assign('survey', $survey);
        $this->view->assign('appointment', $appointment);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointment
     */
    public function updateAction(\Schmidtch\Survey\Domain\Model\Appointment $appointment) {
        $this->appointmentRepository->update($repository);
        $this->redirect('list');
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointment
     */
    public function deleteConfirmAction(\Schmidtch\Survey\Domain\Model\Appointment $appointment) {
        $this->view->assign('appointment', $appointment);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointment
     */
    public function deleteAction(
    \Schmidtch\Survey\Domain\Model\Appointment $appointment, \Schmidtch\Survey\Domain\Model\Survey $survey) {
        $this->addFlashMessage(
                'Termin gelöscht!', 'Status', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK, TRUE
        );

        $this->objectManager->get('Schmidtch\\Survey\\Domain\\Repository\\surveyRepository')->update($survey);
        $this->appointmentRepository->remove($appointment);
        $this->redirect('show', 'Survey', NULL, array('survey' => $survey));
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointment
     */
    public function showAction(
    \Schmidtch\Survey\Domain\Model\Survey $survey, \Schmidtch\Survey\Domain\Model\Appointment $appointment) {
        $this->view->assign('survey', $survey);
        $this->view->assign('appointment', $appointment);
    }

}
