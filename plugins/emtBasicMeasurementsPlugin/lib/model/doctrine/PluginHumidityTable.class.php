<?php

/**
 * PluginHumidityTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginHumidityTable extends ScalarTimedMeasurementTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object PluginHumidityTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginHumidity');
    }
}