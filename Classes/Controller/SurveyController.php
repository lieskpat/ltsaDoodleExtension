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
     * @inject
     */
    protected $surveyRepository = NULL;

    /**
     * @param \Schmidtch\Survey\Domain\Repository\SurveyRepository $surveyRepository
     */
    public function injectSurveyRepository(\Schmidtch\Survey\Domain\Repository\SurveyRepository $surveyRepository) {
        $this->surveyRepository = $surveyRepository;
    }
    
    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     */
    public function newSurveyAction(\Schmidtch\Survey\Domain\Model\Survey $survey = NULL) {
        $this->view->assign('survey', $survey);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     */
    public function createSurveyAction(\Schmidtch\Survey\Domain\Model\Survey $survey) {
       
        $survey->setPostdate(new \DateTime());
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($survey->getPostdate());
        $this->surveyRepository->add($survey);
        $this->redirect('addFormDate', 'Appointment', NULL, array('survey' => $survey));
        
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     */
    public function showAction(\Schmidtch\Survey\Domain\Model\Survey $survey) {
        $this->view->assign('survey', $survey);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     */
    public function updateFormAction(\Schmidtch\Survey\Domain\Model\Survey $survey) {
        $this->view->assign('survey', $survey);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     */
    public function updateAction(\Schmidtch\Survey\Domain\Model\Survey $survey) {
        $this->surveyRepository->update($survey);
        $this->redirect('updateForm', 'Survey', NULL, array('survey' => $survey));
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     */
    public function deleteConfirmAction(\Schmidtch\Survey\Domain\Model\Survey $survey) {
        $this->view->assign('survey', $survey);
    }

    /**
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     */
    public function deleteAction(\Schmidtch\Survey\Domain\Model\Survey $survey) {
        $this->surveyRepository->remove($survey);
        $this->redirect('list');
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
