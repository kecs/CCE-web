<?php

class TimePeriod
{

  public $from;
  public $to;

  /**
   *
   * @param float $from unix timestamp (float seconds)
   * @param float $to unix timestamp (float seconds)
   */
  function __construct($from, $to)
  {
    $this->from = $from;
    $this->to = $to;
  }

}