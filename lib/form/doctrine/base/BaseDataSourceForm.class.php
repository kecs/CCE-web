<?php

/**
 * DataSource form base class.
 *
 * @method DataSource getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDataSourceForm extends EntityForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['devices_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Device'));
    $this->validatorSchema['devices_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Device', 'required' => false));

    $this->widgetSchema->setNameFormat('data_source[%s]');
  }

  public function getModelName()
  {
    return 'DataSource';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['devices_list']))
    {
      $this->setDefault('devices_list', $this->object->Devices->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveDevicesList($con);

    parent::doSave($con);
  }

  public function saveDevicesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['devices_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Devices->getPrimaryKeys();
    $values = $this->getValue('devices_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Devices', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Devices', array_values($link));
    }
  }

}
