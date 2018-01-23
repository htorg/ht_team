<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@common/runtime/cache',
        ],
    		'redis' => [
    				'class' => 'yii\redis\Connection',
    				'hostname' => '10.4.38.2',
    				'port' => 6379,
    				'password'=>'3u6sK57s8j9aG',
    				'database' => 0,
    		]

        
    ],
];
