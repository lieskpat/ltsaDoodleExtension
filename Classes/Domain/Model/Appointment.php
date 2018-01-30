<?php
namespace Schmidtch\Survey\Domain\Model;

/***************************************************************
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
 ***************************************************************/

/**
 * Appointment of the Survey
 */
class Appointment extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * date of the Appointment
     * 
     * @var \DateTime
     */
    protected $appointmentdate = null;
    
    /**
     * timeOfDay
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\TimeOfDay>
     * @cascade remove
     */
    protected $timeOfDay = null;
    
    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }
    
    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     * 
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->timeOfDay = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Returns the appointmentdate
     * 
     * @return \DateTime $appointmentdate
     */
    public function getAppointmentdate()
    {
        return $this->appointmentdate;
    }
    
    /**
     * Sets the appointmentdate
     * 
     * @param \DateTime $appointmentdate
     * @return void
     */
    public function setAppointmentdate(\DateTime $appointmentdate)
    {
        $this->appointmentdate = $appointmentdate;
    }
    
    /**
     * Adds a TimeOfDay
     * 
     * @param \Schmidtch\Survey\Domain\Model\TimeOfDay $timeOfDay
     * @return void
     */
    public function addTimeOfDay(\Schmidtch\Survey\Domain\Model\TimeOfDay $timeOfDay)
    {
        $this->timeOfDay->attach($timeOfDay);
    }
    
    /**
     * Removes a TimeOfDay
     * 
     * @param \Schmidtch\Survey\Domain\Model\TimeOfDay $timeOfDayToRemove The TimeOfDay to be removed
     * @return void
     */
    public function removeTimeOfDay(\Schmidtch\Survey\Domain\Model\TimeOfDay $timeOfDayToRemove)
    {
        $this->timeOfDay->detach($timeOfDayToRemove);
    }
    
    /**
     * Returns the timeOfDay
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\TimeOfDay> $timeOfDay
     */
    public function getTimeOfDay()
    {
        return $this->timeOfDay;
    }
    
    /**
     * Sets the timeOfDay
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\TimeOfDay> $timeOfDay
     * @return void
     */
    public function setTimeOfDay(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $timeOfDay)
    {
        $this->timeOfDay = $timeOfDay;
    }

}