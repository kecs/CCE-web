<?php

/**
 * BaseLocality
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property LocalityType $LocalityType
 * 
 * @method LocalityType getLocalityType() Returns the current record's "LocalityType" value
 * @method Locality     setLocalityType() Sets the current record's "LocalityType" value
 * 
 * @package    cce
 * @subpackage model
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLocality extends Entity
{
    public function setUp()
    {
        parent::setUp();
        $this->hasOne('LocalityType', array(
             'local' => 'locality_type_id',
             'foreign' => 'id'));
    }
}