<?php

// Phpunit testing environment

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Database
$settings['db']['database'] = 'gmt_csp';

// Mocked Logger settings
$settings['logger'] = [
    'path' => '',
    'level' => 0,
    'test' => new \Psr\Log\NullLogger(),
];
