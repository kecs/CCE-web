<?php

/**
 * DataSourceAffected form base class.
 *
 * @method DataSourceAffected getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDataSourceAffectedForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'data_source_id' => new sfWidgetFormInputHidden(),
      'entity_id'      => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'data_source_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('data_source_id')), 'empty_value' => $this->getObject()->get('data_source_id'), 'required' => false)),
      'entity_id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('entity_id')), 'empty_value' => $this->getObject()->get('entity_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('data_source_affected[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DataSourceAffected';
  }

}
