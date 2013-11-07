<?php

namespace BookFair\Model;

use Zend\Db\TableGateway\TableGateway;

class BookFairTable
{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll()
    {
        $adapter = $this->tableGateway->getAdapter();
        
        $sql = <<< EOD
        SELECT 
            b.id as id, 
            b.status as status,
            s.id as school_id,
            s.code as school_code,
            s.name as school_name,
            s.address as school_address
        FROM bookfair b
        INNER JOIN school s
        ON b.school_id = s.id
EOD;
        
        $statement = $adapter->createStatement($sql);
        $resultSet = $statement->execute();
        return $resultSet;
    }
    
    public function getBookFair($id)
    {
        $id  = (int) $id;
        
        $sql = <<< EOD
        SELECT
            b.id as id,
            b.status as status,
            s.id as school_id,
            s.code as school_code,
            s.name as school_name,
            s.address as school_address
        FROM bookfair b
        INNER JOIN school s
        ON b.school_id = s.id
        WHERE b.id = ?
EOD;
        $statement = $adapter->createStatement($sql, array($id));
        $resultSet = $statement->execute();
        
        $row = $resultSet->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
    
    public function saveBookFair(BookFair $bookFair)
    {
        $data = array(
            'id' => $bookFair->id,
            'status'  => $bookFair->status,
            'school_id'  => $bookFair->school_id,
        );
        
        $id = (int)$bookFair->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getBookFair($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }        
    }
    
    public function deleteBookFair($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}