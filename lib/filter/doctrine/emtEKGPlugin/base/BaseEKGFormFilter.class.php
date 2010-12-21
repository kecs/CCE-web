<?php

/**
 * EKG filter form base class.
 *
 * @package    cce
 * @subpackage filter
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEKGFormFilter extends MeasurementFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['timestamp'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['timestamp'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema   ['started_by'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['started_by'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['heart_rate'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['heart_rate'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema   ['st_segment_elevation_ch1'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['st_segment_elevation_ch1'] = new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false)));

    $this->widgetSchema   ['st_segment_elevation_ch2'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['st_segment_elevation_ch2'] = new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false)));

    $this->widgetSchema   ['commonparams'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['commonparams'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['channelparams'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['channelparams'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['averages'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['averages'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema->setNameFormat('ekg_filters[%s]');
  }

  public function getModelName()
  {
    return 'EKG';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'timestamp' => 'Number',
      'started_by' => 'Text',
      'heart_rate' => 'Number',
      'st_segment_elevation_ch1' => 'Number',
      'st_segment_elevation_ch2' => 'Number',
      'commonparams' => 'Text',
      'channelparams' => 'Text',
      'averages' => 'Text',
    ));
  }
}
