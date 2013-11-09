<?php

namespace BookFair\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BookFair\Model\BookFair;

class BookFairFactory implements FactoryInterface
{
	/**
     * Create BookFair
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return BookFair
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        return new BookFair($dbAdapter);
    }	
	
}