<?php

namespace BookFair\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BookFair\Model\School;

class SchoolFactory implements FactoryInterface
{
	/**
	 * Create School
	 * 
	 * @param ServiceLocatorInterface $serviceLocator
     * @return School
	 */
	public function createService(ServiceLocatorInterface $serviceLocator) 
	{
		$dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
		return new School($dbAdapter);
	}
}