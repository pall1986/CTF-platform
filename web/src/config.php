<?php
// Configurazione PDO per MySQL
$host = 'db';
$db   = 'ctf_platform';
$user = 'ctf_user';
$pass = 'ctf_pass';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Errore DB: " . $e->getMessage());
}





