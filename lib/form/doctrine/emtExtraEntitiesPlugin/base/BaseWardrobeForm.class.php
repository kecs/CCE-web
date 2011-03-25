<?php

/**
 * Wardrobe form base class.
 *
 * @method Wardrobe getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWardrobeForm extends EntityForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('wardrobe[%s]');
  }

  public function getModelName()
  {
    return 'Wardrobe';
  }

}
