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

  public function getDuration()
  {
    return $this->to - $this->from;
  }

  /**
   *
   * @param float $factor new duration will become old duration * $factor
   */
  public function zoom($factor)
  {
    $difference = (1 - $factor) * $this->getDuration() / 2;

    $this->from += $difference;
    $this->to -= $difference;
  }

}