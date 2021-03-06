<?php

/**
 * Window form.
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class WindowForm extends BaseWindowForm
{
  /**
   * @see EntityForm
   */
  public function configure()
  {
    $this->useFields(array(
        'name',
        'comment',
        'parent',
    ));
  }
}
