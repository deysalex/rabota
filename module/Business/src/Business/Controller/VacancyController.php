<?php
/**
 * Created by PhpStorm.
 * User: Deys
 * Date: 11.04.2015
 * Time: 15:20
 */
namespace Business\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Business\Model\Object\Vacancy;
use Business\Form\VacancyForm;

class VacancyController extends AbstractActionController
{
    protected $vacancyTable;

    public function getVacancyTable()
    {
        if (!$this->vacancyTable) {
            $sm = $this->getServiceLocator();
            $this->vacancyTable = $sm->get('Business\Model\Table\VacancyTable');
        }
        return $this->vacancyTable;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'vacancies' => $this->getVacancyTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new VacancyForm();
        $form->get('submit')->setValue('Сохранить');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $vacancy = new Vacancy();
            $form->setInputFilter($vacancy->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $vacancy->exchangeArray($form->getData());
                $this->getVacancyTable()->save($vacancy);

                // Redirect to list of posts
                return $this->redirect()->toRoute('vacancy');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('vacancy', array(
                'action' => 'add'
            ));
        }

        // Get the Post with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $vacancy = $this->getVacancyTable()->getById($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('vacancy', array(
                'action' => 'index'
            ));
        }

        $form  = new VacancyForm();
        $form->bind($vacancy);
        $form->get('submit')->setAttribute('value', 'Редактировать');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($vacancy->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getVacancyTable()->save($vacancy);

                // Redirect to list of posts
                return $this->redirect()->toRoute('vacancy');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('vacancy');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getVacancyTable()->deleteById($id);
            }

            // Redirect to list of posts
            return $this->redirect()->toRoute('vacancy');
        }

        return array(
            'id'    => $id,
            'vacancy' => $this->getVacancyTable()->getById($id)
        );
    }
}