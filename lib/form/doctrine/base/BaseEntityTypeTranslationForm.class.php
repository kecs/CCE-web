<?php

/**
 * EntityTypeTranslation form base class.
 *
 * @method EntityTypeTranslation getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEntityTypeTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'className' => new sfWidgetFormInputHidden(),
      'name'      => new sfWidgetFormInputText(),
      'lang'      => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'className' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('className')), 'empty_value' => $this->getObject()->get('className'), 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 255)),
      'lang'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('entity_type_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EntityTypeTranslation';
  }

}
