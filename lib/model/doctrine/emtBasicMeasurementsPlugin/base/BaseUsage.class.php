<?php

/**
 * BaseUsage
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * 
 * @package    cce
 * @subpackage model
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUsage extends EmptyTimedMeasurement
{
    public function setTableDefinition()
    {
        parent::setTableDefinition();
        $this->setTableName('usage');
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}