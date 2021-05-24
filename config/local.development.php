<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
$dbopts = parse_url(getenv('postgres://sskoivfjangisv:314c34bf54ade499488035729c774893ab409a5dba5e6987e4c2a4922b5501af@ec2-18-215-111-67.compute-1.amazonaws.com:5432/d9d638bvv247to'));

// Database
$settings['db']['database'] = ltrim($dbopts["path"], "/");
$settings['pdo'] =  new \PDO('pgsql:host=$dbopts["host"];port=$dbopts["port"];dbname=ltrim($dbopts["path"],"/"), $dbopts["user"], $dbopts["pass"]);

