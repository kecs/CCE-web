<?php

/**
 * EKGTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class EKGTable extends PluginEKGTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object EKGTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('EKG');
    }
}