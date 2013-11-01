<?php

namespace BookFair\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use BookFair\Model\School;
use BookFair\Form\SchoolForm;

class SchoolController extends AbstractActionController
{
    protected $schoolTable;
    
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
        $flashMessenger = $this->flashMessenger();
        if ($flashMessenger->hasMessages()) {
            $viewModel['messages']['success'] = $flashMessenger->getSuccessMessages();
            $viewModel['messages']['info'] = $flashMessenger->getInfoMessages();
            $viewModel['messages']['error'] = $flashMessenger->getErrorMessages();
        }
        
        $viewModel['schools'] = $this->getSchoolTable()->fetchAll();
        
        return $viewModel;
    }
    
    public function addAction()
    {
        $form = new SchoolForm();        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $school = $this->getServiceLocator()->get('BookFair\Model\School');
            $form->setInputFilter($school->getInputFilter());
            $form->setData($request->getPost());
            $form->get('code');
            if($form->isValid()) {
                $school->exchangeArray($form->getData());
                $this->getSchoolTable()->saveSchool($school);
                $this->flashMessenger()->addSuccessMessage($school->name . ' successfully added.');                
                return $this->redirect()->toRoute('school');
            }
        }
        
        return array('form' => $form);
    }
    
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);        
        if (!$id) {
            return $this->redirect()->toRoute('school', array(
                'action' => 'add'
            ));
        }
        
        // Get the school with the given id, redirect to index if not found
        try {
            $school = $this->getSchoolTable()->getSchool($id);
        }
        catch (\Exception $ex) {
            $this->flashMessenger()->addErrorMessage($ex->getMessage()); 
            return $this->redirect()->toRoute('school', array(
                'action' => 'index'
            ));
        }
        
        $form  = new SchoolForm();
        $form->bind($school);
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $form->setInputFilter($school->getInputFilter());
            $form->setData($request->getPost());
        
            if ($form->isValid()) {
                $this->getSchoolTable()->saveSchool($school);
                $this->flashMessenger()->addSuccessMessage('Changes to ' . $school->name . ' successfully saved.');   
                // Redirect to list of schools
                return $this->redirect()->toRoute('school');
            }
        }
        
        return array(
            'id' => $id,
            'form' => $form,
        );
    }
    
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('school');
        }
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
        
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getSchoolTable()->deleteSchool($id);
            }
            $this->flashMessenger()->addSuccessMessage('School successfully removed.');   
            // Redirect to list of schools
            return $this->redirect()->toRoute('school');
        }
        
        return array(
            'id'    => $id,
            'school' => $this->getSchoolTable()->getSchool($id)
        );
    }
}
