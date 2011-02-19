<?php

class PhysicalEnvironmentAction extends sfAction
{

  /**
   * @param sfWebRequest $request 
   */
  public function execute($request)
  {
    $this->localityTypes = LocalityTypeTable::getInstance()->findAll();
    return '';
  }

}