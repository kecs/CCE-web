<?php

/**
 * Observer filter form base class.
 *
 * @package    cce
 * @subpackage filter
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseObserverFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'observants_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Entity')),
    ));

    $this->setValidators(array(
      'observants_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Entity', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('observer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addObservantsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('Observation.entity_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Observer';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'observants_list' => 'ManyKey',
    );
  }
}
