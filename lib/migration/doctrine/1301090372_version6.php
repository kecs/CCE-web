<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version6 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('entity_type', array(
             'id' => 
             array(
              'type' => 'integer',
              'primary' => '1',
              'autoincrement' => '1',
              'length' => '8',
             ),
             'classname' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '255',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_general_ci',
             'charset' => 'utf8',
             ));
        $this->createTable('entity_type_translation', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'primary' => '1',
             ),
             'name' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '255',
             ),
             'lang' => 
             array(
              'fixed' => '1',
              'primary' => '1',
              'type' => 'string',
              'length' => '2',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
              1 => 'lang',
             ),
             'collate' => 'utf8_general_ci',
             'charset' => 'utf8',
             ));
    }

    public function down()
    {
        $this->dropTable('entity_type');
        $this->dropTable('entity_type_translation');
    }
}