<?php

require __DIR__ . '/local.testing.php';

// Database
$settings['db']['host'] = '127.0.0.1';
$settings['db']['database'] = 'gmt_csp';
$settings['db']['username'] = 'root';
$settings['db']['password'] = 'root';

$settings['phoenix']['environments']['local']['db_name'] = $settings['db']['database'];
$settings['phoenix']['environments']['local']['username'] = $settings['db']['username'];
$settings['phoenix']['environments']['local']['password'] = $settings['db']['password'];
