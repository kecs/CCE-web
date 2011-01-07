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
      'comment'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'locality_type_id' => new sfWidgetFormFilterInput(),
      'locality_id'      => new sfWidgetFormFilterInput(),
      'locality2_id'     => new sfWidgetFormFilterInput(),
      'root_id'          => new sfWidgetFormFilterInput(),
      'lft'              => new sfWidgetFormFilterInput(),
      'rgt'              => new sfWidgetFormFilterInput(),
      'level'            => new sfWidgetFormFilterInput(),
      'observers_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Observer')),
    ));

    $this->setValidators(array(
      'comment'          => new sfValidatorPass(array('required' => false)),
      'type'             => new sfValidatorPass(array('required' => false)),
      'locality_type_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'locality_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'locality2_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'root_id'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lft'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rgt'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'level'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'observers_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Observer', 'required' => false)),
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

  public function getModelName()
  {
    return 'Entity';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'comment'          => 'Text',
      'type'             => 'Text',
      'locality_type_id' => 'Number',
      'locality_id'      => 'Number',
      'locality2_id'     => 'Number',
      'root_id'          => 'Number',
      'lft'              => 'Number',
      'rgt'              => 'Number',
      'level'            => 'Number',
      'observers_list'   => 'ManyKey',
    );
  }
}