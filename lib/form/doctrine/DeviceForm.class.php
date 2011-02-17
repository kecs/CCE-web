<?php

/**
 * Device form.
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DeviceForm extends BaseDeviceForm
{

  public function configure()
  {
    $this->setWidget('data_source_id', new sfWidgetFormDoctrineChoice(array('model' => 'DataSource', 'add_empty' => true)));
    $this->setValidator('data_source_id', new sfValidatorDoctrineChoice(array('model' => 'DataSource', 'required' => false)));
  }

}
