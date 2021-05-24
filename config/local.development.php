<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
$db = parse_url("postgres://sskoivfjangisv:314c34bf54ade499488035729c774893ab409a5dba5e6987e4c2a4922b5501af@ec2-18-215-111-67.compute-1.amazonaws.com:5432/d9d638bvv247to");
$settings['db']['database'] = ltrim($db["path"], "/");
$settings['pdo'] =  new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));
