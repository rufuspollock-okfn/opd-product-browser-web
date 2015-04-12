<?php header("Content-Type: text/html; charset=utf-8");

	// -----------------------------------------------------------------------------------------------------------
	// On inclue les fichiers de contexte
	// -----------------------------------------------------------------------------------------------------------
	
	require("../secret/connexion.php");
	require("../fonctions.php");
	
	// -----------------------------------------------------------------------------------------------------------
	// Déclaration des variables
	// -----------------------------------------------------------------------------------------------------------

	define('DOSSIER_IMG_COUNTRY',				"images/country/");	
	$DataFolder = "../cache/";	
	
	// -----------------------------------------------------------------------------------------------------------	
	// Traitement
	// -----------------------------------------------------------------------------------------------------------



	$GRAPHE_Separateur = '';

	$Erreurs = array();
	
	$SQL = "SELECT * FROM gs1_gcp_rc where return_code not in (0,2,101)";
	$DataSet = mysql_query($SQL);	
	While ($Record = mysql_fetch_array($DataSet)) {	
		$Erreurs[$Record["RETURN_CODE"]] = $Record["RETURN_NAME"];	
	}
	
				
	$SQL = "SELECT count(*) as NB FROM gs1_gcp where return_code not in (0,2,10)";
	$DataSet = mysql_query($SQL);	
	$Record = mysql_fetch_array($DataSet);
	$NbTotal = $Record["NB"];
	
		
	$SQL = "SELECT return_code, count(*) as NB FROM gs1_gcp where return_code not in (0,2,10,101) group by return_code";
	$DataSet = mysql_query($SQL);	
	$Number = mysql_num_rows($DataSet);
	
	$i = 1;
	While ($Record = mysql_fetch_array($DataSet)) {	
	
		$ReturnCode	 	= $Record["return_code"];
		if($ReturnCode == '') $ReturnCode = "unassigned";
		$Nb 			= $Record["NB"]; 
		
		if($i < $Number) {
			
			$VALUE_PIE 		.= $GRAPHE_Separateur."[' Code ".$ReturnCode."<br/>(".number_format($Nb, 0, '.', ' ').")', ".number_format(100*($Nb/$NbTotal), 0, '.', ' ')."]"; 
			$PERC = $PERC + number_format(100*($Nb/$NbTotal), 0, '.', ' ');
			$GRAPHE_Separateur 	= ",";
			
		} else {
			
			$VALUE_PIE 		.= $GRAPHE_Separateur."[' Code ".$ReturnCode."<br/>(".number_format($Nb, 0, '.', ' ').")', ".(100 - $PERC)."]"; 
			$GRAPHE_Separateur 	= ",";					
		}
		
		$i ++;				
	} // while
	
	$h1 = "<b>GCP</b> - GEPIR Return code";
	$titre = "<b>GCP</b> - GEPIR Return code (".number_format($NbTotal, 0, '', ' ')." codes)";


	$Corps .= 	Template("template_quality",2,$Params=array(
		"VALUE_H1"					=> $h1,
		"VALUE_TITRE"				=> $titre,
		"VALUE_PIE"					=> $VALUE_PIE,
		
	));	

	$Corps .= 	Template("template_quality",3,$Params=array(
	));	

	foreach($Erreurs as $cle=>$valeur) {
		$Corps .= 	Template("template_quality",4,$Params=array(
			"VALUE_CD"					=> $cle,
			"VALUE_NM"					=> $valeur
		));	
	}

	$Corps .= 	Template("template_quality",5,$Params=array(
	));	
   
	$FileName 	= $DataFolder."stats-pie-1.html";
	$file = fopen($FileName, 'w');
	fputs($file, $Corps);
	fclose($file); 
	
	echo "File generated<hr/>";
	


?>