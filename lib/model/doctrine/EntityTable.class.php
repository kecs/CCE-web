<?php

/**
 * EntityTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class EntityTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object EntityTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Entity');
    }
}