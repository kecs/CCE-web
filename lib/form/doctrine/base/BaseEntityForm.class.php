<?php

/**
 * Entity form base class.
 *
 * @method Entity getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEntityForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'comment'          => new sfWidgetFormInputText(),
      'type'             => new sfWidgetFormInputText(),
      'locality_type_id' => new sfWidgetFormInputText(),
      'locality_id'      => new sfWidgetFormInputText(),
      'locality2_id'     => new sfWidgetFormInputText(),
      'remark'           => new sfWidgetFormTextarea(),
      'root_id'          => new sfWidgetFormInputText(),
      'lft'              => new sfWidgetFormInputText(),
      'rgt'              => new sfWidgetFormInputText(),
      'level'            => new sfWidgetFormInputText(),
      'observers_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Observer')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'comment'          => new sfValidatorString(array('max_length' => 255)),
      'type'             => new sfValidatorString(array('max_length' => 255)),
      'locality_type_id' => new sfValidatorInteger(array('required' => false)),
      'locality_id'      => new sfValidatorInteger(array('required' => false)),
      'locality2_id'     => new sfValidatorInteger(array('required' => false)),
      'remark'           => new sfValidatorString(array('required' => false)),
      'root_id'          => new sfValidatorInteger(array('required' => false)),
      'lft'              => new sfValidatorInteger(array('required' => false)),
      'rgt'              => new sfValidatorInteger(array('required' => false)),
      'level'            => new sfValidatorInteger(array('required' => false)),
      'observers_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Observer', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('entity[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Entity';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['observers_list']))
    {
      $this->setDefault('observers_list', $this->object->Observers->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveObserversList($con);

    parent::doSave($con);
  }

  public function saveObserversList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['observers_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Observers->getPrimaryKeys();
    $values = $this->getValue('observers_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Observers', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Observers', array_values($link));
    }
  }

}
