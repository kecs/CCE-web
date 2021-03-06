<?php

/**
 * Patient form.
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PatientForm extends BasePatientForm
{

  /**
   * @see EntityForm
   */
  public function configure()
  {
    $this->useFields(array(
        'comment',
        'parent',
        'social_security_number',
        'born_at',
        'address',
        'calendar_url',
    ));

    $this->setValidator('calendar_url', new sfValidatorUrl(array('max_length' => 255)));
  }

}
