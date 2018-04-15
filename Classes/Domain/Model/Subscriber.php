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
 * Subscriber of the survey
 */
class Subscriber extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name of the subscriber
     * 
     * @var string
     */
    protected $nameSubscriber = '';
    
    /**
     * comments
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Comment>
     * @cascade remove
     */
    protected $comments = null;
    
    /**
     * subcheck
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Poll>
     * @cascade remove
     */
    protected $subcheck = null;
    
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
        $this->comments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->subcheck = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Returns the nameSubscriber
     * 
     * @return string $nameSubscriber
     */
    public function getNameSubscriber()
    {
        return $this->nameSubscriber;
    }
    
    /**
     * Sets the nameSubscriber
     * 
     * @param string $nameSubscriber
     * @return void
     */
    public function setNameSubscriber($nameSubscriber)
    {
        $this->nameSubscriber = $nameSubscriber;
    }
    
    /**
     * Adds a Comment
     * 
     * @param \Schmidtch\Survey\Domain\Model\Comment $comment
     * @return void
     */
    public function addComment(\Schmidtch\Survey\Domain\Model\Comment $comment)
    {
        $this->comments->attach($comment);
    }
    
    /**
     * Removes a Comment
     * 
     * @param \Schmidtch\Survey\Domain\Model\Comment $commentToRemove The Comment to be removed
     * @return void
     */
    public function removeComment(\Schmidtch\Survey\Domain\Model\Comment $commentToRemove)
    {
        $this->comments->detach($commentToRemove);
    }
    
    /**
     * Returns the comments
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Comment> $comments
     */
    public function getComments()
    {
        return $this->comments;
    }
    
    /**
     * Sets the comments
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Comment> $comments
     * @return void
     */
    public function setComments(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $comments)
    {
        $this->comments = $comments;
    }
    
    /**
     * Adds a Poll
     * 
     * @param \Schmidtch\Survey\Domain\Model\Poll $subcheck
     * @return void
     */
    public function addSubcheck(\Schmidtch\Survey\Domain\Model\Poll $subcheck)
    {
        $this->subcheck->attach($subcheck);
    }
    
    /**
     * Removes a Poll
     * 
     * @param \Schmidtch\Survey\Domain\Model\Poll $subcheckToRemove The Poll to be removed
     * @return void
     */
    public function removeSubcheck(\Schmidtch\Survey\Domain\Model\Poll $subcheckToRemove)
    {
        $this->subcheck->detach($subcheckToRemove);
    }
    
    /**
     * Returns the subcheck
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Poll> $subcheck
     */
    public function getSubcheck()
    {
        return $this->subcheck;
    }
    
    /**
     * Sets the subcheck
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Poll> $subcheck
     * @return void
     */
    public function setSubcheck(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $subcheck)
    {
        $this->subcheck = $subcheck;
    }

}