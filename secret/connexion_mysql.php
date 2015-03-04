<?php
//============================================================================
// Module de connexion MySQL                                        // v1.0
//============================================================================

	if(!@mysql_connect($Connexion, $Login, $Password)) {
		echo "<center>Les serveurs ne répondent pas, le problème devrait être résolu sous peu...</center>";
		//echo mysql_error();
		exit();
	}
	
	$database = @mysql_select_db ($NomBase) ; 
	if (empty($database)) {
		echo "Site en maintenance,... ";
		exit();
	}
	else
	{
		// Pour demander à Mysql d'envoyer de l'utf-8
		mysql_query("SET NAMES UTF8"); 
	}

?>