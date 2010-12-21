<?php

/**
 * Activity
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    cce
 * @subpackage model
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Activity extends PluginActivity
{
  protected function loadData(sfWebRequest $request)
  {
    $body = $request->getRawBody();
    $xml = simplexml_load_string($body); /* @var $xml SimpleXMLElement */
    $this->type = $xml->type;
    $this->start_time = $xml->start;
    $this->end_time = $xml->end;
  }

}
