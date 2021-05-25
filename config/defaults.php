<?php

// Configure defaults for the whole application.

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Timezone
date_default_timezone_set('Africa/Douala');

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';
$settings['template'] = $settings['root'] . '/templates';

// Error handler
$settings['error'] = [
    // Should be set to false in production
    'display_error_details' => true,
    // Should be set to false for unit tests
    'log_errors' => true,
    // Display error details in error log
    'log_error_details' => true,
];

// Logger settings
$settings['logger'] = [
    'name' => 'app',
    'path' => $settings['root'] . '/logs',
    'filename' => 'app.log',
    'level' => \Monolog\Logger::DEBUG,
    'file_permission' => 0775,
];

// Database settings
$dbopts = parse_url("postgres://sskoivfjangisv:314c34bf54ade499488035729c774893ab409a5dba5e6987e4c2a4922b5501af@ec2-18-215-111-67.compute-1.amazonaws.com:5432/d9d638bvv247to");
$settings['db'] = [
    'driver' => \Cake\Database\Driver\Postgres::class,
    'persistent' => true,
    'host' => $dbopts["host"],
    'username' => $dbopts["user"],
    'password' => $dbopts["pass"],
    'database' => ltrim($dbopts["path"],'/'),
    'schema' => 'public',
    'port' => $dbopts["port"],
    'encoding' => 'utf8',
    'timezone' => null,
    'flags' => [],
    'init' => [],
];

// Phoenix settings
$settings['phoenix'] = [
    'migration_dirs' => [
        'first' => __DIR__ . '/../resources/migrations',
    ],
    'environments' => [
        'local' => [
            'adapter' => 'PostgreSQL',
            'host' => $dbopts["host"],
            'port' => $dbopts["port"],
            'username' => $dbopts["user"],
            'password' => $dbopts["pass"],
            'db_name' => ltrim($dbopts["path"],'/'),
            'charset' => 'utf8',
        ],
        'local2' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'port' => 3306,
            'username' => 'root',
            'password' => 'root',
            'db_name' => 'gmt_csp',
            'charset' => 'utf8',
        ],
    ],
    'default_environment' => 'local',
    'log_table_name' => 'phoenix_log',
];

// Console commands
$settings['commands'] = [
    \App\Console\SchemaDumpCommand::class,
];

return $settings;
