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

    $this->widgetSchema   ['affected_by_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Entity'));
    $this->validatorSchema['affected_by_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Entity', 'required' => false));

    $this->widgetSchema->setNameFormat('data_source[%s]');
  }

  public function getModelName()
  {
    return 'DataSource';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['affected_by_list']))
    {
      $this->setDefault('affected_by_list', $this->object->AffectedBy->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveAffectedByList($con);

    parent::doSave($con);
  }

  public function saveAffectedByList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['affected_by_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->AffectedBy->getPrimaryKeys();
    $values = $this->getValue('affected_by_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('AffectedBy', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('AffectedBy', array_values($link));
    }
  }

}
