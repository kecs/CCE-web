<?php

class entityComponents extends sfComponents
{

  public function executeIndex()
  {
    $this->observants = $this->getUser()->getGuardUser()->ObserverRole->Observants;

    $currentObject = false;

    $route = $this->getRequest()->getAttribute('sf_route');
    $routeOptions = $route->getOptions();
    if ($route instanceof sfObjectRoute
            && $route->isBound()
            && $routeOptions['type'] === 'object')
    {
      $currentObject = $route->getObject();
    }

    if ($currentObject instanceof Entity)
    {
      $this->selectedEntityId = $currentObject->id;
    }
  }

}