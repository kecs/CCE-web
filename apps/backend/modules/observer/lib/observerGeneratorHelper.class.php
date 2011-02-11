<?php

/**
 * observer module helper.
 *
 * @package    cce
 * @subpackage observer
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class observerGeneratorHelper extends BaseObserverGeneratorHelper
{

  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'user' : parent::getUrlForAction($action);
  }

}
