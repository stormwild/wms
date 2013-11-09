<?php
namespace BookFair;

use BookFair\Model\School;
use BookFair\Model\SchoolTable;
use BookFair\Model\BookFair;
use BookFair\Model\BookFairTable;
use BookFair\Factory\BookFairFactory;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return include __DIR__ . '/config/service.config.php';
    }
}
