<?php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

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
//            'dsn' => 'mysql://root:admin1234@mysql:3306/posts',
            'adapter' => 'mysql',
            'host' => $_SERVER['MYSQL_SERVER'],
            'name' => $_SERVER['MYSQL_DATABASE'],
            'user' => 'root',
            'pass' => $_SERVER['MYSQL_PASSWORD'],
            'port' => $_SERVER['MYSQL_PORT'],
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation'
];


