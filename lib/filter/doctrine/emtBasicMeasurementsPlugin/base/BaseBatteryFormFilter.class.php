<?php

/**
 * Battery filter form base class.
 *
 * @package    cce
 * @subpackage filter
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBatteryFormFilter extends MeasurementFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['timestamp'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['timestamp'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema   ['power_level'] = new sfWidgetFormChoice(array('choices' => array('' => '', 'low' => 'low', 'normal' => 'normal')));
    $this->validatorSchema['power_level'] = new sfValidatorChoice(array('required' => false, 'choices' => array('low' => 'low', 'normal' => 'normal')));

    $this->widgetSchema->setNameFormat('battery_filters[%s]');
  }

  public function getModelName()
  {
    return 'Battery';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'timestamp' => 'Number',
      'power_level' => 'Enum',
    ));
  }
}
