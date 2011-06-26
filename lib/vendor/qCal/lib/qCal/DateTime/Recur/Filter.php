<?php

abstract class qCal_DateTime_Recur_Filter
{

  /**
   * @var mixed The value of this rule
   */
  protected $value;

  /**
   * Constructor
   * @param The value of the rule. If this is a ByMonth rule, then 1 would mean January
   */
  public function __construct($value)
  {

    $this->value = $value;
  }

  /**
   * Creates the recurrences for this rule. Left to children to do this.
   * @param int $day UNIX timestamp of the start of the day
   */
  abstract public function isIn($day);
}