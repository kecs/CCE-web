<?php

class SensorIDsAndInterfacesAction extends sfAction
{

  /**
   * @param sfWebRequest $request 
   */
  public function execute($request)
  {
    $home = $this->getRoute()->getObject(); /* @var $home Home */
    $this->devices = DeviceTable::getInstance()->createQuery('device')
                    ->leftJoin('device.DataSource ds')
                    ->andWhere("ds.lft >= ? AND ds.rgt <= ?", array($home->lft, $home->rgt))
                    ->execute();
    return '';
  }

}