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
      'guid'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'data_source_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DataSource')),
    ));

    $this->setValidators(array(
      'guid'             => new sfValidatorPass(array('required' => false)),
      'data_source_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DataSource', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('device_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addDataSourceListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.DataSourceRealization DataSourceRealization')
      ->andWhereIn('DataSourceRealization.data_source_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Device';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'guid'             => 'Text',
      'data_source_list' => 'ManyKey',
    );
  }
}
