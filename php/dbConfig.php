<?php
$host = 'sql.freedb.tech';
$port = 3306;
$dbname = 'freedb_lostnfound_lofo';
$dbuser = 'freedb_group3_lofo';
$dbpass = 'BV*s%Z&e*XJFHf6';

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $dbuser, $dbpass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
