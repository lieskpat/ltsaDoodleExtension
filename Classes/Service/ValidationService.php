<?php

namespace Schmidtch\Survey\Service;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ValidationService
 *
 * @author Lieske
 */
class ValidationService implements \TYPO3\CMS\Core\SingletonInterface {

    /**
     * 
     * @param array $arrayToCheck
     */
    public function isValidateArrayOnEmptyItems(array $arrayToCheck) {
        $check = FALSE;
        foreach ($arrayToCheck as $value) {
            if ($value == '') {
                $check = FALSE;
                break;
            } else {
                $check = TRUE;
            }
        }
        return $check;
    }

    /**
     * 
     * @param \Schmidtch\Survey\Domain\Model\Survey $survey
     * @return boolean 
     */
    public function isValidateExistTimeOfDayToEveryAppointment(\Schmidtch\Survey\Domain\Model\Survey $survey) {
        $check = FALSE;
        foreach ($survey->getAppointments() as $appointment) {
            //wenn auch nur eines des getTimeOfDay arrays leer ist, muss false zurückgegeben werden
            if(!$this->isValidateArrayOnEmptyItems($appointment->getTimeOfDay())) {
                return $check;
            }
            foreach ($appointment->getTimeOfDay() as $value) {
                $helpArray[] = $value;
            }
            
        }
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($helpArray, 'HELP ARRAY');
        $check = $this->isValidateArrayOnEmptyItems($helpArray);
        return $check;
    }

}
