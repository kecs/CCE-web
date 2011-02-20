<?php

class HomeDescriptionAction extends sfAction
{

  /**
   * @param sfWebRequest $request 
   */
  public function execute($request)
  {
    $home = $this->getRoute()->getObject(); /* @var $home Home */
    $this->localities = $home->getLocalities();
    return '';
  }

}