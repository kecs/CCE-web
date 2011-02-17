<?php

/**
 * Device filter form base class.
 *
 * @package    cce
 * @subpackage filter
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDeviceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'guid'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'data_source_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DataSource'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'guid'           => new sfValidatorPass(array('required' => false)),
      'data_source_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DataSource'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('device_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Device';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'guid'           => 'Text',
      'data_source_id' => 'ForeignKey',
    );
  }
}
