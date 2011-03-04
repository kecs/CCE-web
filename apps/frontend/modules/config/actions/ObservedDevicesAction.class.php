<?php

class ObservedDevicesAction extends sfAction
{

  /**
   * @param sfWebRequest $request 
   */
  public function execute($request)
  {
    $subClassNames = EntityTable::getInstance()->getOption('subclasses');
    $subClasses = array(
        EntityTable::getInstance()
    );

    foreach ($subClassNames as $name)
    {
      $subClasses[] = Doctrine::getTable($name);
    }
    
    $this->entityTables = $subClasses;
    return '';
  }

}