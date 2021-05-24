<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

// Database
$settings['db']['database'] = 'gmt_csp';
$settings['pdo'] =  new \PDO('mysql:host=localhost;dbname=gmt_csp', 'root', '');

