<?php

/**
 * Activation filter form base class.
 *
 * @package    cce
 * @subpackage filter
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseActivationFormFilter extends MeasurementFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['timestamp'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['timestamp'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema->setNameFormat('activation_filters[%s]');
  }

  public function getModelName()
  {
    return 'Activation';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'timestamp' => 'Number',
    ));
  }
}
