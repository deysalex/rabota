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
use Business\Model\Object\Group;
use Business\Form\GroupForm;

class GroupController extends AbstractActionController
{
    protected $groupTable;

    public function getGroupTable()
    {
        if (!$this->groupTable) {
            $sm = $this->getServiceLocator();
            $this->groupTable = $sm->get('Business\Model\Table\GroupTable');
        }
        return $this->groupTable;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'groups' => $this->getGroupTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new GroupForm();
        $form->get('submit')->setValue('Добавить');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $group = new Group();
            $form->setInputFilter($group->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $group->exchangeArray($form->getData());
                $this->getGroupTable()->save($group);
                return $this->redirect()->toRoute('group');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('group', array(
                'action' => 'add'
            ));
        }
        try {
            $group = $this->getGroupTable()->get($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('group', array(
                'action' => 'index'
            ));
        }

        $form  = new GroupForm();
        $form->bind($group);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($group->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getGroupTable()->save($group);
                return $this->redirect()->toRoute('group');
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
            return $this->redirect()->toRoute('group');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Нет');

            if ($del == 'Да') {
                $id = (int) $request->getPost('id');
                $this->getGroupTable()->delete($id);
            }
            return $this->redirect()->toRoute('group');
        }

        return array(
            'id'    => $id,
            'group' => $this->getGroupTable()->get($id)
        );
    }
}