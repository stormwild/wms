<?php
return array(
		'factories' => array(
				'BookFair\Model\School' => 'BookFair\Factory\SchoolFactory',
				'BookFair\Model\SchoolTable' =>  'BookFair\Factory\SchoolTableFactory',
				'SchoolTableGateway' => 'BookFair\Factory\SchoolTableGatewayFactory',
				'BookFair\Model\BookFair' => 'BookFair\Factory\BookFairFactory',
				'BookFair\Model\BookFairTable' => 'BookFair\Factory\BookFairTableFactory',
				'BookFairTableGateway' => 'BookFair\Factory\BookFairTableGatewayFactory',
		),
);