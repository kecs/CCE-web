<?php

/**
 * Measurement filter form base class.
 *
 * @package    cce
 * @subpackage filter
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMeasurementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'entity_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('About'), 'add_empty' => true)),
      'data_source_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Source'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'entity_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('About'), 'column' => 'id')),
      'data_source_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Source'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('measurement_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Measurement';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'entity_id'      => 'ForeignKey',
      'data_source_id' => 'ForeignKey',
    );
  }
}
