<?php

abstract class qCal_DateTime_Recur_FreqFilter extends qCal_DateTime_Recur_Filter
{

  protected $startDate;
  protected $interval;
  protected $count;

  function __construct($startDate, $interval, $count = null)
  {
    $this->startDate = $startDate;
    $this->interval = $interval;
    $this->count = $count;
  }

}