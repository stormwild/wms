<?php

namespace BookFair\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BookFairController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
