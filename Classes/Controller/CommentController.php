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
class CommentController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
	/**
	 * subscriberRepository
	 *
     * @var \Schmidtch\Survey\Domain\Repository\SubscriberRepository
	 * @inject
     */
    protected $subscriberRepository;
	
	/**
	 * CommentRepository
	 *
     * @var \Schmidtch\Survey\Domain\Repository\CommentRepository
	 * @inject
     */
    protected $commentRepository;
	
	/**
     * @param \Schmidtch\Survey\Domain\Repository\CommentRepository $commentRepository
     */
    public function injectCommentRepository(\Schmidtch\Survey\Domain\Repository\CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
	
	/**
	* @param \Schmidtch\Survey\Domain\Model\Comment $comment
	* @param \Schmidtch\Survey\Domain\Model\Subscriber $subscriber
	 * @param \Schmidtch\Survey\Domain\Model\Survey $survey	 
	 */
	public function deleteAction(
		\Schmidtch\Survey\Domain\Model\Comment $comment,
		\Schmidtch\Survey\Domain\Model\Subscriber $subscriber,
		\Schmidtch\Survey\Domain\Model\Survey $survey)
	{
		$this->commentRepository->remove($comment);
		$this->subscriberRepository->update($subscriber);
		$this->redirect('show', 'Survey', NULL, array('survey' => $survey));
	}
}	