<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Schmidtch\Survey\Validation\Validator;

/**
 * Description of ExistTimeOfDayToEveryAppointment
 *
 * @author Lieske
 */
class ExistTimeOfDayToEveryAppointmentValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator{
    
    /**
     * 
     * @var \Schmidtch\Survey\Service\ValidationService $validationService
     *
     */
    protected $validationService;
    
    /**
     * @param \Schmidtch\Survey\Service\ValidationService $validationService
     */
    public function injectValidationService(
    \Schmidtch\Survey\Service\ValidationService $validationService) {
        $this->validationService = $validationService;
    }
    
    /**
     * 
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     */
    protected function isValid($survey) {
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->validationService->isValidateExistTimeOfDayToEveryAppointment($survey));
        if(!$this->validationService->isValidateExistTimeOfDayToEveryAppointment($survey)) {
            $this->addError('Bitte geben Sie zu jedem Termin mindestens eine Uhrzeit ein', 1389545446);
            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('isValid: FEHLER', 'isValid');
        } else {
            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump('isValid: KEIN FEHLER', 'isValid');
        }
    }

}
