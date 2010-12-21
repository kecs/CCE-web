<?php

class cceWebRequest extends sfWebRequest
{

  /**
   * Returns the content of the current request.
   *
   * @return string|Boolean The content or false if none is available
   */
  public function getContent()
  {
    if (null === $this->content)
    {

      if ('test' == sfContext::getInstance()->getConfiguration()->getEnvironment())
      {
        $this->content = sfContext::getInstance()->getRequest()->getParameter('content');
      }
      else
      {
        $this->content = file_get_contents('php://input');
      }

      if (0 === strlen(trim($this->content)))
      {
        $this->content = false;
      }
    }

    return $this->content;
  }

}