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
        return array(
            'factories' => array(
                'BookFair\Model\School' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    return new School($dbAdapter);    
                },
                'BookFair\Model\SchoolTable' =>  function($sm) {
                    $tableGateway = $sm->get('SchoolTableGateway');
                    return new SchoolTable($tableGateway);
                },
                'SchoolTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype($sm->get('BookFair\Model\School'));
                    return new TableGateway('school', $dbAdapter, null, $resultSetPrototype);
                },
                'BookFair\Model\BookFair' => 'BookFair\Factory\BookFairFactory',
                'BookFair\Model\BookFairTable' => function($sm) {
                    $tableGateway = $sm->get('BookFairTableGateway');
                    return new BookFairTable($tableGateway);
                },
                'BookFairTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype($sm->get('BookFair\Model\BookFair'));
                    return new TableGateway('bookfair', $dbAdapter, null, $resultSetPrototype);
                }
            ),
        );
    }
}
