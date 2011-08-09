<?php

class Entity_calendarRefreshAction extends cceActions
{

  /**
   *
   * @param sfWebRequest $request
   */
  public function execute($request)
  {
    $patient = $this->getRoute()->getObject();

    $url = $patient->calendar_url;
    $ical = file_get_contents($url);
    $calendar = CalendarTable::getByEntity($patient);
    $calendar->ical = $ical;
    $calendar->save();
    return $this->renderText('');
  }
}