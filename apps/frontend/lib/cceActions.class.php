<?php

class cceActions extends sfActions
{

  /**
   * Retrieves the current sfUser object.
   *
   * This is a proxy method equivalent to:
   *
   * <code>$this->getContext()->getUser()</code>
   *
   * @return myUser The current sfUser implementation instance
   */
  public function getUser()
  {
    return parent::getUser();
  }

}