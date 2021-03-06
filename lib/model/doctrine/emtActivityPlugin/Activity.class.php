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
  /**
   * @param SimpleXMLElement $data 
   */
  protected function loadData($data)
  {
    $this->type = $data->type;
    $this->start_time = $data->start;
    $this->end_time = $data->end;
  }

}
