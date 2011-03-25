<?php

/**
 * BaseDoor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property Entity $Locality1
 * @property Entity $Locality2
 * 
 * @method Entity getLocality1() Returns the current record's "Locality1" value
 * @method Entity getLocality2() Returns the current record's "Locality2" value
 * @method Door   setLocality1() Sets the current record's "Locality1" value
 * @method Door   setLocality2() Sets the current record's "Locality2" value
 * 
 * @package    cce
 * @subpackage model
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
abstract class BaseDoor extends Entity
{
    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Entity as Locality1', array(
             'local' => 'locality_id',
             'foreign' => 'id'));

        $this->hasOne('Entity as Locality2', array(
             'local' => 'locality2_id',
             'foreign' => 'id'));
    }
}