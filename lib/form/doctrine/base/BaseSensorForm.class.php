<?php

/**
 * Sensor form base class.
 *
 * @method Sensor getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSensorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'device_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Device'), 'add_empty' => false)),
      'endpoint_number' => new sfWidgetFormInputText(),
      'cluster_id'      => new sfWidgetFormInputText(),
      'hgw_id'          => new sfWidgetFormInputText(),
      'data_source_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DataSource'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'device_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Device'))),
      'endpoint_number' => new sfValidatorInteger(array('required' => false)),
      'cluster_id'      => new sfValidatorInteger(array('required' => false)),
      'hgw_id'          => new sfValidatorInteger(array('required' => false)),
      'data_source_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DataSource'), 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Sensor', 'column' => array('device_id', 'endpoint_number', 'cluster_id')))
    );

    $this->widgetSchema->setNameFormat('sensor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sensor';
  }

}
