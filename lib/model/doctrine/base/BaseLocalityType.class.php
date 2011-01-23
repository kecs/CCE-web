<?php

/**
 * BaseLocalityType
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $description
 * @property string $leiras
 * @property Doctrine_Collection $Locality
 * 
 * @method integer             getId()          Returns the current record's "id" value
 * @method string              getDescription() Returns the current record's "description" value
 * @method string              getLeiras()      Returns the current record's "leiras" value
 * @method Doctrine_Collection getLocality()    Returns the current record's "Locality" collection
 * @method LocalityType        setId()          Sets the current record's "id" value
 * @method LocalityType        setDescription() Sets the current record's "description" value
 * @method LocalityType        setLeiras()      Sets the current record's "leiras" value
 * @method LocalityType        setLocality()    Sets the current record's "Locality" collection
 * 
 * @package    cce
 * @subpackage model
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLocalityType extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('locality_type');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('description', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('leiras', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Locality', array(
             'local' => 'id',
             'foreign' => 'locality_type_id'));
    }
}