<?php

/**
 * Calendar filter form base class.
 *
 * @package    cce
 * @subpackage filter
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCalendarFormFilter extends MeasurementFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['ical'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['ical'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema->setNameFormat('calendar_filters[%s]');
  }

  public function getModelName()
  {
    return 'Calendar';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'ical' => 'Text',
    ));
  }
}
