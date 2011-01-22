<?php

/**
 * Motion form base class.
 *
 * @method Motion getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMotionForm extends MeasurementForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['timestamp'] = new sfWidgetFormInputText();
    $this->validatorSchema['timestamp'] = new sfValidatorInteger();

    $this->widgetSchema->setNameFormat('motion[%s]');
  }

  public function getModelName()
  {
    return 'Motion';
  }

}
