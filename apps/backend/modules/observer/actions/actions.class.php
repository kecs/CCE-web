<?php

require_once dirname(__FILE__) . '/../lib/observerGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/observerGeneratorHelper.class.php';

/**
 * observer actions.
 *
 * @package    cce
 * @subpackage observer
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class observerActions extends autoObserverActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect($this->generateUrl('user'));
  }

}
