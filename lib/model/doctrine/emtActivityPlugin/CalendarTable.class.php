<?php

/**
 * CalendarTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CalendarTable extends PluginCalendarTable
{

  public static function getEvents($entity, TimePeriod $period)
  {
    $calendar = self::getInstance()->createQuery('m')
            ->select('m.ical')
            ->andWhere('m.entity_id = ?', $entity->id)
            ->limit(1)
            ->fetchOne(); /* @var $calendar Calendar */

    $parser = new qCal_Parser();
    $iCal = $parser->parse($calendar->ical);
    $events = array();
    foreach ($iCal->getComponent('VEVENT') as $event) /* @var $event qCal_Component_Vevent */
    {
      if ($event->hasProperty('RRULE'))
      {
        //echo "{$event->render()}";
        $recurrenceSpecs = $event->getRecurrenceSpecs();
        foreach ($recurrenceSpecs as $recurrenceSpec) /* @var $recurrenceSpec qCal_DateTime_Recur */
        {
          $recurrences = $recurrenceSpec->getRecurrences($period->from, $period->to);
          

          foreach ($recurrences as $recurrence)
          {
            $events[] = $tmp = $event->getAtRecurrence($recurrence);
            //echo "--\n{$tmp->render()}\n--\n";
          }
        }
      }
      else
      {
        $eventPeriod = new TimePeriod(
                        $event->getDtStart()->getValueObject()->getValue()->getUnixTimestamp(false),
                        $event->getDtEnd()->getValueObject()->getValue()->getUnixTimestamp(false)
        );
        if ($period->isOverlappingWidth($eventPeriod))
        {
          $events[] = $event;
        }
        
      }
    }
    return $events;
  }

  /**
   * Returns an instance of this class.
   *
   * @return object CalendarTable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('Calendar');
  }

}