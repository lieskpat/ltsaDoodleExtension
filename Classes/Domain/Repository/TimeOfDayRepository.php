<?php
namespace Schmidtch\Survey\Domain\Repository;

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
 * The repository for TimeOfDays
 */
class TimeOfDayRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
	public function updatePoll($appiontmentArray,$timeofdayArray)
	{
		for($a=0;$a<sizeof($appiontmentArray);$a++) {
		
			for($b=0;$b<sizeof($timeofdayArray[$a]);$b++) {

				$sql = "SELECT * FROM tx_survey_domain_model_poll WHERE timeofday='".$timeofdayArray[$a][$b]."'";
				$result = $GLOBALS['TYPO3_DB']->sql_query($sql);
				$num_rows = $result->num_rows;				
				
				$sql = "UPDATE tx_survey_domain_model_timeofday
					SET timecheck='".$num_rows."'
					WHERE uid='".$timeofdayArray[$a][$b]."'";
				$resultInsert = $GLOBALS['TYPO3_DB']->sql_query($sql);				
			}
		}		
		return $resultInsert;
	}

	public function countTimeofday($timeofday)
	{
		$query = $this->createQuery();
		$sql = "SELECT * FROM tx_survey_domain_model_poll WHERE timeofday='".$timeofday."'";
		$query->statement( $sql );
		$result = $query->count();
		return $result;
	}
    
}