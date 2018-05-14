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
 * SurveyController
 */
class SurveyController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * surveyRepository
     * 
     * @var \Schmidtch\Survey\Domain\Repository\SurveyRepository
     * 
     */
    protected $surveyRepository;

    /**
     * organizerRepository
     * 
     * @var \Schmidtch\Survey\Domain\Repository\OrganizerRepository
     * 
     */
    protected $organizerRepository;

    /**
     *
     * @var \Schmidtch\Survey\Service\AccessControlService
     * @inject
     */
    protected $accessControlService;

    /**
     * @param \Schmidtch\Survey\Domain\Repository\SurveyRepository $surveyRepository
     */
    public function injectSurveyRepository(
    \Schmidtch\Survey\Domain\Repository\SurveyRepository $surveyRepository) {
        $this->surveyRepository = $surveyRepository;
    }

    /**
     * @param \Schmidtch\Survey\Domain\Repository\OrganizerRepository $organizerRepository
     */
    public function injectOrganizerRepository(
    \Schmidtch\Survey\Domain\Repository\OrganizerRepository $organizerRepository) {
        $this->organizerRepository = $organizerRepository;
    }

    /**
     *
     */
    public function listAction() {
        $this->view->assign('surveys', $this->getAllSurveysByLoggedInFeUser($this->createAndPersistOrganizer()));
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Organizer $organizerObject
     * @return array $helpArray
     */
    private function getAllSurveysByLoggedInFeUser(\Schmidtch\Survey\Domain\Model\Organizer $organizerObject) {
        return $this->surveyRepository->findInOrganizer($organizerObject);
    }

    /**
     * 
     */
    private function persistAll() {
        $persistenceManager = $this->objectManager->get(
                'TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        $persistenceManager->persistAll();
    }

    /**
     * 
     * @param int $feUserUid
     * @return boolean
     */
    private function isOrganizerExist($feUserUid) {
        if (is_null($this->organizerRepository->findOneByFeUserUid($feUserUid))) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * @return \Schmidtch\Survey\Domain\Model\Organizer
     */
    private function createAndPersistOrganizer() {
        $organizerObject = NULL;
        if (!$this->isOrganizerExist($this->accessControlService->getFeUserUid())) {
            $organizerObject = new \Schmidtch\Survey\Domain\Model\Organizer(
                    $this->accessControlService->getFeUserUid()
                    , $this->accessControlService->getFeUserFirstName()
                    , $this->accessControlService->getFeUserLastName());
            $this->organizerRepository->add($organizerObject);
            $this->persistAll();
        } else {
            $organizerObject = $this->organizerRepository->findOneByFeUserUid(
                    $this->accessControlService->getFeUserUid());
        }
        return $organizerObject;
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     */
    public function newSurveyAction(\Schmidtch\Survey\Domain\Model\Survey $survey = NULL) {

        $organizerObject = $this->createAndPersistOrganizer();
        if ($this->accessControlService->hasLoggedInFeUser()) {
            $this->view->assign('surveysByFe', $this->getAllSurveysByLoggedInFeUser($organizerObject));
            $this->view->assign('survey', $survey);
            $this->view->assign('organizer', $organizerObject);
        } else {
            $this->forward('errorLoggedIn');
        }
    }

    /**
     * 
     */
    public function errorLoggedInAction() {
        //$this->view->assign();
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @param \Schmidtch\Survey\Domain\Model\Organizer $organizer
     */
    public function createSurveyAction(
    \Schmidtch\Survey\Domain\Model\Survey $survey
    , \Schmidtch\Survey\Domain\Model\Organizer $organizer) {

        $survey->setPostdate(new \DateTime());
        $survey->setOrganizer($organizer);
        $this->surveyRepository->add($survey);
        $this->persistAll();
        $this->redirect('newAppointment', 'Appointment', NULL, array('survey' => $survey));
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @validate $survey Schmidtch.Survey:ExistTimeOfDayToEveryAppointment
     */
    public function showAction(\Schmidtch\Survey\Domain\Model\Survey $survey) {
        $this->view->assign('survey', $survey);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $surveyByFe
     */
    public function updateFormAction(\Schmidtch\Survey\Domain\Model\Survey $survey) {
        $this->view->assign('survey', $survey);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $surveyByFe
     */
    public function updateAction(\Schmidtch\Survey\Domain\Model\Survey $survey) {
        $this->surveyRepository->update($survey);
        $this->redirect('updateForm', 'Survey', NULL, array('survey' => $survey));
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $surveyByFe
     */
    public function deleteConfirmAction(\Schmidtch\Survey\Domain\Model\Survey $survey) {
        $this->view->assign('survey', $survey);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     */
    public function deleteAction(\Schmidtch\Survey\Domain\Model\Survey $survey) {
        $this->surveyRepository->remove($survey);
        $this->redirect('newSurvey');
    }

    /**
     * action edit
     * 
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @ignorevalidation $survey
     * @return void
     */
    public function editAction(\Schmidtch\Survey\Domain\Model\Survey $survey) {
        $this->view->assign('survey', $survey);
    }

}
