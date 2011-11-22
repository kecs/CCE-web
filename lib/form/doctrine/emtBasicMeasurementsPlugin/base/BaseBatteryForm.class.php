<?php

/**
 * Battery form base class.
 *
 * @method Battery getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBatteryForm extends MeasurementForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['timestamp'] = new sfWidgetFormInputText();
    $this->validatorSchema['timestamp'] = new sfValidatorInteger();

    $this->widgetSchema   ['level'] = new sfWidgetFormChoice(array('choices' => array('low' => 'low', 'normal' => 'normal')));
    $this->validatorSchema['level'] = new sfValidatorChoice(array('choices' => array(0 => 'low', 1 => 'normal')));

    $this->widgetSchema->setNameFormat('battery[%s]');
  }

  public function getModelName()
  {
    return 'Battery';
  }

}
