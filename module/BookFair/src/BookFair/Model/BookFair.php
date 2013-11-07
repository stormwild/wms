<?php

namespace BookFair\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Db\Adapter\Adapter;

class BookFair implements InputFilterAwareInterface
{
    public $id;
    public $status;
    public $school_id;
    public $school_code;
    public $school_name;
    
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
        $this->status = (isset($data['status'])) ? $data['status'] : null;
        $this->school_id  = (isset($data['school_id'])) ? $data['school_id'] : null;
        $this->school_code  = (isset($data['school_code'])) ? $data['school_code'] : null;
        $this->school_name  = (isset($data['school_name'])) ? $data['school_name'] : null;
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
        
    }
}
