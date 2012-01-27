<?php

/**
 * activity_type actions.
 *
 * @package    cce
 * @subpackage activity_type
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class activity_typeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->activity_types = Doctrine_Core::getTable('ActivityType')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->activity_type = Doctrine_Core::getTable('ActivityType')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->activity_type);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ActivityTypeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ActivityTypeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($activity_type = Doctrine_Core::getTable('ActivityType')->find(array($request->getParameter('id'))), sprintf('Object activity_type does not exist (%s).', $request->getParameter('id')));
    $this->form = new ActivityTypeForm($activity_type);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($activity_type = Doctrine_Core::getTable('ActivityType')->find(array($request->getParameter('id'))), sprintf('Object activity_type does not exist (%s).', $request->getParameter('id')));
    $this->form = new ActivityTypeForm($activity_type);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($activity_type = Doctrine_Core::getTable('ActivityType')->find(array($request->getParameter('id'))), sprintf('Object activity_type does not exist (%s).', $request->getParameter('id')));
    $activity_type->delete();

    $this->redirect('activity_type/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $activity_type = $form->save();

      $this->redirect('activity_type/edit?id='.$activity_type->getId());
    }
  }
}
