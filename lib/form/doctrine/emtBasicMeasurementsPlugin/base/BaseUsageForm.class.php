<?php

/**
 * Usage form base class.
 *
 * @method Usage getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsageForm extends MeasurementForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['timestamp'] = new sfWidgetFormInputText();
    $this->validatorSchema['timestamp'] = new sfValidatorInteger();

    $this->widgetSchema->setNameFormat('usage[%s]');
  }

  public function getModelName()
  {
    return 'Usage';
  }

}
