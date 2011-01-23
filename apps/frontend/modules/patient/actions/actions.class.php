<?php

/**
 * patient actions.
 *
 * @package    cce
 * @subpackage patient
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class patientActions extends cceActions
{

  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->patients = $this->getUser()->getGuardUser()->ObserverRole->Observants;
  }

}
