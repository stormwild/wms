<?php

namespace BookFair\Form;

use Zend\Form\Form;

class BookFairForm extends Form
{
    public function __construct($name = null, $schools = null)
    {
        parent::__construct('bookfair');
        
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');
        
        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'status',
            'type' => 'Text',
            'options' => array(
                'label' => 'Status',
            ),
        ));
        
        $this->add(array(
            'name' => 'school',
            'type' => 'Select',
            'options' => array(
                'label' => 'Select School',
                'value_options' => $schools,
             )
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