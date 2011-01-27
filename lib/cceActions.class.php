<?php

class cceActions extends sfActions
{

  /**
   * Retrieves the current sfUser object.
   *
   * This is a proxy method equivalent to:
   *
   * <code>$this->getContext()->getUser()</code>
   *
   * @return myUser The current sfUser implementation instance
   */
  public function getUser()
  {
    return parent::getUser();
  }

  /**
   * @return Doctrine_Record
   */
  protected function getObject()
  {
    return $this->getRoute()->getObject();
  }

  protected function renderJSON($data)
  {
    $content = json_encode($data);

    if ($this->getRequest()->isXmlHttpRequest())
    {
      $this->getResponse()->setHttpHeader('Content-type', 'application/json');
    }
    return $this->renderText($content);
  }

}