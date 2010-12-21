<?php

/**
 * Activity filter form base class.
 *
 * @package    cce
 * @subpackage filter
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseActivityFormFilter extends MeasurementFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['type'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['type'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['start_time'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['start_time'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema   ['end_time'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['end_time'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema->setNameFormat('activity_filters[%s]');
  }

  public function getModelName()
  {
    return 'Activity';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'type' => 'Text',
      'start_time' => 'Number',
      'end_time' => 'Number',
    ));
  }
}
