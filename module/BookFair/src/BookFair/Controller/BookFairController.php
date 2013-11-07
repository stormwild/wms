<?php

namespace BookFair\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BookFairController extends AbstractActionController
{
    protected $bookFairTable;
    
    public function getBookFairTable()
    {
        if (!$this->bookFairTable) {
            $sm = $this->getServiceLocator();
            $this->bookFairTable = $sm->get('BookFair\Model\BookFairTable');
        }
        return $this->bookFairTable;
    }
    
    public function indexAction()
    {
        $viewModel['bookfairs'] = $this->getBookFairTable()->fetchAll();
        
        return $viewModel;
    }
    
    public function addAction()
    {
        
    }
}
