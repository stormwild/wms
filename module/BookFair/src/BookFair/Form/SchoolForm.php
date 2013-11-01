<?php

namespace BookFair\Form;

use Zend\Form\Form;

class SchoolForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('school');
        
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');
        
        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'code',
            'type' => 'Text',
            'options' => array(
                'label' => 'Code',
            ),
        ));
        
        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name',
            ),
        ));
        
        $this->add(array(
            'name' => 'address',
            'type' => 'Text',
            'options' => array(
                'label' => 'Address',
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Save',
                'id' => 'submit-btn',
                'class' => 'btn btn-default'
            ),
        ));
    }
}