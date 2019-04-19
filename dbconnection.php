<?php

define("DB_HOST", "localhost");
define("DB_USER", "BruceU");
define("DB_PASSWORD", "irondragonslayer");
define("DB_NAME", "test");
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('could not connect to MySQL: ' . mysqli_connect_error());

?>