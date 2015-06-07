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
use Business\Model\Object\Agency;
use Business\Form\AgencyForm;

class AgencyController extends AbstractActionController
{
    protected $agencyTable;

    public function getAgencyTable()
    {
        if (!$this->agencyTable) {
            $sm = $this->getServiceLocator();
            $this->agencyTable = $sm->get('Business\Model\Table\AgencyTable');
        }
        return $this->agencyTable;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'agencies' => $this->getAgencyTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new AgencyForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $agency = new Agency();
            $form->setInputFilter($agency->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $agency->exchangeArray($form->getData());
                $this->getAgencyTable()->save($agency);

                // Redirect to list of posts
                return $this->redirect()->toRoute('agency');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('agency', array(
                'action' => 'add'
            ));
        }

        // Get the Post with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $agency = $this->getAgencyTable()->get($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('user', array(
                'action' => 'index'
            ));
        }

        $form  = new AgencyForm();
        $form->bind($agency);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($agency->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getAgencyTable()->save($agency);

                // Redirect to list of posts
                return $this->redirect()->toRoute('agency');
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
            return $this->redirect()->toRoute('agency');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getAgencyTable()->delete($id);
            }

            // Redirect to list of posts
            return $this->redirect()->toRoute('agency');
        }

        return array(
            'id'    => $id,
            'agency' => $this->getAgencyTable()->get($id)
        );
    }
}