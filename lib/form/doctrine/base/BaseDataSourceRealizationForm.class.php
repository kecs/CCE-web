<?php

/**
 * DataSourceRealization form base class.
 *
 * @method DataSourceRealization getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDataSourceRealizationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'data_source_id' => new sfWidgetFormInputHidden(),
      'device_id'      => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'data_source_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('data_source_id')), 'empty_value' => $this->getObject()->get('data_source_id'), 'required' => false)),
      'device_id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('device_id')), 'empty_value' => $this->getObject()->get('device_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('data_source_realization[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DataSourceRealization';
  }

}
