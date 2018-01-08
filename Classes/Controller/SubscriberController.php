<?php
namespace Schmidtch\Survey\Controller;

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
 * TimeofdayController
 */
class SubscriberController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{	
	/**
	 * subscriberRepository
	 *
     * @var \Schmidtch\Survey\Domain\Repository\SubscriberRepository
	 * @inject
     */
    protected $subscriberRepository;
	
	/**
	 * timeofdayRepository
	 *
     * @var \Schmidtch\Survey\Domain\Repository\TimeOfDayRepository
	 * @inject
     */
    protected $timeofdayRepository;
	
	/**
	 * pollRepository
	 *
	 * @var \Schmidtch\Survey\Domain\Repository\PollRepository
	 * @inject
	 */
    protected $pollRepository;	
	
	/**
	 * @param \Schmidtch\Survey\Domain\Repository\SubscriberRepository $timeofdayRepository
	 */
	public function injectSubscriberRepository(\Schmidtch\Survey\Domain\Repository\SubscriberRepository $subscriberRepository) 
	{
		$this->subscriberRepository = $subscriberRepository;
	}  

	/**
	 * @param \Schmidtch\Survey\Domain\Model\Survey $survey
	 * @param \Schmidtch\Survey\Domain\Model\TimeOfDay $timeofday
	 * @param \Schmidtch\Survey\Domain\Model\Subscriber $subscriber
	 * @param \Schmidtch\Survey\Domain\Model\Poll $poll
	 */
	public function addAction (
		\Schmidtch\Survey\Domain\Model\Survey $survey,
		\Schmidtch\Survey\Domain\Model\Subscriber $subscriber,
		\Schmidtch\Survey\Domain\Model\Poll $poll = NULL)
	{
		$polls = $_POST['tx_survey_surveylisting']['polls'];
		$pollArray = $polls['poll'];
		$timeofdayArray = $polls['timeofday'];
		$uid = $polls['subscriber'][0];
		$appiontmentArray = $polls['appiontment'];
		
		$resultPoll = $this->pollRepository->addPoll($uid,$pollArray,$timeofdayArray,$appiontmentArray);
		$resultTimeofday = $this->timeofdayRepository->updatePoll($appiontmentArray,$timeofdayArray);		
		$countSubscriber = $this->pollRepository->countSubscriber($uid);
		$resultSubscriber = $this->subscriberRepository->updatePoll($uid,$countSubscriber); 
		$this->redirect('showAfter', 'Subscriber', NULL, array('subscriber' => $subscriber,'survey' => $survey));		
	}
	
	/**
	 * @param \Schmidtch\Survey\Domain\Model\Survey $survey
	 * @param \Schmidtch\Survey\Domain\Model\Subscriber $subscriber
	 */
	public function commentAjaxAction(
		\Schmidtch\Survey\Domain\Model\Survey $survey,
		\Schmidtch\Survey\Domain\Model\Subscriber $subscriber,
		\Schmidtch\Survey\Domain\Model\Comment $comment = NULL)
	{
		if ($comment->getComment()=="") return FALSE;
		
		$comment->setCommentdate(new \DateTime());
		$subscriber->addComment($comment);
		$this->subscriberRepository->update($subscriber);
		$this->objectManager->get( 'TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager' )->persistAll();
		
		$comments = $subscriber->getComments();
		foreach($comments as $comment){
			$json[$comment->getUid()] = array(
				'comment'=>$comment->getComment(),
				'commentdate'=>$commentdate->getCommentdate()
			);
		}
		return json_encode($json);
	}
	
	/**
	 * @param \Schmidtch\Survey\Domain\Model\Survey $survey
	 * @param \Schmidtch\Survey\Domain\Model\Subscriber $subscriber
	 */
	public function addFormAction (
		\Schmidtch\Survey\Domain\Model\Survey $survey,
		\Schmidtch\Survey\Domain\Model\Subscriber $subscriber)
	{
		$this->view->assign('survey', $survey);
		$this->view->assign('subscriber', $subscriber);
	}
	
	/**
	 * @param \Schmidtch\Survey\Domain\Model\Survey $survey
	 * @param \Schmidtch\Survey\Domain\Model\Subscriber $subscriber
	 */
	public function showAfterAction (
		\Schmidtch\Survey\Domain\Model\Survey $survey,
		\Schmidtch\Survey\Domain\Model\Subscriber $subscriber)
	{
		$this->view->assign('survey', $survey);		
		$this->view->assign('subscriber', $subscriber);
	}
	
	/**
	 * @param \Schmidtch\Survey\Domain\Model\Survey $survey
	 */
	public function showAction (
		\Schmidtch\Survey\Domain\Model\Survey $survey)
	{
		$this->view->assign('survey', $survey);		
	}
	
	/**
	 * @param \Schmidtch\Survey\Domain\Model\Survey $survey
	 * @param \Schmidtch\Survey\Domain\Model\Subscriber $subscriber
	 */
	public function registerFormAction (
		\Schmidtch\Survey\Domain\Model\Survey $survey,
		\Schmidtch\Survey\Domain\Model\Subscriber $subscriber = NULL)
	{
		$this->view->assign('survey', $survey);
		$this->view->assign('subscriber', $subscriber);
	}
	
	/**
	 * @param \Schmidtch\Survey\Domain\Model\Survey $survey
	 * @param \Schmidtch\Survey\Domain\Model\Subscriber $subscriber
	 */
	public function registerAction (
		\Schmidtch\Survey\Domain\Model\Survey $survey,
		\Schmidtch\Survey\Domain\Model\Subscriber $subscriber)
	{
		$survey->addSubscriber($subscriber);		
		$this->objectManager->get('Schmidtch\\Survey\\Domain\\Repository\\SurveyRepository')->update($survey);
        $persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        $persistenceManager->persistAll();
		$this->redirect('addForm', 'Subscriber', NULL, array('subscriber' => $subscriber,'survey' => $survey));
	}
	
}