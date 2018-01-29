<?php

$cert = '/var/www/vhosts/direct2asia.com/httpdocs/compose.crt';

$ctx = stream_context_create(array(
    "ssl" => array(
        "cafile"            => $cert,
        "allow_self_signed" => false,
        "verify_peer"       => true, 
        "verify_peer_name"  => true,
        "verify_expiry"     => true, 
    ),
));

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://@aws-ap-southeast-1-portal.2.dblayer.com:15429,aws-ap-southeast-1-portal.0.dblayer.com:15429/direct2asia?',
            'options' => [
                'username' => 'direct2asia',
                'password' => 'Amtujpino.1',
                'ssl' => true
            ],
            'driverOptions' => [
                'context' => $ctx
            ]

        ],


    ],
];
