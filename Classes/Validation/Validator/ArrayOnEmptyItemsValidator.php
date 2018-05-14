<?php

namespace Schmidtch\Survey\Validation\Validator;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArrayValidator
 *
 * @author Lieske
 */
class ArrayOnEmptyItemsValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

    /**
     * 
     * @var \Schmidtch\Survey\Service\ValidationService $validationService
     *
     */
    protected $validationService;
    
    /**
     * 
     */
    public function __construct() {
        $this->validationService = new \Schmidtch\Survey\Service\ValidationService();
    }

    /**
     * 
     * @param array $arrayToCheck
     */
    protected function isValid($arrayToCheck) {
        //Eigentlich muss geprüft werden, ob alle array Items valide DateTime Objecte sind
        if (!$this->validationService->isValidateArrayOnEmptyItems($arrayToCheck)) {
            $this->addError('Bitte füllen Sie die Termine korrekt aus', 1389545446);
        }
        
    }

}
