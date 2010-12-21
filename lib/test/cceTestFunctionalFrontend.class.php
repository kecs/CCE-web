<?php

class CceTestFunctionalFrontend extends sfTestFunctional
{
  public function resetDatabase()
  {
    $this->info('Resetting test database...');
    Doctrine_Core::loadData(sfConfig::get('sf_data_dir').'/fixtures');
    $this->info('   complete.');

    return $this;
  }

  public function login($username, $password)
  {
    $this->info('Logging In...');
    $this->get('/en/login');

    $this->with('request')->begin()->
            isParameter('module', 'sfGuardAuth')->
            isParameter('action', 'signin')->end();

    $this->with('response')->begin()->
            isStatusCode(401)->
            checkElement('#signin_username', '')->
            checkElement('#signin_password', '')->
            end();

    $this->info("sending login form in with username $username and password $password")->
            click('Sign in', array(
            'signin' => array(
                    'username' => $username,
                    'password' => $password,
            ))
    );

    $this->with('response')->begin()->
            isStatusCode(302)->
            end();

    $this->info('Login complete.');

    return $this;
  }

  public function loginAdmin()
  {
    return $this->login('admin@silvergate112.hu', 'admin');
  }
}