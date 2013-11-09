<?php

namespace BookFair\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BookFair\Model\SchoolTable;

class SchoolTableFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$tableGateway = $serviceLocator->get('SchoolTableGateway');
		return new SchoolTable($tableGateway);
	}
}