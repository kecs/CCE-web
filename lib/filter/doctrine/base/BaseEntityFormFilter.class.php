<?php

/**
 * Entity filter form base class.
 *
 * @package    cce
 * @subpackage filter
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEntityFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'comment'                    => new sfWidgetFormFilterInput(),
      'type'                       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EntityType'), 'add_empty' => true)),
      'social_security_number'     => new sfWidgetFormFilterInput(),
      'born_at'                    => new sfWidgetFormFilterInput(),
      'address'                    => new sfWidgetFormFilterInput(),
      'locality_type_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LocalityType'), 'add_empty' => true)),
      'locality_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locality1'), 'add_empty' => true)),
      'locality2_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locality2'), 'add_empty' => true)),
      'root_id'                    => new sfWidgetFormFilterInput(),
      'lft'                        => new sfWidgetFormFilterInput(),
      'rgt'                        => new sfWidgetFormFilterInput(),
      'level'                      => new sfWidgetFormFilterInput(),
      'observers_list'             => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Observer')),
      'affected_data_sources_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DataSource')),
    ));

    $this->setValidators(array(
      'name'                       => new sfValidatorPass(array('required' => false)),
      'comment'                    => new sfValidatorPass(array('required' => false)),
      'type'                       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EntityType'), 'column' => 'className')),
      'social_security_number'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'born_at'                    => new sfValidatorPass(array('required' => false)),
      'address'                    => new sfValidatorPass(array('required' => false)),
      'locality_type_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LocalityType'), 'column' => 'id')),
      'locality_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Locality1'), 'column' => 'id')),
      'locality2_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Locality2'), 'column' => 'id')),
      'root_id'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lft'                        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rgt'                        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'level'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'observers_list'             => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Observer', 'required' => false)),
      'affected_data_sources_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DataSource', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('entity_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addObserversListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.Observation Observation')
      ->andWhereIn('Observation.observer_id', $values)
    ;
  }

  public function addAffectedDataSourcesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.DataSourceAffected DataSourceAffected')
      ->andWhereIn('DataSourceAffected.id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Entity';
  }

  public function getFields()
  {
    return array(
      'id'                         => 'Number',
      'name'                       => 'Text',
      'comment'                    => 'Text',
      'type'                       => 'ForeignKey',
      'social_security_number'     => 'Number',
      'born_at'                    => 'Text',
      'address'                    => 'Text',
      'locality_type_id'           => 'ForeignKey',
      'locality_id'                => 'ForeignKey',
      'locality2_id'               => 'ForeignKey',
      'root_id'                    => 'Number',
      'lft'                        => 'Number',
      'rgt'                        => 'Number',
      'level'                      => 'Number',
      'observers_list'             => 'ManyKey',
      'affected_data_sources_list' => 'ManyKey',
    );
  }
}
