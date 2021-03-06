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
        $this -> level = $data['data'];
        $this -> timestamp = $data['timestamp'];
        
        if($data['data'] === 'low'){
            $mailer = sfContext :: getInstance() -> getMailer();
            
            $containment = array();
            foreach(Doctrine_Core :: getTable('Entity') -> find($data['id']) -> getNode() -> getAncestors() as $anc){
                array_push($containment, "{$anc -> getName()}({$anc -> getType()}, {$anc -> getId()})");
            }
            
            $message = $mailer -> compose(
                array('emt@emt.bme.hu' => 'emt'),
                "kissn@emt.bme.hu",
                "tapfeszultseg jelzes",
                "A tapfeszultseg erteke a "
                    .implode(' / ', $containment)
                    ."azonositoju eszkozon alacsony. A csatorna azonositoja {$data['id']}."
            );
            
            $mailer -> send($message);
        }
    }
}
