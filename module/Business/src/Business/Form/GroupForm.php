<?php
/**
 * Created by PhpStorm.
 * User: Deys
 * Date: 11.04.2015
 * Time: 18:27
 */
namespace Business\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class GroupForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('group');

        $id = new Element\Hidden('id');
        $this->add($id);

        $name = new Element\Text('name');
        $name->setAttribute('class', 'form-control');
        $name->setAttribute('placeholder', 'Название');
        $name->setAttribute('aria-describedby', 'basic-addon2');
        $this->add($name);

        $submit = new Element\Submit('submit');
        $submit->setValue('Сохранить');
        $submit->setAttribute('class', 'btn btn-default');
        $this->add($submit);
    }
}