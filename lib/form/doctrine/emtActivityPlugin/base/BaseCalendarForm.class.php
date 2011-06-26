<?php

/**
 * Calendar form base class.
 *
 * @method Calendar getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCalendarForm extends MeasurementForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['ical'] = new sfWidgetFormTextarea();
    $this->validatorSchema['ical'] = new sfValidatorString();

    $this->widgetSchema->setNameFormat('calendar[%s]');
  }

  public function getModelName()
  {
    return 'Calendar';
  }

}
