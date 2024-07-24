<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'formatter' => [
            'dateFormat' => 'yyyy-MM-dd',
        ],
        'assetManager' => [
            'appendTimestamp' => true, // Corrected property name
        ],
        'authManager' => [
            'class' => \yii\rbac\DbManager::class,
        ],
    ],
];
