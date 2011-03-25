<?php

/**
 * Fridge form base class.
 *
 * @method Fridge getObject() Returns the current form's model object
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFridgeForm extends EntityForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('fridge[%s]');
  }

  public function getModelName()
  {
    return 'Fridge';
  }

}
