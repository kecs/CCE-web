<?php

class entityActions extends cceActions
{

  public function executeIndexRecursive(sfWebRequest $request)
  {
    $this->descendantEntities = $this->getObject()->getNode()->getDescendants(null, true);
  }

  /**
   * @return Entity
   */
  protected function getObject()
  {
    return parent::getObject();
  }

}