<?php

class DataSource_createMeasurementAction extends sfAction
{

  /**
   * @param sfWebRequest $request 
   */
  public function execute($request)
  {
    $this->forward404Unless($dataSource = $this->getRoute()->getObject());
    $channel = $request->getParameter('channel');

    $typeReflectionClass = new ReflectionClass($channel);
    if ($typeReflectionClass->isSubclassOf('Measurement'))
    {
      $measurement = new $channel($dataSource, $request);
      $measurement->save();
      return $this->renderText('OK');
    }
    else
    {
      throw new UnknownChannelException($channel);
    }
  }

}