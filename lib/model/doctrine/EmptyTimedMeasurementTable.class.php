<?php

/**
 * EmptyTimedMeasurementTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class EmptyTimedMeasurementTable extends TimedMeasurementTable
{
    /**
     * Returns an instance of this class.
     *
     * @return EmptyTimedMeasurementTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('EmptyTimedMeasurement');
    }
}