<?php

/**
 * Observation form base class.
 *
 * @method Observation getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseObservationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'observer_id' => new sfWidgetFormInputHidden(),
      'entity_id'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'observer_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('observer_id')), 'empty_value' => $this->getObject()->get('observer_id'), 'required' => false)),
      'entity_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('entity_id')), 'empty_value' => $this->getObject()->get('entity_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('observation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Observation';
  }

}
