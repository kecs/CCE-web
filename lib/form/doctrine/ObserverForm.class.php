<?php

/**
 * Observer form.
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ObserverForm extends BaseObserverForm
{

  public function configure()
  {
    $this->widgetSchema['observants_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Home'));
    $this->validatorSchema['observants_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Home', 'required' => false));
  }

}
