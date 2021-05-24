<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
$db = parse_url(getenv("DATABASE_URL"));
$settings['db']['database'] = '';
$settings['pdo'] =  new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));
