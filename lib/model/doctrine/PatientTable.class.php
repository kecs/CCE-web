<?php

/**
 * PatientTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PatientTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PatientTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Patient');
    }
}