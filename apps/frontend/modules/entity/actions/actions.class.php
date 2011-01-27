<?php

class entityActions extends cceActions
{

  public function executeIndexRecursive(sfWebRequest $request)
  {
    $this->descendantEntities = $this->getObject()->getNode()->getDescendants(null, true);
  }

  public function executeData(sfWebRequest $request)
  {
    $this->forward404Unless($channel = $request->getParameter('channel'));
    $this->forward404Unless($channelTable = Doctrine::getTable($channel));
    $this->forward404Unless($channelTable instanceof MeasurementTable);
    $this->forward404Unless($from = $request->getParameter('from'));
    $this->forward404Unless($to = $request->getParameter('to'));

    return $this->renderJSON(
            $channelTable->getMeasurementsAbout($this->getObject(), new TimePeriod($from, $to)));
  }

  public function executeDynamicJavascript(sfWebRequest $request)
  {

  }

  /**
   * @return Entity
   */
  protected function getObject()
  {
    return parent::getObject();
  }

}