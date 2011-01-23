<?php

/**
 * Measurement form base class.
 *
 * @method Measurement getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMeasurementForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'entity_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('About'), 'add_empty' => false)),
      'data_source_id' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'entity_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('About'))),
      'data_source_id' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('measurement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Measurement';
  }

}
