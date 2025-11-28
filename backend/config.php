<?php
// backend/config.php - reads .env in project root
ini_set('display_errors',1);
error_reporting(E_ALL);

$envPath = __DIR__ . '/../.env';
if (!file_exists($envPath)) {
    die('.env not found. Copy .env.example to .env and configure DB credentials.');
}
$env = parse_ini_file($envPath);

if (!isset($env['DB_HOST'],$env['DB_NAME'],$env['DB_USER'])) {
    die('Invalid .env');
}

define('DB_HOST',$env['DB_HOST']);
define('DB_NAME',$env['DB_NAME']);
define('DB_USER',$env['DB_USER']);
define('DB_PASS',$env['DB_PASS']);

function db(){
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4';
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    return $pdo;
}
