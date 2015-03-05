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


	$Corps .= 	Template("template-stats-gcp-length",1,$Params=array(
	));	
					
	$SQL = "SELECT substring(A.gcp_cd,1,3) as prefix, length(A.GCP_CD) as length, count(A.GCP_CD) as nb, count(distinct (case when A.return_code = 0 > 0 then A.GCP_CD end)) as nb2, B.prefix_nm, B.country_iso_cd as country FROM `gs1_gcp` A, gs1_prefix B where substring(A.gcp_cd,1,3) = B.prefix_cd and B.country_iso_cd <>'' group by substring(A.gcp_cd,1,3), length(A.gcp_cd)";
	$DataSet = mysql_query($SQL);	
	While ($Record = mysql_fetch_array($DataSet)) {	
						
			$prefix 		= $Record["prefix"];	
			$length 		= $Record["length"];
			$nb_num 		= $Record["nb"];
			$nb_rc_0 		= $Record["nb2"];
			$prefix_nm 		= $Record["prefix_nm"];
			$country 		= $Record["country"];
			
			$SQL = "SELECT gcp_nb from gs1_gcp_nb where prefix_cd = '".$prefix."' and gcp_length = ".$length;
			$DataSet2 = mysql_query($SQL);	
			$Record2 = mysql_fetch_array($DataSet2);
			
			$gcp_nb 		= $Record2["gcp_nb"];
			
			$nb_max_product = pow(10,12 - $length);
			$perc_num 		= $nb_rc_0 / $nb_num * 100;
			
			$perc			= number_format($perc_num, 2, '.', ' ');
			$nb 			= number_format($nb_num, 0, '.', ' ');
			$nb_rc_0  		= number_format($nb_rc_0 , 0, '.', ' ');
			$nb_max_product = number_format($nb_max_product , 0, '.', ' ');
							
			if($gcp_nb == $nb_num) { // if all gcp have been checked, green background
				$style_nb = 		'background-color:rgb(190, 247, 190);';
			} else {
				if($length > 7) {
					$style_nb = 		'background-color:rgb(213, 211, 211);';
				} else {
					$style_nb = 		'';
				}
			}
			
			if($perc_num > 2) {
				$style_perc = 		'';
			} else {
				$style_perc = 		'color:red;';
			}

			$Corps .= 	Template("template-stats-gcp-length",2,$Params=array(
				"VALUE_PREFIX"			=> $prefix,
				"VALUE_LENGTH"			=> $length,
				"VALUE_NB_NUM"			=> $nb_num,
				"VALUE_NB"				=> $nb,
				"VALUE_NB_RC_0"			=> $nb_rc_0,
				"VALUE_PREFIX_NM"		=> $prefix_nm,
				"VALUE_COUNTRY"			=> $country,
				"VALUE_GCP_NB"			=> $gcp_nb,
				"VALUE_NB_MAX_PRODUCT"	=> $nb_max_product,
				"VALUE_PERC_NUM"		=> $perc_num,
				"VALUE_PERC"			=> $perc,
				"VALUE_STYLE_NB"		=> $style_nb,
				"VALUE_STYLE_PERC"		=> $style_perc,
				"VALUE_IMG_COUNTRY"		=> DOSSIER_IMG_COUNTRY.strtolower($country)
			));

			
		}
						
	$Corps .= 	Template("template-stats-gcp-length",3,$Params=array(
	));	

	$FileName 	= $DataFolder."stats-gcp-length.html";
	$file = fopen($FileName, 'w');
	fputs($file, $Corps);
	fclose($file); 
	
	echo "File generated<hr/>";
	


?>