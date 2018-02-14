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
 * Survey
 */
class Survey extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title of the survey
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';
    
    /**
     * description of the survey
     * 
     * @var string
     */
    protected $description = '';
    
    /**
     * postdate of the survey
     * 
     * @var \DateTime
     */
    protected $postdate = null;
    
    /**
     * name of the organizer
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $organizername = '';
    
    /**
     * deadline of the survey
     * 
     * @var \DateTime
     */
    protected $deadline = null;
    
    /**
     * visible
     * 
     * @var bool
     */
    protected $visible = false;
    
    /**
     * commentVisible
     * 
     * @var bool
     */
    protected $commentVisible = false;
    
    /**
     * organizer
     * 
     * @var \Schmidtch\Survey\Domain\Model\Organizer
     */
    protected $organizer = null;
    
    /**
     * appointments
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Appointment>
     * @cascade remove
     */
    protected $appointments = null;
    
    /**
     * comments
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Comment>
     * @cascade remove
     */
    protected $comments = null;
    
    /**
     * subscribers
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Subscriber>
     * @cascade remove
     */
    protected $subscribers = null;
    
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
        $this->appointments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->comments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->subscribers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Returns the title
     * 
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Sets the title
     * 
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Returns the description
     * 
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Sets the description
     * 
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * Returns the postdate
     * 
     * @return \DateTime $postdate
     */
    public function getPostdate()
    {
        return $this->postdate;
    }
    
    /**
     * Sets the postdate
     * 
     * @param \DateTime $postdate
     * @return void
     */
    public function setPostdate(\DateTime $postdate)
    {
        $this->postdate = $postdate;
    }
    
    /**
     * Returns the organizername
     * 
     * @return string $organizername
     */
    public function getOrganizername()
    {
        return $this->organizername;
    }
    
    /**
     * Sets the organizername
     * 
     * @param string $organizername
     * @return void
     */
    public function setOrganizername($organizername)
    {
        $this->organizername = $organizername;
    }
    
    /**
     * Returns the deadline
     * 
     * @return \DateTime $deadline
     */
    public function getDeadline()
    {
        return $this->deadline;
    }
    
    /**
     * Sets the deadline
     * 
     * @param \DateTime $deadline
     * @return void
     */
    public function setDeadline(\DateTime $deadline)
    {
        $this->deadline = $deadline;
    }
    
    /**
     * Returns the visible
     * 
     * @return bool $visible
     */
    public function getVisible()
    {
        return $this->visible;
    }
    
    /**
     * Sets the visible
     * 
     * @param bool $visible
     * @return void
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }
    
    /**
     * Returns the boolean state of visible
     * 
     * @return bool
     */
    public function isVisible()
    {
        return $this->visible;
    }
    
    /**
     * Returns the commentVisible
     * 
     * @return bool $commentVisible
     */
    public function getCommentVisible()
    {
        return $this->commentVisible;
    }
    
    /**
     * Sets the commentVisible
     * 
     * @param bool $commentVisible
     * @return void
     */
    public function setCommentVisible($commentVisible)
    {
        $this->commentVisible = $commentVisible;
    }
    
    /**
     * Returns the boolean state of commentVisible
     * 
     * @return bool
     */
    public function isCommentVisible()
    {
        return $this->commentVisible;
    }
    
    /**
     * Returns the organizer
     * 
     * @return \Schmidtch\Survey\Domain\Model\Organizer $organizer
     */
    public function getOrganizer()
    {
        return $this->organizer;
    }
    
    /**
     * Sets the organizer
     * 
     * @param \Schmidtch\Survey\Domain\Model\Organizer $organizer
     * @return void
     */
    public function setOrganizer(\Schmidtch\Survey\Domain\Model\Organizer $organizer)
    {
        $this->organizer = $organizer;
    }
    
    /**
     * Adds a Appointment
     * 
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointment
     * @return void
     */
    public function addAppointment(\Schmidtch\Survey\Domain\Model\Appointment $appointment) {
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($appointment);
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->$appointments);
        $this->appointments->attach($appointment);
    }
    
    /**
     * Removes a Appointment
     * 
     * @param \Schmidtch\Survey\Domain\Model\Appointment $appointmentToRemove The Appointment to be removed
     * @return void
     */
    public function removeAppointment(\Schmidtch\Survey\Domain\Model\Appointment $appointmentToRemove)
    {
        $this->appointments->detach($appointmentToRemove);
    }
    
    /**
     * Returns the appointments
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Appointment> $appointments
     */
    public function getAppointments()
    {
        return $this->appointments;
    }
    
    /**
     * Sets the appointments
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Appointment> $appointments
     * @return void
     */
    public function setAppointments(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $appointments)
    {
        $this->appointments = $appointments;
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
     * Adds a Subscriber
     * 
     * @param \Schmidtch\Survey\Domain\Model\Subscriber $subscriber
     * @return void
     */
    public function addSubscriber(\Schmidtch\Survey\Domain\Model\Subscriber $subscriber)
    {
        $this->subscribers->attach($subscriber);
    }
    
    /**
     * Removes a Subscriber
     * 
     * @param \Schmidtch\Survey\Domain\Model\Subscriber $subscriberToRemove The Subscriber to be removed
     * @return void
     */
    public function removeSubscriber(\Schmidtch\Survey\Domain\Model\Subscriber $subscriberToRemove)
    {
        $this->subscribers->detach($subscriberToRemove);
    }
    
    /**
     * Returns the subscribers
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Subscriber> $subscribers
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }
    
    /**
     * Sets the subscribers
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Schmidtch\Survey\Domain\Model\Subscriber> $subscribers
     * @return void
     */
    public function setSubscribers(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $subscribers)
    {
        $this->subscribers = $subscribers;
    }

}