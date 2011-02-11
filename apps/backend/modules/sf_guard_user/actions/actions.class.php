<?php

require_once dirname(__FILE__) . '/../lib/sf_guard_userGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/sf_guard_userGeneratorHelper.class.php';

/**
 * sf_guard_user actions.
 *
 * @package    cce
 * @subpackage sf_guard_user
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sf_guard_userActions extends autoSf_guard_userActions
{

  public function executeCreateObserverRole(sfWebRequest $request)
  {
    $user = $this->getRoute()->getObject(); /* @var $user sfGuardUser */

    $user->ObserverRole->save(); //insert if doesn't exist

    $id = $user->ObserverRole->id;
    $user->observer_id = $id;
    $user->save();

    $this->getUser()->setFlash('notice', 'Observer created.');

    $this->redirect($this->generateUrl('observer_edit', array('id' => $id)));
  }

  public function executeCreatePatientRole(sfWebRequest $request)
  {
    $user = $this->getRoute()->getObject(); /* @var $user sfGuardUser */

    $patient = new Patient();
    $patient->save();

    $user->PatientRole = $patient;
    $user->save();

    $this->getUser()->setFlash('notice', 'Patient created. Please attach it to a Home!');

    $this->redirect($this->generateUrl('patient_edit', array('id' => $patient->id)));
  }

}
