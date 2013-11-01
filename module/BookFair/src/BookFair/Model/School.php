<?php

namespace BookFair\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Db\Adapter\Adapter;

class School implements InputFilterAwareInterface
{
    public $id;
    public $code;
    public $name;
    public $address;
    
    protected $inputFilter;    
    protected $dbAdapter;
    
    public function __construct(Adapter $dbAdapter) {
        $this->dbAdapter = $dbAdapter;
    }
    
    public function getDbAdapter() {
        return $this->dbAdapter;
    }

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->code = (isset($data['code'])) ? $data['code'] : null;
        $this->name  = (isset($data['name'])) ? $data['name'] : null;
        $this->address  = (isset($data['address'])) ? $data['address'] : null;
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'code',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                'isEmpty' => 'Code is required'
                            ),
                        )
                    ),
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 3,
                            'max'      => 255,
                            'messages' => array(
                                'stringLengthTooShort' => 'Must not be less than %min% characters.',
                                'stringLengthTooLong' => 'Must not be greater than %max% characters'
                            ),
                        ),
                    ),
                    array(
                        'name' => 'Alpha',
                        'options' => array(
                            'allowWhiteSpace' => true,
                            'messages' => array(
                                'notAlpha' => 'Must contain letters only.'
                            )
                        )        
                    ),
                    array(
                        'name' => 'Db\NoRecordExists',
                        'options' => array(
                            'table' => 'school',
                            'field' => 'code',
                            'adapter' => $this->getDbAdapter(),
                            'messages' => array(
                                'recordFound' => 'Code already exists.'
                            )
                        ),
                    ),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                'isEmpty' => 'Name is required'
                            ),
                        )
                    ),
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255,
                            'messages' => array(
                                'stringLengthTooShort' => 'Must not be less than %min% characters.',
                                'stringLengthTooLong' => 'Must not be greater than %max% characters'
                            ),
                        ),
                    ),
                    array(
                        'name' => 'Db\NoRecordExists',
                        'options' => array(
                            'table' => 'school',
                            'field' => 'name',
                            'adapter' => $this->getDbAdapter(),
                            'messages' => array(
                                'recordFound' => 'Name already exists.'
                            )
                        ),
                    ),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'address',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                'isEmpty' => 'Address is required'
                            ),
                        )
                    ),
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255,
                            'messages' => array(
                                'stringLengthTooShort' => 'Must not be less than %min% characters.',
                                'stringLengthTooLong' => 'Must not be greater than %max% characters'
                            ),
                        ),
                    ),
                ),
            )));
            
            $this->inputFilter = $inputFilter;
        }
        
        return $this->inputFilter;
    }
}