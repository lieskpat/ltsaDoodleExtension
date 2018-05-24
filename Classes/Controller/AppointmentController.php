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
    public function injectSurveyRepository(
    \Schmidtch\Survey\Domain\Repository\SurveyRepository $surveyRepository) {
        $this->surveyRepository = $surveyRepository;
    }
    
    /**
     * 
     */
    public function listAction() {
       $this->forward('show'); 
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * 
     */
    public function newAppointmentAction(\Schmidtch\Survey\Domain\Model\Survey $survey) {
        $this->view->assign('survey', $survey);
    }

    /**
     * Update the survey object with appointments.
     * 
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \array $appointmentDate
     * @validate $appointmentDate Schmidtch.Survey:ArrayOnEmptyItems
     *
     */
    public function createAppointmentAction(
    \Schmidtch\Survey\Domain\Model\Survey $survey, array $appointmentDate) {
        //Hinweis
        //schreibende Zugriffe auf das Repository(z.B. add) 
        //erfolgen immer am Ende der Action
        //lesende Zugriffe(z.B.findAll) erfolgen immer an der Stelle,
        //wo sie im Code notiert sind
        if (empty($survey->getAppointments()->toArray())) {
            $this->createAndAddAppointmentToSurvey($survey, $this->
                    getArrayWithNoDuplicateStrings($appointmentDate
                        , $survey->getAppointmentDateArrayFromAppointments()));
        } else {
            $helpArray = $this->getArrayWithNoDuplicateStrings($appointmentDate
                , $survey->getAppointmentDateArrayFromAppointments());
            if (!empty($helpArray)) {
                $this->createAndAddAppointmentToSurvey($survey, $helpArray);
            }
        }
        $this->surveyRepository->update($survey);
        //bei Aufruf von redirect wird automatisch vorher persistiert
        $this->redirect('addFormTime', 'Appointment', NULL, array('survey' => $survey));
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \array $appointmentDate
     *
     */
    private function createAndAddAppointmentToSurvey(
    \Schmidtch\Survey\Domain\Model\Survey $survey, array $appointmentDate) {

        foreach ($appointmentDate as $value) {
            $survey->addAppointment(new \Schmidtch\Survey\Domain\Model\Appointment
                (\DateTime::createFromFormat('!Y-m-d', $value)));
        }
    }

    /**
     * filter duplicates from request and storage (DB)
     * 
     * @param array $requestArray request values are strings
     * @param array $storageArray often are objects but instance variables
     * mostly are strings
     * @return array
     */
    private function getArrayWithNoDuplicateStrings(array $requestArray, array $storageArray) {
        $manipulatedArray = $storageArray;
        foreach ($requestArray as $string) {
            if (!in_array($string, $manipulatedArray)) {
                $manipulatedArray[] = $string;
            }
        }
        return array_diff($manipulatedArray, $storageArray);
    }

    /**
     *
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     */
    public function addFormTimeAction(\Schmidtch\Survey\Domain\Model\Survey $survey) {
        $this->view->assign('survey', $survey);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointment
     */
    public function newTimeOfDayAction(
    \Schmidtch\Survey\Domain\Model\Survey $survey
    , \Schmidtch\Survey\Domain\Model\Appointment $appointment) {
        $this->view->assign('appointment', $appointment);
        $this->view->assign('survey', $survey);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointment
     * @param \array $timeOfDay
     */
    public function createTimeOfDayAction(\Schmidtch\Survey\Domain\Model\Survey $survey
    , \Schmidtch\Survey\Domain\Model\Appointment $appointment
    , array $timeOfDay) {

        if (empty($appointment->getTimeOfDay()->toArray())) {
            $this->createAndAddTimeOfDayObjectToAppointment($appointment
                , $this->getArrayWithNoDuplicateStrings($timeOfDay
                    , $appointment->getTimeValueArrayFromAppointmentObject()));
        } else {
            $helpArray = $this->getArrayWithNoDuplicateStrings($timeOfDay
                , $appointment->getTimeValueArrayFromAppointmentObject());
            if (!empty($helpArray)) {
                $this->createAndAddTimeOfDayObjectToAppointment($appointment, $helpArray);
            }
        }
        $this->appointmentRepository->update($appointment);
        $this->forward('addFormTime', 'Appointment', NULL, array('survey' => $survey));
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointment
     * @param \array $timeOfDay
     */
    private function createAndAddTimeOfDayObjectToAppointment(
    \Schmidtch\Survey\Domain\Model\Appointment $appointment, array $timeOfDay) {

        foreach ($timeOfDay as $value) {
            $appointment->addTimeOfDay(new \Schmidtch\Survey\Domain\Model\Timeofday($value));
        }
    }
    
    /**
     * 
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey 
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointment
     */
    public function ajaxDeleteAction(\Schmidtch\Survey\Domain\Model\Survey $survey
        , \Schmidtch\Survey\Domain\Model\Appointment $appointment) {
        
        $this->appointmentRepository->remove($appointment);
        $this->redirect('newAppointment', 'Appointment', NULL, array('survey' => $survey));
        
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointment
     * @param \Schmidtch\Survey\Domain\Model\Timeofday $timeOfDay
     */
    public function ajaxAddAction(
    \Schmidtch\Survey\Domain\Model\Appointment $appointment
    , \Schmidtch\Survey\Domain\Model\Timeofday $timeOfDay = NULL) {
        // Wenn das Feld leer ist, wird nicht persistiert
        if ($timeOfDay->getTimeValue() == "") {
            return FALSE;
        }
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
