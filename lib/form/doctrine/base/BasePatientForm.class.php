<?php

/**
 * Patient form base class.
 *
 * @method Patient getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePatientForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'social_security_number' => new sfWidgetFormInputText(),
      'born_at'                => new sfWidgetFormInputText(),
      'address'                => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'social_security_number' => new sfValidatorInteger(),
      'born_at'                => new sfValidatorString(array('max_length' => 255)),
      'address'                => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('patient[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Patient';
  }

}
