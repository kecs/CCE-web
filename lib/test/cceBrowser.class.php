<?php

class cceBrowser extends sfBrowser
{
  private $headersBackup;
  
  public function call($uri, $method = 'get', $parameters = array(), $changeStack = true)
  {
    $this->headersBackup = $this->headers;
    return parent::call($uri, $method, $parameters, $changeStack);
  }

  protected function doCall()
  {
    foreach ($this->headersBackup as $header => $value)
    {
      $header = strtoupper(str_replace('-', '_', $header));
      if ('CONTENT_TYPE' == $header)
      {
        $_SERVER[$header] = $value;
      }
    }
    parent::doCall();
  }

}