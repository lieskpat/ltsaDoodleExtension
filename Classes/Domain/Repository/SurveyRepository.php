<?php

namespace Schmidtch\Survey\Domain\Repository;

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
 * The repository for Surveys
 */
class SurveyRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

    // Wenn PID nicht gesetzt ist, wie im folgenden
    // plugin.tx_myextension.persistence.storagePid = 4
    // führt findAll() zu leerem Ergebnis
    // durch folgende Methode wird findAll() direkt auf DB ausgeführt
    public function initializeObject() {

        $this->defaultQuerySettings = $this->objectManager->get(
            'TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        $this->defaultQuerySettings->setRespectStoragePage(FALSE);
    }
    
    /**
     * find all surveys by a given organizer
     * 
     * @param \Schmidtch\Survey\Domain\Model\Organizer $organizerObject
     * @return \Schmidtch\Survey\Domain\Model\Survey 
     */
    public function findInOrganizer(\Schmidtch\Survey\Domain\Model\Organizer $organizerObject) {
        $query = $this->createQuery();
        $query->matching($query->equals('organizer', $organizerObject));
        return $query->execute();
    }

}
