<?php

namespace BookFair\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BookFair\Model\BookFairTable;

class BookFairTableFactory implements FactoryInterface
{

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$tableGateway = $serviceLocator->get('BookFairTableGateway');
		return new BookFairTable($tableGateway);
	}

}