<?php

/**
 * OpenClosed form base class.
 *
 * @method OpenClosed getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOpenClosedForm extends MeasurementForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['timestamp'] = new sfWidgetFormInputText();
    $this->validatorSchema['timestamp'] = new sfValidatorInteger();

    $this->widgetSchema   ['value'] = new sfWidgetFormChoice(array('choices' => array('open' => 'open', 'closed' => 'closed')));
    $this->validatorSchema['value'] = new sfValidatorChoice(array('choices' => array(0 => 'open', 1 => 'closed')));

    $this->widgetSchema->setNameFormat('open_closed[%s]');
  }

  public function getModelName()
  {
    return 'OpenClosed';
  }

}
