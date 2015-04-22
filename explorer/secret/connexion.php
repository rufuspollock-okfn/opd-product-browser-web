<?php
	// add the connection details for your database here and
	// rename to connexion.php

	$Connexion 	= $_ENV["POD_DB_PORT_3306_TCP_ADDR"]; 
	$Login 		= $_ENV["POD_DB_ENV_MYSQL_USER"];
	$Password 	= $_ENV["POD_DB_ENV_MYSQL_PASSWORD"];
	$NomBase 	= $_ENV["POD_DB_ENV_MYSQL_DATABASE"];
	
	include("connexion_mysql.php")
	
?>
