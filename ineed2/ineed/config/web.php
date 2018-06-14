<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name'=>'iNeed - Health',
    'language' => 'es',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        
        // Agregamos librerias de funcones Generales
        'generales' => [
            'class' => 'app\components\Generales',
        ],
        'formatofecha' => [
            'class' => 'app\components\FormatoFecha',
        ],
        'firebaseapp' => [
            'class' => 'app\components\FirebaseApp',
        ],

        // Agregamos un tema para ineed
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@app/themes/iphone7'],
                'baseUrl' => '@web/../themes/iphone7',
            ],
        ],
        // Agregamos acceso a credenciales via archivo JSON descargado de Firebase
        'firebase' => [
            'class'=>'grptx\Firebase\Firebase',
            //'credential_file'=>'http://www.ineedserv.com/web/service_account.json', // (see https://firebase.google.com/docs/admin/setup#add_firebase_to_your_app)
            'credential_file'=>'service_account.json', // (see https://firebase.google.com/docs/admin/setup#add_firebase_to_your_app)
            'database_uri'=>'https://medical-7d55f.firebaseio.com', // (optional)
        ],
        
        'assetManager' => [
            'bundles' => [
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyCoQTBQiZvRzL-8M_8UTCy45cOd0gdRwjU',
                        'language' => 'es',
                        'libraries' => 'places',
                        'v' => '3.exp'
                        //'sensor'=> 'false'
                    
                    ]
                ]
            ]
        ],
        

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'dEutBD61opbW_y8bUb7fdz-dbKNZ_KYi',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        // CONFIGURACION PARA ENVIO DE CORREO DESDE LA APLICACION
        'mail' => [
         'class' => 'yii\swiftmailer\Mailer',
         'transport' => [
             'class' => 'Swift_SmtpTransport',
             'host' => 'smtp.gmail.com',  // ej. smtp.mandrillapp.com o smtp.gmail.com
             'username' => 'qsl.sistemas@gmail.com',
             'password' => 'tr1c4mp30n',
             'port' => '587', // El puerto 25 es un puerto común también
             'encryption' => 'tls', // Es usado también a menudo, revise la configuración del servidor
         ],
        ],
        
        /*'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        */
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
