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
 * AppiontmentController
 */
class AppiontmentController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * @var \Schmidtch\Survey\Domain\Repository\AppiontmentRepository
     */
    protected $appiontmentRepository;

    /**
     * @var \Schmidtch\Survey\Domain\Repository\TimeOfDayRepository
     * @inject
     *
     */
    protected $timeOfDayRepository;

    /**
     * @param \Schmidtch\Survey\Domain\Repository\AppiontmentRepository $appiontmentRepository
     */
    public function injectAppiontmentRepository(\Schmidtch\Survey\Domain\Repository\AppiontmentRepository $appiontmentRepository) {
        $this->appiontmentRepository = $appiontmentRepository;
    }

    /**
     * action initialize
     * reset default date format
     * @return void
     */
    public function initializeAddAction() {
        $this->arguments['appiontment']
                ->getPropertyMappingConfiguration()
                ->forProperty('*')
                ->setTypeConverterOption(
                        'TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'Y-m-d');
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appiontment $appiontment
     */
    public function addAction(
    \Schmidtch\Survey\Domain\Model\Survey $survey, \Schmidtch\Survey\Domain\Model\Appiontment $appiontment) {
        //$this->appiontmentRepository->add($appiontment);	

        $survey->addAppiontment($appiontment);
        $this->objectManager->get('Schmidtch\\Survey\\Domain\\Repository\\SurveyRepository')->update($survey);
        $persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        $persistenceManager->persistAll();
        $this->redirect('addFormTime', 'Appiontment', NULL, array('appiontment' => $appiontment, 'survey' => $survey));
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appiontment $appiontment
     */
    public function addFormDateAction(
    \Schmidtch\Survey\Domain\Model\Survey $survey, \Schmidtch\Survey\Domain\Model\Appiontment $appiontment = NULL) {
        $this->view->assign('survey', $survey);
        $this->view->assign('appiontments', $this->objectManager->get('Schmidtch\\Survey\\Domain\\Repository\\AppiontmentRepository')->findAll());
        //$this->view->assign('timeOfDay', $this->objectManager->get('Schmidtch\\Survey\\Domain\\Repository\\TimeofdayRepository')->findAll());
        $this->view->assign('timeOfDay', $this->timeOfDayRepository->findAll());
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appiontment $appiontment
     */
    public function addFormTimeAction(
    \Schmidtch\Survey\Domain\Model\Survey $survey, \Schmidtch\Survey\Domain\Model\Appiontment $appiontment) {
        $this->view->assign('survey', $survey);
        $this->view->assign('appiontment', $appiontment);
        $this->view->assign('timeofday', $this->objectManager->get('Schmidtch\\Survey\\Domain\\Repository\\TimeofdayRepository')->findAll());
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Appiontment $appiontment
     * @param \Schmidtch\Survey\Domain\Model\TimeOfDay $timeofday
     */
    public function ajaxAddAction(
    \Schmidtch\Survey\Domain\Model\Appiontment $appiontment, \Schmidtch\Survey\Domain\Model\TimeOfDay $timeofday = NULL) {
        // Wenn das Feld leer ist, wird nicht persistiert
        if ($timeofday->getTimevalue() == "")
            return FALSE;

        // Uhrzeit zum Termin hinzufühgen
        $appiontment->addTimeOfDay($timeofday);

        $this->appiontmentRepository->update($appiontment);
        $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager')->persistAll();

        $timeofdays = $appiontment->getTimeOfDay();
        foreach ($timeofdays as $timeofday) {
            $json[$timeofday->getUid()] = array(
                'timevalue' => $timeofday->getTimevalue()
            );
        }
        return json_encode($json);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appiontment $appiontment
     */
    public function updateFormAction(
    \Schmidtch\Survey\Domain\Model\Survey $survey, \Schmidtch\Survey\Domain\Model\Appiontment $appiontment) {
        $this->view->assign('survey', $survey);
        $this->view->assign('appiontment', $appiontment);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appiontment $appiontment
     */
    public function updateFormAppiontmentAction(
    \Schmidtch\Survey\Domain\Model\Survey $survey, \Schmidtch\Survey\Domain\Model\Appiontment $appiontment) {
        $this->view->assign('survey', $survey);
        $this->view->assign('appiontment', $appiontment);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Appiontment $appiontment
     */
    public function updateAction(\Schmidtch\Survey\Domain\Model\Appiontment $appiontment) {
        $this->appiontmentRepository->update($repository);
        $this->redirect('list');
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appiontment $appiontment
     */
    public function deleteConfirmAction(\Schmidtch\Survey\Domain\Model\Appiontment $appiontment) {
        $this->view->assign('appiontment', $appiontment);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appiontment $appiontment
     */
    public function deleteAction(
    \Schmidtch\Survey\Domain\Model\Appiontment $appiontment, \Schmidtch\Survey\Domain\Model\Survey $survey) {
        $this->addFlashMessage(
                'Termin gelöscht!', 'Status', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK, TRUE
        );

        $this->objectManager->get('Schmidtch\\Survey\\Domain\\Repository\\surveyRepository')->update($survey);
        $this->appiontmentRepository->remove($appiontment);
        $this->redirect('show', 'Survey', NULL, array('survey' => $survey));
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Appiontment $appiontment
     */
    public function showAction(
    \Schmidtch\Survey\Domain\Model\Survey $survey, \Schmidtch\Survey\Domain\Model\Appiontment $appiontment) {
        $this->view->assign('survey', $survey);
        $this->view->assign('appiontment', $appiontment);
    }

}
