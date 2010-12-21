<?php

/**
 * EKG form base class.
 *
 * @method EKG getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEKGForm extends MeasurementForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['timestamp'] = new sfWidgetFormInputText();
    $this->validatorSchema['timestamp'] = new sfValidatorInteger();

    $this->widgetSchema   ['started_by'] = new sfWidgetFormInputText();
    $this->validatorSchema['started_by'] = new sfValidatorString(array('max_length' => 10));

    $this->widgetSchema   ['heart_rate'] = new sfWidgetFormInputText();
    $this->validatorSchema['heart_rate'] = new sfValidatorInteger();

    $this->widgetSchema   ['st_segment_elevation_ch1'] = new sfWidgetFormInputText();
    $this->validatorSchema['st_segment_elevation_ch1'] = new sfValidatorNumber();

    $this->widgetSchema   ['st_segment_elevation_ch2'] = new sfWidgetFormInputText();
    $this->validatorSchema['st_segment_elevation_ch2'] = new sfValidatorNumber();

    $this->widgetSchema   ['commonparams'] = new sfWidgetFormInputText();
    $this->validatorSchema['commonparams'] = new sfValidatorPass();

    $this->widgetSchema   ['channelparams'] = new sfWidgetFormInputText();
    $this->validatorSchema['channelparams'] = new sfValidatorPass();

    $this->widgetSchema   ['averages'] = new sfWidgetFormInputText();
    $this->validatorSchema['averages'] = new sfValidatorPass();

    $this->widgetSchema->setNameFormat('ekg[%s]');
  }

  public function getModelName()
  {
    return 'EKG';
  }

}
