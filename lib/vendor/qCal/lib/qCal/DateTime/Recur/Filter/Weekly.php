<?php

class qCal_DateTime_Recur_Filter_Weekly extends qCal_DateTime_Recur_FreqFilter
{

  protected static function dayToWeekStart($day)
  {
    return $day - (date('N', $day) - 1) * qCal_DateTime_Recur::DAY;
  }

  public function isIn($day)
  {
    $originalWeekStart = self::dayToWeekStart($this->startDate);
    $dayWeekStart = self::dayToWeekStart($day);

    $diff = $dayWeekStart - $originalWeekStart;
    $weekDiff = $diff / qCal_DateTime_Recur::DAY / 7;

    if ($this->count !== null
            && $weekDiff >= $this->count * $this->interval)
    {
      return false;
    }


    $ret = ($weekDiff % $this->interval === 0);
    return $ret;
  }

}