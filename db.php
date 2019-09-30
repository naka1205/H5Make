<?php
use think\Db;
$config = [
    'type'        => 'Mongo',
    'query'       => 'think\db\Mongo',
    'dsn'         => '',
    'hostname'    => '127.0.0.1',
    'database'    => 'test',
    'username'    => '',
    'password'    => '',
    'hostport'    => '',
    'params'      => [],
    'charset'     => 'utf8',
    'prefix'      => ''
];
Db::setConfig($config);