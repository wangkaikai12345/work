<?php

return [

    'hook' => env('HOOK_URL', ''),

    'sso_client_id' => env('sso_client_id', 1),                     // 授权服务器分配的id
    'sso_client_secret'=> env('sso_client_secret', ''), // 授权服务器分配的密钥
    'sso_client_callback'=>env('sso_client_callback', 'http://aw.tao.dev/oauth/callback'),   // 子系统与授权服务器通信时的回调地址 要修改，必须连同路由地址一起修改，同时还需修改授权服务器配置的回调地址
    'sso_server'=>env('sso_server', 'http://l.ctoblogs.com'),  // 为授权服务器地址

    'app_id'        => env('APP_ID', '111111'),

    'email_tips' => '请补全您的邮箱信息，使用工单系统',

    'hide' => [
        '/admin/resources/works',
        '/admin/resources/comments',
        '/admin/resources/love',
        '/admin/resources/systems',
        '/admin/resources/types',
        '/admin/resources/users',
        '/admin',
    ],

    'admin_phone' => '18810463717',
];