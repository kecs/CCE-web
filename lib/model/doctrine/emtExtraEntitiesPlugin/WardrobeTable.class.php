<?php

/**
 * WardrobeTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class WardrobeTable extends PluginWardrobeTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object WardrobeTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Wardrobe');
    }
}