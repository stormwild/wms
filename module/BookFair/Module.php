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
                'BookFair\Model\School' => 'BookFair\Factory\SchoolFactory',            		
                'BookFair\Model\SchoolTable' =>  'BookFair\Factory\SchoolTableFactory',
                'BookFair\Factory\SchoolTableGateway' => 'BookFair\Factory\SchoolTableGatewayFactory',
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
