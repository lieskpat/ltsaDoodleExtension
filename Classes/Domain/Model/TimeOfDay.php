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
class TimeOfDay extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * time of the Appiontment
     * 
     * @var string
     */
    protected $timevalue = '';
    
    /**
     * timecheck
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Poll>
     * @cascade remove
     */
    protected $timecheck = null;
    
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
        $this->timecheck = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Returns the timevalue
     * 
     * @return string $timevalue
     */
    public function getTimevalue()
    {
        return $this->timevalue;
    }
    
    /**
     * Sets the timevalue
     * 
     * @param string $timevalue
     * @return void
     */
    public function setTimevalue($timevalue)
    {
        $this->timevalue = $timevalue;
    }
    
    /**
     * Adds a Poll
     * 
     * @param \Schmidtch\Survey\Domain\Model\Poll $timecheck
     * @return void
     */
    public function addTimecheck(\Schmidtch\Survey\Domain\Model\Poll $timecheck)
    {
        $this->timecheck->attach($timecheck);
    }
    
    /**
     * Removes a Poll
     * 
     * @param \Schmidtch\Survey\Domain\Model\Poll $timecheckToRemove The Poll to be removed
     * @return void
     */
    public function removeTimecheck(\Schmidtch\Survey\Domain\Model\Poll $timecheckToRemove)
    {
        $this->timecheck->detach($timecheckToRemove);
    }
    
    /**
     * Returns the timecheck
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Poll> $timecheck
     */
    public function getTimecheck()
    {
        return $this->timecheck;
    }
    
    /**
     * Sets the timecheck
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Poll> $timecheck
     * @return void
     */
    public function setTimecheck(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $timecheck)
    {
        $this->timecheck = $timecheck;
    }

}