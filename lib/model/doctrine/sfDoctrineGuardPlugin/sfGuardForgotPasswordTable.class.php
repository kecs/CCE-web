<?php

/**
 * sfGuardForgotPasswordTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class sfGuardForgotPasswordTable extends PluginsfGuardForgotPasswordTable
{
    /**
     * Returns an instance of this class.
     *
     * @return sfGuardForgotPasswordTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('sfGuardForgotPassword');
    }
}