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
 * organizer fe UID
 */
class Organizer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * UID of the Fe-User
     * 
     * @var int
     */
    protected $feUserUid = 0;
    
    /**
     * concatenated string from firstName and lastName
     * 
     * @var string $name
     */
    protected $name;

        /**
     *
     * @var string $firstName
     */
    protected $firstName;
    
    /**
     *
     * @var string $lastName
     */
    protected $lastName;
    
    /**
     * @param int $feUserUid the id from Fe_User 
     */
    public function __construct($feUserUid, $firstName = "", $lastName = "") {
        $this->setFeUserUid($feUserUid);
        if ($firstName !== "" and $lastName !== "") {
            $this->setName($firstName, $lastName);
        }
    }

        /**
     * Returns the feUserUid
     * 
     * @return int $feUserUid
     */
    public function getFeUserUid()
    {
        return $this->feUserUid;
    }
    
    /**
     * Sets the feUserUid
     * 
     * @param int $feUserUid
     * @return void
     */
    public function setFeUserUid($feUserUid)
    {
        $this->feUserUid = $feUserUid;
    }
    
    /**
     * 
     * @return string
     */
    function getName() {
        return $this->getFirstName() . " " . $this->getLastName();
    }

    /**
     * 
     * @return string
     */
    function getFirstName() {
        return $this->firstName;
    }

    /**
     * 
     * @return string
     */
    function getLastName() {
        return $this->lastName;
    }

    /**
     * 
     * @param string $firstName
     * @param string $lastName
     */
    function setName($firstName, $lastName) {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->name = $firstName . " " . $lastName;
    }

    /**
     * 
     * @param string $firstName
     */
    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    /**
     * 
     * @param string $lastName
     */
    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

}