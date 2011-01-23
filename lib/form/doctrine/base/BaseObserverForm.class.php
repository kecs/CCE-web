<?php

/**
 * Observer form base class.
 *
 * @method Observer getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseObserverForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'observants_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Entity')),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'observants_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Entity', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('observer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Observer';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['observants_list']))
    {
      $this->setDefault('observants_list', $this->object->Observants->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveObservantsList($con);

    parent::doSave($con);
  }

  public function saveObservantsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['observants_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Observants->getPrimaryKeys();
    $values = $this->getValue('observants_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Observants', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Observants', array_values($link));
    }
  }

}
