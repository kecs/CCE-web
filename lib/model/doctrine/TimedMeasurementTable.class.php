<?php

/**
 * TimedMeasurementTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TimedMeasurementTable extends MeasurementTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object TimedMeasurementTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('TimedMeasurement');
    }
}