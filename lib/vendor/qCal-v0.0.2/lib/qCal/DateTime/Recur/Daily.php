<?php

class qCal_DateTime_Recur_Daily extends qCal_DateTime_Recur
{

  protected function doGetRecurrences($filters, qCal_DateTime $startDt, qCal_DateTime $endDt)
  {
    $start = $startDt->getUnixTimestamp();
    $end = $endDt->getUnixTimestamp();
    $recurrences = array();
    
    for ($current = $start; $current <= $end; $current += 60*60*24)
    {
      foreach ($filters as $filter) /* @var $filter qCal_DateTime_Recur_Filter */
      {
        if (! $filter->isIn($current))
        {
          continue 2;
        }
      }
      $recurrences[] = qCal_DateTime::factory($current);
    }
    return $recurrences;
  }

}