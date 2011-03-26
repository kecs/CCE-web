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
      'id'                         => new sfWidgetFormInputHidden(),
      'name'                       => new sfWidgetFormInputText(),
      'comment'                    => new sfWidgetFormTextarea(),
      'type'                       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EntityType'), 'add_empty' => true)),
      'social_security_number'     => new sfWidgetFormInputText(),
      'born_at'                    => new sfWidgetFormInputText(),
      'address'                    => new sfWidgetFormInputText(),
      'locality_type_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LocalityType'), 'add_empty' => true)),
      'locality_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locality1'), 'add_empty' => true)),
      'locality2_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Locality2'), 'add_empty' => true)),
      'root_id'                    => new sfWidgetFormInputText(),
      'lft'                        => new sfWidgetFormInputText(),
      'rgt'                        => new sfWidgetFormInputText(),
      'level'                      => new sfWidgetFormInputText(),
      'observers_list'             => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Observer')),
      'affected_data_sources_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'DataSource')),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                       => new sfValidatorString(array('max_length' => 255)),
      'comment'                    => new sfValidatorString(array('required' => false)),
      'type'                       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EntityType'), 'required' => false)),
      'social_security_number'     => new sfValidatorInteger(array('required' => false)),
      'born_at'                    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address'                    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'locality_type_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LocalityType'), 'required' => false)),
      'locality_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Locality1'), 'required' => false)),
      'locality2_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Locality2'), 'required' => false)),
      'root_id'                    => new sfValidatorInteger(array('required' => false)),
      'lft'                        => new sfValidatorInteger(array('required' => false)),
      'rgt'                        => new sfValidatorInteger(array('required' => false)),
      'level'                      => new sfValidatorInteger(array('required' => false)),
      'observers_list'             => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Observer', 'required' => false)),
      'affected_data_sources_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'DataSource', 'required' => false)),
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

    if (isset($this->widgetSchema['affected_data_sources_list']))
    {
      $this->setDefault('affected_data_sources_list', $this->object->AffectedDataSources->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveObserversList($con);
    $this->saveAffectedDataSourcesList($con);

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

  public function saveAffectedDataSourcesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['affected_data_sources_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->AffectedDataSources->getPrimaryKeys();
    $values = $this->getValue('affected_data_sources_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('AffectedDataSources', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('AffectedDataSources', array_values($link));
    }
  }

}
