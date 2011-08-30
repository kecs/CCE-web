<?php

/**
 * Temperature form base class.
 *
 * @method Temperature getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTemperatureForm extends MeasurementForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['timestamp'] = new sfWidgetFormInputText();
    $this->validatorSchema['timestamp'] = new sfValidatorInteger();

    $this->widgetSchema   ['value'] = new sfWidgetFormInputText();
    $this->validatorSchema['value'] = new sfValidatorNumber();

    $this->widgetSchema->setNameFormat('temperature[%s]');
  }

  public function getModelName()
  {
    return 'Temperature';
  }

}
