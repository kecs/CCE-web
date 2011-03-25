<?php

/**
 * Cupboard form base class.
 *
 * @method Cupboard getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCupboardForm extends EntityForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('cupboard[%s]');
  }

  public function getModelName()
  {
    return 'Cupboard';
  }

}
