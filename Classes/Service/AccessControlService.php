<?php

namespace Schmidtch\Survey\Service;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccessControlService
 *
 * @author lies
 */
class AccessControlService implements \TYPO3\CMS\Core\SingletonInterface {

    /**
     * 
     * @return boolean
     */
    public function hasLoggedInFeUser() {
        return $GLOBALS['TSFE']->loginUser === 1 ? TRUE : FALSE;
    }

    /**
     * 
     * @return int
     */
    public function getFeUserUid() {
        if ($this->hasLoggedInFrontendUser() && !empty($GLOBALS['TSFE']->fe_user->user['uid'])) {
            return intval($GLOBALS['TSFE']->fe_user->user['uid']);
        }
        return NULL;
    }
    
    /**
     * 
     * @return string
     */
    public function getFeUserName() {
        if ($this->hasLoggedInFrontendUser() && !empty($GLOBALS['TSFE']->fe_user->user['name'])) {
            return $GLOBALS['TSFE']->fe_user->user['name'];
        }
        return "";
    }
    
    /**
     * 
     * @return string
     */
    public function getFeUserFirstName() {
        if ($this->hasLoggedInFrontendUser() && !empty($GLOBALS['TSFE']->fe_user->user['first_name'])) {
            return $GLOBALS['TSFE']->fe_user->user['first_name'];
        }
        return "";
    }
    
    public function getFeUserLastName() {
        if ($this->hasLoggedInFrontendUser() && !empty($GLOBALS['TSFE']->fe_user->user['last_name'])) {
            return $GLOBALS['TSFE']->fe_user->user['last_name'];
        }
        return "";
    }

}
