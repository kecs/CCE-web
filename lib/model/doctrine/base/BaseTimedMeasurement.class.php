<?php

/**
 * BaseTimedMeasurement
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $timestamp
 * 
 * @method integer          getTimestamp() Returns the current record's "timestamp" value
 * @method TimedMeasurement setTimestamp() Sets the current record's "timestamp" value
 * 
 * @package    cce
 * @subpackage model
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTimedMeasurement extends Measurement
{
    public function setTableDefinition()
    {
        parent::setTableDefinition();
        $this->setTableName('timed_measurement');
        $this->hasColumn('timestamp', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));


        $this->index('timestamp', array(
             'fields' => 
             array(
              0 => 'timestamp',
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}