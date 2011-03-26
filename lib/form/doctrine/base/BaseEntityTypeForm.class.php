<?php

/**
 * EntityType form base class.
 *
 * @method EntityType getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEntityTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'className' => new sfWidgetFormInputHidden(),
      'id'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'className' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('className')), 'empty_value' => $this->getObject()->get('className'), 'required' => false)),
      'id'        => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'EntityType', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('entity_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EntityType';
  }

}
