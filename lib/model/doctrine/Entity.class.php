<?php

/**
 * Entity
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    cce
 * @subpackage model
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Entity extends BaseEntity
{

  public function __toString()
  {
    return "{$this->type} ({$this->id})";
  }

  /**
   * getter for node associated with this record
   *
   * @return Doctrine_Node_NestedSet
   */
  public function getNode()
  {
    return parent::getNode();
  }

}
