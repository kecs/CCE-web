<?php

class qCal_DateTime_Recur_Daily extends qCal_DateTime_Recur
{
  protected function doGetRecurrences($filters, $intervalStart, $intervalEnd)
  {
    //round interval start to DAY
    $intervalStart = qCal_DateTime::factory($intervalStart)->getDate()->getUnixTimestamp(false);

    $recurrences = array();
    for ($currentDay = $intervalStart; $currentDay <= $intervalEnd; $currentDay += 60 * 60 * 24)
    {
      foreach ($filters as $filter) /* @var $filter qCal_DateTime_Recur_Filter */
      {
        if (!$filter->isIn($currentDay))
        {
          continue 2;
        }
      }
      $recurrences[] = qCal_DateTime::factory($currentDay + $this->dtstart->getTime()->getTimestamp(false), $this->dtstart->getTime()->getTimezone());
    }
    return $recurrences;
  }

}