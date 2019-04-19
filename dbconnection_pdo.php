<?php
# connect to the database
$host = "localhost";
$db = "test";
$user = "BruceU";
$pass = "irondragonslayer";
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
  	$DBH = new PDO($dsn, $user, $pass, $opt);
  	//$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  	echo "Connected!!!";
}
catch(PDOException $e) {
    echo "PDO error";
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
}

?>