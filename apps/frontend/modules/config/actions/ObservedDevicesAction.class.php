<?php

class ObservedDevicesAction extends sfAction
{

  /**
   * @param sfWebRequest $request 
   */
  public function execute($request)
  {
    $this->entityTypes = EntityTypeTable::getInstance()->findAll();
    return '';
  }

}