<?php

/**
 * BaseDataSource
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property Doctrine_Collection $AffectedBy
 * 
 * @method Doctrine_Collection getAffectedBy() Returns the current record's "AffectedBy" collection
 * @method DataSource          setAffectedBy() Sets the current record's "AffectedBy" collection
 * 
 * @package    cce
 * @subpackage model
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDataSource extends Entity
{
    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Entity as AffectedBy', array(
             'refClass' => 'DataSourceAffected',
             'local' => 'id',
             'foreign' => 'data_source_id'));
    }
}