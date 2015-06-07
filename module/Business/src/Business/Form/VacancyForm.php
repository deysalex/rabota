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

class VacancyForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('vacancy');

        $id = new Element\Hidden('id');
        $this->add($id);

        $title = new Element\Text('title');
        $title->setAttribute('class', 'form-control');
        $title->setAttribute('placeholder', 'Заголовок');
        $title->setAttribute('aria-describedby', 'basic-addon2');
        $this->add($title);

        $description = new Element\Textarea('description');
        $description->setLabel('description');
        $description->setAttribute('class', 'form-control');
        $description->setAttribute('placeholder', 'Описание');
        $description->setAttribute('rows', 10);
        $this->add($description);

        $education = new Element\Text('education');
        $education->setLabel('education');
        $education->setAttribute('class', 'form-control');
        $education->setAttribute('placeholder', 'Образование');
        $education->setAttribute('aria-describedby', 'basic-addon2');
        $this->add($education);

        $price = new Element\Text('price');
        $price->setLabel('price');
        $price->setAttribute('class', 'form-control');
        $price->setAttribute('placeholder', 'Оклад');
        $price->setAttribute('aria-describedby', 'basic-addon2');
        $this->add($price);

        $submit = new Element\Submit('submit');
        $submit->setValue('Сохранить');
        $submit->setAttribute('class', 'btn btn-default');
        $this->add($submit);
    }
}