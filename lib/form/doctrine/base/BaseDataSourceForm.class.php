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

    $this->widgetSchema->setNameFormat('data_source[%s]');
  }

  public function getModelName()
  {
    return 'DataSource';
  }

}
