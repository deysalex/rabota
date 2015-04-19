<?php
/**
 * Created by PhpStorm.
 * User: Deys
 * Date: 11.04.2015
 * Time: 18:27
 */
namespace Business\Form;

use Zend\Form\Form;

class VacancyForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('vacancy');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'title',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title',
            ),
        ));
        $this->add(array(
            'name' => 'description',
            'type' => 'Text',
            'options' => array(
                'label' => 'Description',
            ),
        ));
        $this->add(array(
            'name' => 'education',
            'type' => 'Text',
            'options' => array(
                'label' => 'Education',
            ),
        ));
        $this->add(array(
            'name' => 'price',
            'type' => 'Text',
            'options' => array(
                'label' => 'Price',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}