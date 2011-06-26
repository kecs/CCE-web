<?php

class qCal_DateTime_Recur_Filter_ByDay extends qCal_DateTime_Recur_Filter
{

  /**
   * values: arr(MO => 0)
   * @var array
   */
  protected $days;

  function __construct($days)
  {
    $this->days = $days;
  }

  public function isIn($day)
  {
    $weekdays = array('MO', 'TU', 'WE', 'TH', 'FR', 'SA', 'SU');
    $dayNum = date('N', $day)-1;
    $dayName = $weekdays[$dayNum];
    
    foreach ($this->days as $day)
    {
      if(key($day) == $dayName) {
        return true;
      }
    }
    return false;
  }

}