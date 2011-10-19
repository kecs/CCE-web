<?php

/**
 * PluginBattery
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginBattery extends BaseBattery{
    protected function loadData($data){
        $this -> level = $data['data']; // a korabbiak szerint, pl: data:"normal"
        $this -> timestamp = $data['timestamp'];
        
        $mailer = sfContext::getInstance()->getMailer();
        
        $message = $mailer -> compose(
            array('emt@emt.bme.hu' => 'emt'),
            "kissn@emt.bme.hu",
            "tapfeszultseg jelzes",
            "A tapfeszultseg erteke a {$data['id']} azonositoju eszkozon {$data['data']}."
        );
        
        //echo("self::getNode ".(property_exists(self, 'getNode')));
        $mailer -> send($message);
    }
}
