<?php

/**
 * Temperature
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    cce
 * @subpackage model
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Temperature extends PluginTemperature{
    protected function loadData($data){
        //sfContext :: getInstance() -> getLogger() -> info("[*] ".var_dump($data));
        $this -> value = $data['data'];
        $this -> timestamp = $data['timestamp'];
    }
}
