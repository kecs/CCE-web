<?php

class SensorDescriptionAction extends sfAction
{

  /**
   * @param sfWebRequest $request 
   */
  public function execute($request)
  {
    $home = $this->getRoute()->getObject(); /* @var $home Home */
    $this->dataSources = $home->getDataSources();
    return '';
  }

}