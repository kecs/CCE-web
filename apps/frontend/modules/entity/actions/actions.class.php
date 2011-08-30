<?php

class entityActions extends cceActions
{

  public function executeIndex(sfWebRequest $request)
  {

  }

  public function executeIndexRecursive(sfWebRequest $request)
  {
    $this->descendantEntities = $this->getObject()->getNode()->getDescendants(null, true);
  }

  public function executeData(sfWebRequest $request)
  {
    $this->forward404Unless($channel = $request->getParameter('channelName'));
    $this->forward404Unless($channelTable = Doctrine::getTable($channel));
    $this->forward404Unless($channelTable instanceof MeasurementTable);
    $this->forward404Unless($from = $request->getParameter('from'));
    $this->forward404Unless($to = $request->getParameter('to'));

    $timePeriod = new TimePeriod($from, $to);
    $timePeriod->zoom(3); //return some context so we can have lines going off the chart

    return $this->renderJSON(
            $channelTable->getMeasurementsAbout($this->getObject(), $timePeriod));
  }

  public function executeJavascript(sfWebRequest $request)
  {
    $this->setTemplate('indexRecursive');
  }

  /**
   * @return Entity
   */
  protected function getObject()
  {
    return parent::getObject();
  }

}
