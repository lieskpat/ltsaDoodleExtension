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
 * time of day
 */
class Timeofday extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * time of the Appiontment
     * 
     * @var string
     */
    protected $timeValue = '';
    
    /**
     * timecheck
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Poll>
     * @cascade remove
     */
    protected $timeCheck = null;
    
    /**
     * __construct
     */
    public function __construct($timeValue)
    {
        $this->setTimeValue($timeValue);
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
        $this->timeCheck = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Returns the timevalue
     * 
     * @return string $timevalue
     */
    public function getTimeValue()
    {
        return $this->timeValue;
    }
    
    /**
     * Sets the timevalue
     * 
     * @param string $timeValue
     * @return void
     */
    public function setTimeValue($timeValue)
    {
        $this->timeValue = $timeValue;
    }
    
    /**
     * Adds a Poll
     * 
     * @param \Schmidtch\Survey\Domain\Model\Poll $timeCheck
     * @return void
     */
    public function addTimecheck(\Schmidtch\Survey\Domain\Model\Poll $timeCheck)
    {
        $this->timeCheck->attach($timeCheck);
    }
    
    /**
     * Removes a Poll
     * 
     * @param \Schmidtch\Survey\Domain\Model\Poll $timecheckToRemove The Poll to be removed
     * @return void
     */
    public function removeTimecheck(\Schmidtch\Survey\Domain\Model\Poll $timecheckToRemove)
    {
        $this->timeCheck->detach($timecheckToRemove);
    }
    
    /**
     * Returns the timecheck
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Poll> $timeCheck
     */
    public function getTimecheck()
    {
        return $this->timeCheck;
    }
    
    /**
     * Sets the timecheck
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Poll> $timeCheck
     * @return void
     */
    public function setTimecheck(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $timeCheck)
    {
        $this->timeCheck = $timeCheck;
    }

}