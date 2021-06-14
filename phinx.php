<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'dsn' => 'mysql://root:admin1234@mysql:3306/posts'
//            'adapter' => 'mysql',
//            'host' => '127.0.0.1',
//            'name' => 'posts',
//            'user' => 'root',
//            'pass' => 'admin1234',
//            'port' => '9202',
//            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation'
];
