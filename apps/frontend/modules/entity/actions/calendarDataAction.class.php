<?php

class Entity_calendarDataAction extends cceActions
{

  /**
   *
   * @param sfWebRequest $request
   */
  public function execute($request)
  {
    //$timezone = $request->getParameter('timezone');
    $this->forward404Unless($day = $this->js2PhpTime($request->getParameter('showdate')));

    //suppose first day of a week is monday 
    $monday = date("d", $day) - date('N', $day) + 1;
    //echo date('N', $phpTime);
    $period = new TimePeriod(
                    mktime(0, 0, 0, date("m", $day), $monday, date("Y", $day)),
                    mktime(0, 0, -1, date("m", $day), $monday + 7, date("Y", $day))
    );

    return $this->renderJSON(array(
        'events' => $this->getEvents($this->getRoute()->getObject(), $period),
        'start' => $this->php2JsTime($period->from),
        'end' => $this->php2JsTime($period->to),
    ));
  }

  public function getEvents(Entity $entity, TimePeriod $period)
  {
    $icalEvents = CalendarTable::getEvents($entity, $period);
    $jsEvents = array();
    foreach ($icalEvents as $event)
    {
      $jsEvents[] = array(
          $event->getUID()->getValue(),
          $event->getSummary()->getValue(),
          $this->php2JsTime($event->getDtStart()->getValueObject()->getValue()->getUnixTimestamp(false)),
          $this->php2JsTime($event->getDtEnd()->getValueObject()->getValue()->getUnixTimestamp(false)),
          0, //$row->IsAllDayEvent,
          0, //more than one day event
          0, //Recurring event,
          1, //$row->Color,
          0, //editable
          $event->getLocation()->getValue(),
          ''//$attends
      );
    }
    return $jsEvents;
  }

  protected function js2PhpTime($jsdate)
  {
    if (preg_match('@(\d+)/(\d+)/(\d+)\s+(\d+):(\d+)@', $jsdate, $matches) == 1)
    {
      $ret = mktime($matches[4], $matches[5], 0, $matches[1], $matches[2], $matches[3]);
      //echo $matches[4] ."-". $matches[5] ."-". 0  ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
    }
    else if (preg_match('@(\d+)/(\d+)/(\d+)@', $jsdate, $matches) == 1)
    {
      $ret = mktime(0, 0, 0, $matches[1], $matches[2], $matches[3]);
      //echo 0 ."-". 0 ."-". 0 ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
    }
    return $ret;
  }

  protected function php2JsTime($phpDate)
  {
    //echo $phpDate;
    //return "/Date(" . $phpDate*1000 . ")/";
    return date("m/d/Y H:i", $phpDate);
  }

}