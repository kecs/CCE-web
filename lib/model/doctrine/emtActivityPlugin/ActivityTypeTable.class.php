<?php

/**
 * ActivityTypeTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ActivityTypeTable extends PluginActivityTypeTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object ActivityTypeTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ActivityType');
    }
}