<?php

/**
 * OpenCloseTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class OpenCloseTable extends PluginOpenCloseTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object OpenCloseTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('OpenClose');
    }
}