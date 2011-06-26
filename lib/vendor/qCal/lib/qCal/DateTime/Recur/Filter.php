<?php

abstract class qCal_DateTime_Recur_Filter
{

  /**
   * Creates the recurrences for this rule. Left to children to do this.
   * @param int $day UNIX timestamp of the start of the day
   */
  abstract public function isIn($day);
}