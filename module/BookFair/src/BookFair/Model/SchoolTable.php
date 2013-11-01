<?php

namespace BookFair\Model;

use Zend\Db\TableGateway\TableGateway;

class SchoolTable
{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
    public function getSchool($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
    
    public function saveSchool(School $school)
    {
        $data = array(
            'code' => $school->code,
            'name'  => $school->name,
            'address'  => $school->address,
        );
    
        $id = (int)$school->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getSchool($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
    
    public function deleteSchool($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
        
}