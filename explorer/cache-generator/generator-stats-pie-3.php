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

	$SQL = "SELECT count(*) as NB FROM gtin";
	$DataSet = mysql_query($SQL);	
	$Record = mysql_fetch_array($DataSet);
	$NbTotal = $Record["NB"];	
	
	$SQL = "SELECT count(*) as NB FROM gtin where brand_cd > 0 and brand_cd in (select brand_cd from brand where brand_type_cd = 1 and brand_nm not like '0_%') ";
	$DataSet = mysql_query($SQL);	
	$Record = mysql_fetch_array($DataSet);
	$NbBrandType_1 = $Record["NB"];
	
	$PERC_1 = number_format(100*($NbBrandType_1/$NbTotal), 0, '.', ' ');
	$VALUE_PIE .= "['Manufacturer-brand<br/> (".number_format($NbBrandType_1, 0, '.', ' ').")', ".$PERC_1."]"; 
	$VALUE_PIE .= ","; 
	
	$SQL = "SELECT count(*) as NB FROM gtin where brand_cd > 0 and brand_cd in (select brand_cd from brand where brand_type_cd = 2) ";
	$DataSet = mysql_query($SQL);	
	$Record = mysql_fetch_array($DataSet);
	$NbBrandType_2 = $Record["NB"];

	$PERC_2 = number_format(100*($NbBrandType_2/$NbTotal), 0, '.', ' ');
	$VALUE_PIE .= "['Retailer-brand <br/>(".number_format($NbBrandType_2, 0, '.', ' ').")', ".$PERC_2."]"; 
	$VALUE_PIE .= ","; 
	
	$SQL = "SELECT count(*) as NB FROM gtin where brand_cd > 0 and brand_cd in (select brand_cd from brand where brand_type_cd = 3) ";
	$DataSet = mysql_query($SQL);	
	$Record = mysql_fetch_array($DataSet);
	$NbBrandType_3 = $Record["NB"];

	$PERC_3 = number_format(100*($NbBrandType_3/$NbTotal), 0, '.', ' ');			
	$VALUE_PIE .= "['Validity to check  <br/> (".number_format($NbBrandType_3, 0, '.', ' ').")', ".$PERC_3."]"; 
	$VALUE_PIE .= ","; 
	
	$NbUnAssigned = $NbTotal - $NbBrandType_1 - $NbBrandType_2 - $NbBrandType_3;
	$PERC_UnAssigned = 100 - $PERC_1 - $PERC_2 - $PERC_3;  
	$VALUE_PIE .= "['Brand unassigned <br/>(".number_format($NbUnAssigned, 0, '.', ' ').")', ".$PERC_UnAssigned."]"; 
	
	$h1 = "<b>GTIN</b> - Brand";
	$titre = "<b>GTIN</b> - Brand (".number_format($NbTotal, 0, '', ' ')." codes)";	
	
	$Corps .= 	Template("template_quality",2,$Params=array(
		"VALUE_H1"					=> $h1,
		"VALUE_TITRE"				=> $titre,
		"VALUE_PIE"					=> $VALUE_PIE,
		
	));	

	if(isset($List)) { 
	
		$Corps .= 	Template("template_quality",3,$Params=array(
		));	

		foreach($List as $element) {
			$Corps .= 	Template("template_quality",4,$Params=array(
				"VALUE_CD"					=> $element["cd"],
				"VALUE_NM"					=> $element["nm"]
			));	
		}

		$Corps .= 	Template("template_quality",5,$Params=array(
		));	
   
	} 
						
	$FileName 	= $DataFolder."stats-pie-3.html";
	$file = fopen($FileName, 'w');
	fputs($file, $Corps);
	fclose($file); 
	
	echo "File generated<hr/>";
	


?>