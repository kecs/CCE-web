<?php

class qCal_DateTime_Recur_Filter_Daily extends qCal_DateTime_Recur_FreqFilter
{

  public function isIn($day)
  {
    $diff = $day - $this->startDate;
    $dayDiff = $diff / qCal_DateTime_Recur::DAY;
    return ($dayDiff % $this->interval === 0);
  }

}