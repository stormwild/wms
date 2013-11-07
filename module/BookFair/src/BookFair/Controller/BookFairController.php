<?php

namespace BookFair\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use BookFair\Form\BookFairForm;

class BookFairController extends AbstractActionController
{
    protected $bookFairTable;
    
    protected $schoolTable;
    
    public function getBookFairTable()
    {
        if (!$this->bookFairTable) {
            $sm = $this->getServiceLocator();
            $this->bookFairTable = $sm->get('BookFair\Model\BookFairTable');
        }
        return $this->bookFairTable;
    }
    
    public function getSchoolTable()
    {
    	if (!$this->schoolTable) {
    		$sm = $this->getServiceLocator();
    		$this->schoolTable = $sm->get('BookFair\Model\SchoolTable');
    	}
    	return $this->schoolTable;
    }
    
    public function indexAction()
    {
        $viewModel['bookfairs'] = $this->getBookFairTable()->fetchAll();
        
        return $viewModel;
    }
    
    public function addAction()
    {
    	$schools = $this->getSchoolTable()->fetchAll();
    	
    	foreach ($schools as $school) {
    		$options[$school->id] = $school->name;
    	}
    	
        $form = new BookFairForm(null, $options);
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
        	
        }
        
        return array('form' => $form);
    }
}
