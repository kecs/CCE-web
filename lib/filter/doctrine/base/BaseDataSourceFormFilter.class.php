<?php

/**
 * DataSource filter form base class.
 *
 * @package    cce
 * @subpackage filter
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDataSourceFormFilter extends EntityFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['devices_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Device'));
    $this->validatorSchema['devices_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Device', 'required' => false));

    $this->widgetSchema->setNameFormat('data_source_filters[%s]');
  }

  public function addDevicesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('DataSourceRealization.device_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'DataSource';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'devices_list' => 'ManyKey',
    ));
  }
}
