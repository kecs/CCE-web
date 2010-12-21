<?php

/**
 * Activity form base class.
 *
 * @method Activity getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseActivityForm extends MeasurementForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['type'] = new sfWidgetFormInputText();
    $this->validatorSchema['type'] = new sfValidatorString(array('max_length' => 255));

    $this->widgetSchema   ['start_time'] = new sfWidgetFormInputText();
    $this->validatorSchema['start_time'] = new sfValidatorInteger();

    $this->widgetSchema   ['end_time'] = new sfWidgetFormInputText();
    $this->validatorSchema['end_time'] = new sfValidatorInteger();

    $this->widgetSchema->setNameFormat('activity[%s]');
  }

  public function getModelName()
  {
    return 'Activity';
  }

}
