<?php

/**
 * Cupboard filter form base class.
 *
 * @package    cce
 * @subpackage filter
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCupboardFormFilter extends EntityFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('cupboard_filters[%s]');
  }

  public function getModelName()
  {
    return 'Cupboard';
  }
}
