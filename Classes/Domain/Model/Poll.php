<?php

namespace Schmidtch\Survey\Domain\Model;

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
 * true/false Subscriber Timevalue
 */
class Poll extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * poll
     * 
     * @var bool
     */
    protected $pollValue;
    
    /**
     * __construct
     * 
     * @param bool $pollValue 
     */
    public function __construct($pollValue) {
        $this->setPollValue($pollValue);
    }
    
    /**
     * 
     * @return bool $pollValue
     */
    function getPollValue() {
        return $this->pollValue;
    }
    
    /**
     * 
     * @param bool $pollValue
     */
    public function setPollValue($pollValue) {
        $this->pollValue = $pollValue;
    }

    /**
     * Returns the boolean state of poll
     * 
     * @return bool
     */
    public function isPoll() {
        return $this->pollValue;
    }

}
