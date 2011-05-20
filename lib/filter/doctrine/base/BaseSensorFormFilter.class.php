<?php

/**
 * Sensor filter form base class.
 *
 * @package    cce
 * @subpackage filter
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSensorFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'device_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Device'), 'add_empty' => true)),
      'endpoint_number' => new sfWidgetFormFilterInput(),
      'cluster_id'      => new sfWidgetFormFilterInput(),
      'hgw_id'          => new sfWidgetFormFilterInput(),
      'data_source_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DataSource'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'device_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Device'), 'column' => 'id')),
      'endpoint_number' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cluster_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hgw_id'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'data_source_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DataSource'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('sensor_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sensor';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'device_id'       => 'ForeignKey',
      'endpoint_number' => 'Number',
      'cluster_id'      => 'Number',
      'hgw_id'          => 'Number',
      'data_source_id'  => 'ForeignKey',
    );
  }
}
