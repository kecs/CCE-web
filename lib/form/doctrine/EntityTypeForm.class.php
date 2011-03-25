<?php

/**
 * EntityType form.
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EntityTypeForm extends BaseEntityTypeForm
{

  public function configure()
  {
    $this->embedI18n(array('en', 'hu'));
    $this->widgetSchema->setLabel('en', 'English');
    $this->widgetSchema->setLabel('hu', 'Hungarian');
  }

}
