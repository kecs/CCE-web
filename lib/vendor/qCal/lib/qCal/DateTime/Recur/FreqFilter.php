<?php

abstract class qCal_DateTime_Recur_FreqFilter extends qCal_DateTime_Recur_Filter
{

  protected $startDate;
  protected $interval;

  function __construct($startDate, $interval)
  {
    $this->startDate = $startDate;
    $this->interval = $interval;
  }

}