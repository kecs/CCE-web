<?php

/**
 * This is a class that is used within qCal_Value_Recur to internally store a recur property
 * @todo The RFC says that invalid byXXX rule parts should simply be ignored. So I'm not sure if
 * I should be hurling exceptions at the poor user all over the place like I am in here.
 */
class qCal_DateTime_Recur
{

  /**
   * @var array An array of week days. Used throughout this class to validate input.
   */
  protected $weekdays = array(
      'MO' => 'Monday',
      'TU' => 'Tuesday',
      'WE' => 'Wednesday',
      'TH' => 'Thursday',
      'FR' => 'Friday',
      'SA' => 'Saturday',
      'SU' => 'Sunday',
  );
  /**
   * @var qCal_DateTime The start date/time of the recurrence
   */
  protected $dtstart;
  /**
   * @var string frequency of the recurrence
   */
  protected $freq;
  /**
   * @var qCal_Date The date/time which the recurrence ends
   */
  protected $until;
  /**
   * @var integer The amount of recurrences
   */
  protected $count;
  /**
   * @var integer Interval of recurrence (for every 3 days, "3" would be the interval)
   */
  protected $interval = 1;
  /**
   * @var integer|array An integer between 0 and 59 (for multiple, set as an array)
   */
  protected $bysecond;
  /**
   * @var integer|array An integer between 0 and 59 (or an array of integers for multiple)
   */
  protected $byminute;
  /**
   * @var integer|array An integer or array of integers between 0 and 23
   */
  protected $byhour;
  /**
   * @var string If present, represents the nth occurrence of a specific day within monthly or yearly
   * so it can be something like +1MO (or simply 1MO) for the first monday within the month, whereas
   * -1MO for the last monday of the month. Or it can be simply MO to represent every monday within the month
   */
  protected $byday;
  /**
   * @var integer|array An integer or array of integers. -31 to -1 or 1 to 31. -10 would mean the tenth to last
   * day of the month. [1,5,-5] would be the 1st, 5th, and 5th to last days of the month
   */
  protected $bymonthday;
  /**
   * @var integer|array An integer or array of integers. -366 to -1 or 1 to 366. -306 represents the 306th to last
   * day of the year (March 1st)
   */
  protected $byyearday;
  /**
   * @var integer|array An integer or array of integers. -53 to -1 or 1 to 53. Only valid for yearly rules. 
   * 3 represents the third week of the year.
   */
  protected $byweekno;
  /**
   * @var integer|array An integer or array of integers. 1 to 12. 3 would represent March
   */
  protected $bymonth;
  /**
   * @var integer If present, it indicates the nth occurrence of the specific occurrence within the set of 
   * events specified by this recurrence rule
   */
  protected $bysetpos;
  /**
   * @var string Must be one of the weekdays specified above (2 char). Specifies the day on which the work week
   * starts. This is significant when a weekly rule has an interval greater than 1 and a byday rule part is specified.
   * This is also significant when in a yearly rule when a byweekno rule part is specified. Defaults to "MO"
   */
  protected $wkst = "MO";

  /**
   * Constructor
   * @param $freq string Must be one of the freqtypes specified above.
   * @throws qCal_Date_Exception_InvalidRecur if a frequency other than those specified above is passed in
   */
  public function __construct($freq, $dtstart = null)
  {
    $this->freq = $freq;
    $this->dtstart = is_null($dtstart) ? null : qCal_DateTime::factory($dtstart);
  }

  /**
   * Specifies the date when the recurrence stops, inclusively. If not present, and there is no count specified,
   * then the recurrence goes on "forever".
   * This is a getter as well as a setter (if no arg is supplied, it is a getter)
   * @param $until string|qCal_Date|DateTime If time is specified, it must be UTC
   * @throws qCal_Date_Exception_InvalidRecur
   * @return self
   */
  public function until($until = null)
  {

    if (is_null($until))
      return $this->until;
    if ($this->count())
      throw new qCal_DateTime_Exception_InvalidRecur('A recurrence count and an until date cannot both be specified');
    $this->until = qCal_DateTime::factory($until);
    return $this;
  }

  /**
   * Specifies the amount of recurrences before the recurrence ends. If neither this nor "until" is specified,
   * the recurrence repeats "forever".
   * This is a getter as well as a setter (if no arg is supplied, it is a getter)
   * @param $count integer The amount of recurrences before it stops
   * @throws qCal_Date_Exception_InvalidRecur
   * @return self
   */
  public function count($count = null)
  {

    if (is_null($count))
      return $this->count;
    if ($this->until())
      throw new qCal_DateTime_Exception_InvalidRecur('A recurrence count and an until date cannot both be specified');
    $this->count = (integer) $count;
    return $this;
  }

  /**
   * Specifies the start of the work-week, which is Monday by default
   */
  public function wkst($wkst = null)
  {

    if (is_null($wkst))
      return $this->wkst;
    $abbrs = array_keys($this->weekdays);
    if (!in_array($wkst, $abbrs))
      throw new qCal_DateTime_Exception_InvalidRecur('"' . $wkst . '" is not a valid week day, must be one of the following: ' . implode(', ', $abbrs));
    $this->wkst = $wkst;
    // @todo I wonder if re-sorting the weekdays array would help me in any way...
  }

  /**
   * Specifies the interval of recurrences
   * This is a getter as well as a setter (if no arg is supplied, it is a getter)
   * @param $interval integer The interval of recurrences, for instance every "3" days
   * @throws qCal_DateTime_Exception_InvalidRecur
   * @return self
   */
  public function interval($interval = null)
  {

    if (is_null($interval))
      return $this->interval;
    $this->interval = (integer) $interval;
    return $this;
  }

  /**
   * Specifies a rule which will happen on every nth second. 
   * This is a getter as well as a setter (if no arg is supplied, it is a getter)
   * @param $second integer|array Can be an integer (or array of ints) between 0 and 59
   * @throws qCal_DateTime_Exception_InvalidRecur
   * @return self
   */
  public function bySecond($second = null)
  {

    if (is_null($second))
      return $this->bysecond;
    if (!is_array($second))
      $second = array($second);
    $this->bysecond = $second;
    return $this;
  }

  /**
   * Specifies a rule which will happen on every nth minute
   * This is a getter as well as a setter (if no arg is supplied, it is a getter)
   * @param $minute integer|array Can be an integer (or array of ints) between 0 and 59
   * @throws qCal_DateTime_Exception_InvalidRecur
   * @return self
   */
  public function byMinute($minute = null)
  {

    if (is_null($minute))
      return $this->byminute;
    if (!is_array($minute))
      $minute = array($minute);
    $this->byminute = $minute;
    return $this;
  }

  /**
   * Specifies a rule which will happen on every nth hour
   * This is a getter as well as a setter (if no arg is supplied, it is a getter)
   * @param $hour integer|array Can be an integer (or array of ints) between 0 and 23
   * @throws qCal_DateTime_Exception_InvalidRecur
   * @return self
   */
  public function byHour($hour = null)
  {

    if (is_null($hour))
      return $this->byhour;
    if (!is_array($hour))
      $hour = array($hour);
    $this->byhour = $hour;
    return $this;
  }

  /**
   * Specifies a rule which will happen on whichever day is specified. For instance, "MO" would
   * mean every monday.
   * This is a getter as well as a setter (if no arg is supplied, it is a getter)
   * Sets $this->byday into an array of arrays like array('SU' => 1) for '1SU' and array('SU' => 0) for 'SU'
   * @param $day string|array Must be one of the 2-char week days specified above. Can be preceded by
   * a positive or negative integer to represent, for instance, the third monday of the month (3MO) or second to last
   * Sunday of the month (-2SU)
   * @throws qCal_DateTime_Exception_InvalidRecur
   * @return self
   */
  public function byDay($day = null)
  {

    if (is_null($day))
    {
      $ret = array();
      foreach ($this->byday as $val)
      {
        $num = (current($val) == 0) ? "" : current($val);
        $ret[] = $num . key($val);
      }
      return $ret;
    }
    if (!is_array($day))
      $day = explode(',', $day);
    $days = array();
    foreach ($day as $d)
    {
      // optional plus or minus followed by a series of digits as group 1
      // two-character week day as group 2
      if (preg_match('/^([+-]?[0-9]+)?(MO|TU|WE|TH|FR|SA|SU)$/', $d, $matches))
      {
        $num = ($matches[1] == "") ? "0" : $matches[1];
        $wday = $matches[2];
        if (substr($num, 0, 1) == "+")
        {
          $num = substr($num, 1);
        }
        $days[] = array($wday => $num);
      }
    }
    $this->byday = $days;
    return $this;
  }

  /**
   * Specifies a rule which will happen on the month days specified. For instance, 23 would mean the 23rd of every month.
   * This is a getter as well as a setter (if no arg is supplied, it is a getter)
   * @param integer|array Must be between 1 and 31 or -31 to 1 (or an array of those values)
   * @throws qCal_DateTime_Exception_InvalidRecur
   * @return self
   */
  public function byMonthDay($monthday = null)
  {

    if (is_null($monthday))
      return $this->bymonthday;
    if (!is_array($monthday))
      $monthday = array($monthday);
    $this->bymonthday = $monthday;
    return $this;
  }

  /**
   * Specifies a rule which will happen on the nth day of the year
   * This is a getter as well as a setter (if no arg is supplied, it is a getter)
   * @param integer|array Must be between 1 and 366 or -366 to -1.
   * @throws qCal_DateTime_Exception_InvalidRecur
   * @return self
   */
  public function byYearDay($yearday = null)
  {

    if (is_null($yearday))
      return $this->byyearday;
    if (!is_array($yearday))
      $yearday = array($yearday);
    $this->byyearday = $yearday;
    return $this;
  }

  /**
   * Specifies a rule which will happen on the nth week of the year
   * This is a getter as well as a setter (if no arg is supplied, it is a getter)
   * @param integer|array Must be between 1 and 53 or -53 to -1.
   * @throws qCal_DateTime_Exception_InvalidRecur
   * @return self
   */
  public function byWeekNo($weekno = null)
  {

    if (is_null($weekno))
      return $this->byweekno;
    if (!is_array($weekno))
      $weekno = array($weekno);
    $this->byweekno = $weekno;
    return $this;
  }

  /**
   * Specifies a rule which will happen on the nth month of the year
   * This is a getter as well as a setter (if no arg is supplied, it is a getter)
   * @param integer|array Must be between 1 and 12
   * @throws qCal_DateTime_Exception_InvalidRecur
   * @return self
   */
  public function byMonth($month = null)
  {

    if (is_null($month))
      return $this->bymonth;
    if (!is_array($month))
      $month = array($month);
    $this->bymonth = $month;
    return $this;
  }

  /**
   * Indicates the nth occurrence of the specific occurrence within the set of
   * events specified by the rule.
   * This is a getter as well as a setter (if no arg is supplied, it is a getter)
   * @todo I don't really understand how this works... :( Figure out wtf it is for.
   * @throws qCal_DateTime_Exception_InvalidRecur
   * @return self
   */
  public function bySetPos($setpos = null)
  {

    if (is_null($setpos))
      return $this->bysetpos;
    $this->bysetpos = (integer) $setpos;
    return $this;
  }

  /**
   * Factory method generates the correct recur type based on the string it is passed: "yearly, weekly, etc."
   * @param string The frequency type of recurrence rule you want to generate
   * @param mixed The start date/time for the recurrence. Accepts anything qCal_Date accepts
   */
  static public function factory($freq, $start)
  {

    $class = new self($freq, $start);
    return $class;
  }

  /**
   * Fetches instances of the recurrence rule in the given time period. Because recurrences
   * could potentially go on forever, there is no way to fetch ALL instances of a recurrence rule
   * other than providing a date range that spans the entire length of the recurrence.
   * 
   * The way this will need to work is, depending on the frequency, I will find all possible
   * occurrence of the rule. For instance, if this is a "monthly" rule, I'll find out which month
   * to start in, then find all occurrence possible. Then narrow down by the other rules I guess.
   * 
   * @idea Maybe I should build classes for each of the frequency types. That way I could loop over
   * the object and get methods like qCal_DateTime_Recur_Monthly::isNthDay('SU') to find out what sunday
   * of the month it is... stuff like that... I dunno... ?
   * 
   * @throws qCal_DateTime_Exception_InvalidRecur
   */
  public function getRecurrences($intervalStart, $intervalEnd)
  {

    if ($intervalStart > $intervalEnd)
      throw new qCal_DateTime_Exception_InvalidRecur('Start date must come before end date');
    if (!$this->interval)
      throw new qCal_DateTime_Exception_InvalidRecur('You must specify an interval');

    $startDate = $this->dtstart->getDate()->getUnixTimestamp(false);
    if ($intervalStart < $startDate)
    {
      $intervalStart = $startDate;
    }
    if ($this->until())
    {
      $endDate = $this->until()->getDate()->getUnixTimestamp(false);
      if ($endDate < $intervalEnd)
      {
        $intervalEnd = $endDate;
      }
    }

    if ($intervalStart > $intervalEnd)
    {
      return array();
    }


    $filters = array();

    switch ($this->freq)
    {
      case "DAILY":
        $filters['daily'] = new qCal_DateTime_Recur_Filter_Daily($startDate, $this->interval, $this->count);
        break;
      case "WEEKLY":
        $filters['weekly'] = new qCal_DateTime_Recur_Filter_Weekly($startDate, $this->interval, $this->count);
        break;
      case "MONTHLY":
        //@todo
        break;
      case "YEARLY":
        //@todo
        break;

      default:
        throw new qCal_DateTime_Exception_InvalidRecur("Invalid recur freq {$this->freq}");
    }

    if (isset($this->byday))
    {
      $filters['byday'] = new qCal_DateTime_Recur_Filter_ByDay($this->byday);
    }
    if (isset($this->bymonthday))
    {
      $filters['bymonthday'] = new qCal_DateTime_Recur_Filter_ByMonthDay($this->bymonthday);
    }
    if (isset($this->byyearday))
    {
      $filters['byyearday'] = new qCal_DateTime_Recur_Filter_ByYearDay($this->byyearday);
    }
    if (isset($this->byweekno))
    {
      $filters['byweekno'] = new qCal_DateTime_Recur_Filter_ByWeekNo($this->byweekno);
    }
    if (isset($this->bymonth))
    {
      $filters['bymonth'] = new qCal_DateTime_Recur_Filter_ByMonth($this->bymonth);
    }

    $ret = $this->doGetRecurrences($filters, $intervalStart, $intervalEnd);

    return $ret;
  }

  const DAY = 86400;

  /**
   * Each type of rule needs to determine its recurrences so this is left abstract
   * to be implemented by children.
   * @param array $filters
   * @param int $intervalStart UNIX timestamp
   * @param int $intervalEnd UNIX timestamp
   * @return array
   */
  protected function doGetRecurrences($filters, $intervalStart, $intervalEnd)
  {
    //round interval start to DAY
    $intervalStart = qCal_DateTime::factory($intervalStart)->getDate()->getUnixTimestamp(false);
    $recurrences = array();
    for ($currentDay = $intervalStart; $currentDay <= $intervalEnd; $currentDay += self::DAY)
    {
      foreach ($filters as $filter) /* @var $filter qCal_DateTime_Recur_Filter */
      {
        if (!$filter->isIn($currentDay))
        {
          continue 2;
        }
      }
      $recurrences[] = qCal_DateTime::factory($currentDay + $this->dtstart->getTime()->getTimestamp(false), $this->dtstart->getTime()->getTimezone());
    }
    return $recurrences;
  }

}