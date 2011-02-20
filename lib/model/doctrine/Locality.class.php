<?php

/**
 * Locality
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    cce
 * @subpackage model
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Locality extends BaseLocality
{

  public function isConnectedTo(Locality $otherLocality)
  {
    return DoorTable::getInstance()->createQuery('door')
            ->andWhere('((door.locality_id = :locality1_id AND door.locality2_id = :locality2_id) OR '
                    . '  (door.locality_id = :locality2_id AND door.locality2_id = :locality1_id)) ',
                    array(':locality1_id' => $this->id, ':locality2_id' => $otherLocality->id))
            ->count();
  }

  public function getWindowCount()
  {
    $q = WindowTable::getInstance()->createQuery('window');
    $tree = EntityTable::getInstance()->getTree(); /* @var $tree Doctrine_Tree_NestedSet */
    $tree->setBaseQuery($q);
    $windows = $tree->fetchBranch($this->id, array());
    $tree->resetBaseQuery();
    return count($windows);
  }

}
