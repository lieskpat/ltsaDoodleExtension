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
     * @param \Schmidtch\Survey\Domain\Repository\AppointmentRepository $appointmentRepository
     */
    public function injectAppointmentRepository(
    \Schmidtch\Survey\Domain\Repository\AppointmentRepository $appointmentRepository) {
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * action initialize
     * reset default date format
     * @return void
     */
    public function initializeAddAction() {
        $this->arguments['appointment']
                ->getPropertyMappingConfiguration()
                ->forProperty('*')
                ->setTypeConverterOption(
                        'TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'Y-m-d');
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param $appointmentArray
     */
    public function addAction(
    \Schmidtch\Survey\Domain\Model\Survey $survey, array $appointmentArray = array()) {

        foreach ($appointmentArray as $value) {
            $appointmentObject = new \Schmidtch\Survey\Domain\Model\Appointment();
            $appointmentObject->setAppointmentDate($value['appointmentdate']);
            $timeOfDayObject = new \Schmidtch\Survey\Domain\Model\TimeOfDay();
            $timeOfDayObject->setTimeValue($value['timevalue']);
            $appointmentObject->addTimeOfDay($timeOfDayObject);
            $survey->addAppointment($appointmentObject);
        }
        $this->objectManager->get('Schmidtch\\Survey\\Domain\\Repository\\SurveyRepository')->update($survey);
        $persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        $persistenceManager->persistAll();
        $this->redirect('addFormTime', 'Appointment', NULL, array('appointment' => $appointmentArray, 'survey' => $survey));
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
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointment
     */
    public function addFormTimeAction(
    \Schmidtch\Survey\Domain\Model\Survey $survey, \Schmidtch\Survey\Domain\Model\Appointment $appointment) {
        $this->view->assign('survey', $survey);
        $this->view->assign('appointment', $appointment);
        $this->view->assign('timeofday', $this->objectManager->get('Schmidtch\\Survey\\Domain\\Repository\\TimeofdayRepository')->findAll());
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
