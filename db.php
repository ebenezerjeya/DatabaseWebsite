<?php
try {
	$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8mb4', 'BruceU', 'irondragonslayer');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
	echo "Connection failed : ". $e->getMessage();
}
?>
