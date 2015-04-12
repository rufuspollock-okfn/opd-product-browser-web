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

	$Segments = array(
		'10000000' => "Pet Care/Food",
		'47000000' => "Cleaning/Hygiene Products",
		'50000000' => "Food/Beverage/Tobacco",
		'51000000' => "Healthcare",
		'53000000' => "Beauty/Personal Care/Hygiene",
		'54000000' => "Baby Care",
		'58000000' => "Cross Segment",
		'60000000' => "Textual/Printed/Reference Materials",
		'61000000' => "Music",
		'62000000' => "Stationery/Office Machinery/Occasion Supplies",
		'63000000' => "Footwear",
		'64000000' => "Personal Accessories",	
		'65000000' => "Computing",	
		'66000000' => "Communications",	
		'67000000' => "Clothing",		 
		'68000000' => "Audio Visual/Photography",	
		'70000000' => "Arts/Crafts/Needlework",
		'71000000' => "Sports Equipment",	 
		'72000000' => "Home Appliances",
		'73000000' => "Kitchen Merchandise",	
		'74000000' => "Camping",	
		'75000000' => "Household/Office Furniture/Furnishings",	 
		'77000000' => "Automotive",	
		'78000000' => "Electrical Supplies",	
		'79000000' => "Plumbing/Heating/Ventilation/Air Conditioning",	
		'80000000' => "Tools/Equipment - Hand",		 
		'81000000' => "Lawn/Garden Supplies",	
		'82000000' => "Tools/Equipment - Power",		 
		'83000000' => "Building Products",	
		'84000000' => "Tool Storage/Workshop Aids",
		'85000000' => "Safety/Protection - DIY",	
		'86000000' => "Toys/Games",
		'87000000' => "Fuels",	 
		'88000000' => "Lubricants",		 
		'89000000' => "Live Animals",	
		'91000000' => "Safety/Security/Surveillance",		 
		'92000000' => "Storage/Haulage Containers"
	);
	
	$SQL = "SELECT count(*) as NB FROM gtin";
	$DataSet = mysql_query($SQL);	
	$Record = mysql_fetch_array($DataSet);
	$NbTotal = $Record["NB"];
		
	$SQL = "SELECT gpc_s_cd, count(*) as NB FROM gtin group by gpc_s_cd";
	$DataSet = mysql_query($SQL);	
	$Number = mysql_num_rows($DataSet);
	$i = 1;
	While ($Record = mysql_fetch_array($DataSet)) {	
	
		$gpc_s_cd	 		= $Record["gpc_s_cd"];
		if($gpc_s_cd == '') $gpc_s_cd = "unassigned";
		$Nb 			= $Record["NB"]; 
		
		if($i < $Number) {
		
			$VALUE_PIE 		.= $GRAPHE_Separateur."['".$gpc_s_cd." <br/> (".number_format($Nb, 0, '.', ' ').")', ".number_format(100*($Nb/$NbTotal), 0, '.', ' ')."]"; 
			$List[$gpc_s_cd]["cd"]		 = $gpc_s_cd;
			$List[$gpc_s_cd]["nm"]		 = $Segments[$gpc_s_cd];
			$PERC = $PERC + number_format(100*($Nb/$NbTotal), 0, '.', ' ');
			$GRAPHE_Separateur 	= ",";
			
		} else {
			
			$VALUE_PIE 		.= $GRAPHE_Separateur."['".$gpc_s_cd." <br/> (".number_format($Nb, 0, '.', ' ').")', ".(100 - $PERC)."]"; 
			$List[$gpc_s_cd]["cd"]		 = $gpc_s_cd;
			$List[$gpc_s_cd]["nm"]		 = $Segments[$gpc_s_cd];
			$GRAPHE_Separateur 	= ",";					
		}
		
		$i ++;
		
	} // while
	
	$h1 = "<b>GTIN</b> - GPC Segment";
	$titre = "<b>GTIN</b> - GPC Segment (".number_format($NbTotal, 0, '', ' ')." codes)";	
	
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
					
						
	$FileName 	= $DataFolder."stats-pie-2.html";
	$file = fopen($FileName, 'w');
	fputs($file, $Corps);
	fclose($file); 
	
	echo "File generated<hr/>";
	


?>