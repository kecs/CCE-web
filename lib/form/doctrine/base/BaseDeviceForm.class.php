<?php

/**
 * Device form base class.
 *
 * @method Device getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDeviceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'guid'           => new sfWidgetFormInputText(),
      'data_source_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DataSource'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'guid'           => new sfValidatorString(array('max_length' => 255)),
      'data_source_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DataSource'), 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Device', 'column' => array('guid')))
    );

    $this->widgetSchema->setNameFormat('device[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Device';
  }

}
