<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addlocalitytype extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('locality_type', array(
             'id' => 
             array(
              'type' => 'integer',
              'primary' => true,
              'autoincrement' => true,
              'length' => 4,
             ),
             'description' => 
             array(
              'type' => 'string',
              'notnull' => true,
              'length' => 255,
             ),
             'leiras' => 
             array(
              'type' => 'string',
              'notnull' => true,
              'length' => 255,
             ),
             ), array(
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_general_ci',
             'charset' => 'utf8',
             ));
    }

    public function down()
    {
        $this->dropTable('locality_type');
    }
}