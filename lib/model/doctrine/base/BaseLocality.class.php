<?php

/**
 * BaseLocality
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property LocalityType $LocalityType
 * @property Doctrine_Collection $Window
 * @property Doctrine_Collection $Door
 * 
 * @method LocalityType        getLocalityType() Returns the current record's "LocalityType" value
 * @method Doctrine_Collection getWindow()       Returns the current record's "Window" collection
 * @method Doctrine_Collection getDoor()         Returns the current record's "Door" collection
 * @method Locality            setLocalityType() Sets the current record's "LocalityType" value
 * @method Locality            setWindow()       Sets the current record's "Window" collection
 * @method Locality            setDoor()         Sets the current record's "Door" collection
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

        $this->hasMany('Window', array(
             'local' => 'id',
             'foreign' => 'locality_id'));

        $this->hasMany('Door', array(
             'local' => 'id',
             'foreign' => 'locality2_id'));
    }
}