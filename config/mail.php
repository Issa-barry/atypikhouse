<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | Laravel supports both SMTP and PHP's "mail" function as drivers for the
    | sending of e-mail. You may specify which one you're using throughout
    | your application here. By default, Laravel is setup for SMTP mail.
    |
    | Supported: "smtp", "sendmail", "mailgun", "ses",
    |            "postmark", "log", "array", "failover"
    */

    // 'driver' => env('MAIL_MAILER', 'smtp'), //commenter par moi

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may provide the host address of the SMTP server used by your
    | applications. A default option is provided that is compatible with
    | the Mailgun mail service which will provide reliable deliveries.
    |
    */

    // 'host' => env('MAIL_HOST', 'smtp.mailgun.org'), //ancien
    // 'host' => env('MAIL_HOST', 'smtp.gmail.com'), //commenter par moi
    /*
    |--------------------------------------------------------------------------
    | SMTP Host Port
    |--------------------------------------------------------------------------
    |
    | This is the SMTP port used by your application to deliver e-mails to
    | users of the application. Like the host we have set this value to
    | stay compatible with the Mailgun e-mail application by default.
    |
    */
    //2 par moi
    // 'mailers' => [
    //     'smtp' => [
    //         'transport' => 'smtp',
    //         'host' => env('MAIL_HOST', 'smtp.gmail.com'),
    //         'port' => env('MAIL_PORT', 465),
    //         'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    //         'username' => env('MAIL_USERNAME'),
    //         'password' => env('MAIL_PASSWORD'),
    //         'timeout' => null,
    //         'auth_mode' => null,
    //     ],

    //     'ses' => [
    //         'transport' => 'ses',
    //     ],

    //     'mailgun' => [
    //         'transport' => 'mailgun',
    //     ],

    //     'postmark' => [
    //         'transport' => 'postmark',
    //     ],

    //     'sendmail' => [
    //         'transport' => 'sendmail',
    //         'path' => '/usr/sbin/sendmail -bs',
    //     ],

    //     'log' => [
    //         'transport' => 'log',
    //         'channel' => env('MAIL_LOG_CHANNEL'),
    //     ],

    //     'array' => [
    //         'transport' => 'array',
    //     ],

    //     'failover' => [
    //         'transport' => 'failover',
    //         'mailers' => [
    //             'smtp',
    //             'log',
    //         ],
    //     ],
    // ],

    //Ancien
    // 'mailers' => [
    //     'smtp' => [
    //         'transport' => 'smtp',
    //         'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
    //         'port' => env('MAIL_PORT', 587),
    //         'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    //         'username' => env('MAIL_USERNAME'),
    //         'password' => env('MAIL_PASSWORD'),
    //         'timeout' => null,
    //         'auth_mode' => null,
    //     ],

    //     'ses' => [
    //         'transport' => 'ses',
    //     ],

    //     'mailgun' => [
    //         'transport' => 'mailgun',
    //     ],

    //     'postmark' => [
    //         'transport' => 'postmark',
    //     ],

    //     'sendmail' => [
    //         'transport' => 'sendmail',
    //         'path' => '/usr/sbin/sendmail -bs',
    //     ],

    //     'log' => [
    //         'transport' => 'log',
    //         'channel' => env('MAIL_LOG_CHANNEL'),
    //     ],

    //     'array' => [
    //         'transport' => 'array',
    //     ],

    //     'failover' => [
    //         'transport' => 'failover',
    //         'mailers' => [
    //             'smtp',
    //             'log',
    //         ],
    //     ],
    // ],
    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all e-mails sent by your application to be sent from
    | the same address. Here, you may specify a name and address that is
    | used globally for all e-mails that are sent by your application.
    |
    */
// Issa modif smtp :
'driver' => env('MAIL_DRIVER', 'smtp'),
'host' => env('MAIL_HOST', 'smtp.gmail.com'),
'port' => env('MAIL_PORT', 587),
'username' => env('MAIL_USERNAME'),
'password' => env('MAIL_PASSWORD'),
'encryption' => env('MAIL_ENCRYPTION', 'tls'),

// Issa fin modif smtp :
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'issabarry67@gmail.com'),
        'name' => env('MAIL_FROM_NAME', 'AtypikHouse'),
    ],
    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],



];
