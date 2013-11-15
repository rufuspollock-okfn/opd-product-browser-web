<?php header("Content-Type: text/html; charset=utf-8");

	// -----------------------------------------------------------------------------------------------------------
	// On inclue les fichiers de contexte
	// -----------------------------------------------------------------------------------------------------------
	
	require("../secret/connexion.php");
	require("fonctions.php");
	
	// -----------------------------------------------------------------------------------------------------------
	// Déclaration des variables
	// -----------------------------------------------------------------------------------------------------------
	
	$URL_Base = "http://www.product-open-data.com/";
	// -----------------------------------------------------------------------------------------------------------	
	// Traitement
	// -----------------------------------------------------------------------------------------------------------
	
	$SQL = "SELECT distinct gpc_b_cd FROM gtin where gpc_b_cd is not null";
	$DataSet_liste_gln = mysql_query($SQL);	
	While ($Record_liste_gln = mysql_fetch_array($DataSet_liste_gln)) {	
	
		$Corps = "";
	
		$GPC_B_CD 	= $Record_liste_gln["gpc_b_cd"];
		//$GPC_B_CD = '10000308'; // 10000308 - 10005830

		$FileName 						= "../../POD-Website/data/product-gpc-".$GPC_B_CD;
	
		$Corps .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	
		$Corps .= 	Template("template_gpc_xml",1,$Params=array(
		));							
				
		$SQL = "select * from gtin where gpc_b_cd = '".$GPC_B_CD."'";
		$DataSet 	= mysql_query($SQL);
		While($Record 	= mysql_fetch_array($DataSet)) {		
							
			$GTIN_CD 					= $Record["GTIN_CD"];									
			$GTIN_NM 					= $Record["GTIN_NM"];
			
			$GCP_CD 					= $Record["GCP_CD"];
			$BRAND_CD 					= $Record["BRAND_CD"];

			$SQL = "select * from brand where brand_cd = '".$BRAND_CD."'";
			$DataSet_BRAND 	= mysql_query($SQL);
			$Record_BRAND 	= mysql_fetch_array($DataSet_BRAND);
			
			$BRAND_NM 					= $Record_BRAND["BRAND_NM"];
			
			$PL_NM						= $Record["PRODUCT_LINE"];
			
			$GTIN_M_G 					= $Record["M_G"];
			$GTIN_M_OZ 					= $Record["M_OZ"];
			$GTIN_M_ML 					= $Record["M_ML"];
			$GTIN_M_FLOZ 				= $Record["M_FLOZ"];
			$GTIN_M_ABV 				= $Record["M_ABV"];
			$GTIN_M_ABW 				= $Record["M_ABW"];
			
			$GTIN_PKG_UNIT 				= $Record["PKG_UNIT"];
			
			$GTIN_IMG					= $URL_Base."images/gtin/gtin-".substr($GTIN_CD,0,3)."/".$GTIN_CD.".jpg";
			
			$Corps .= 	Template("template_gpc_xml",2,$Params=array(
				"VALUE_GTIN_CD"					=> $GTIN_CD,
				"VALUE_GTIN_NM"					=> $GTIN_NM,
				"VALUE_GCP_CD"					=> $GCP_CD,
				
				"VALUE_BRAND_NM"				=> $BRAND_NM,
				"VALUE_PL_NM"					=> $PL_NM,
				
				"VALUE_M_G"						=> $GTIN_M_G,
				"VALUE_M_OZ"					=> $GTIN_M_OZ,
				"VALUE_M_ML"					=> $GTIN_M_ML,
				"VALUE_M_FLOZ"					=> $GTIN_M_FLOZ,
				"VALUE_M_ABV"					=> $GTIN_M_ABV,
				"VALUE_M_ABW"					=> $GTIN_M_ABW,
				"VALUE_PKG_UNIT"				=> $GTIN_PKG_UNIT,
				
				"VALUE_GTIN_IMG"				=> $GTIN_IMG
			));										
		
		} // while
					
		$Corps .= 	Template("template_gpc_xml",3,$Params=array(
		));	
		
		$Corps = str_replace('&','&amp;',$Corps);
			
		$file = fopen($FileName.".xml", 'w');
		fputs($file, $Corps);
		fclose($file); 
		echo $GPC_B_CD." -> Fichier généré<hr/>";
		ob_flush();
		flush();	

	} // while
	
	//----------------------------------------------------------------------------
	// List ----------------------------------------------------------------------
	//
	
	$FileName 						= "../../POD-Website/data/product-gpc-list";
	$Corps = "";
	$Corps .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	
	$Corps .= 	Template("template_gpc_list_xml",1,$Params=array(
	));	

	$SQL = "SELECT gpc_s_cd, gpc_f_cd, gpc_c_cd, gpc_b_cd FROM gtin where gpc_b_cd is not null group by gpc_b_cd order by gpc_s_cd, gpc_f_cd, gpc_c_cd, gpc_b_cd";
	$DataSet_liste_gpc = mysql_query($SQL);	
	While ($Record_liste_gpc = mysql_fetch_array($DataSet_liste_gpc)) {	
		
		$GPC_S_CD 	= $Record_liste_gpc["gpc_s_cd"];		
		$GPC_F_CD 	= $Record_liste_gpc["gpc_f_cd"];
		$GPC_C_CD 	= $Record_liste_gpc["gpc_c_cd"];	
		$GPC_B_CD 	= $Record_liste_gpc["gpc_b_cd"];

// -------------- FERMETURE -------------------------------				

					/*
					if($PREVIOUS_GPC_S_CD == '') $PREVIOUS_GPC_S_CD = $GPC_S_CD;
					if($PREVIOUS_GPC_F_CD == '') $PREVIOUS_GPC_F_CD = $GPC_F_CD;
					if($PREVIOUS_GPC_C_CD == '') $PREVIOUS_GPC_C_CD = $GPC_C_CD;
					*/
					if( ($GPC_C_CD  != $PREVIOUS_GPC_C_CD ) && ($PREVIOUS_GPC_C_CD != ""))  {
						$Corps .= 	Template("template_gpc_list_xml",8,$Params=array(
						));		
		
					} // if
	
				if(($GPC_F_CD  != $PREVIOUS_GPC_F_CD) && ($PREVIOUS_GPC_F_CD != "") )  {
					$Corps .= 	Template("template_gpc_list_xml",6,$Params=array(
					));	
				
				} // if
			
			
			if(($GPC_S_CD  != $PREVIOUS_GPC_S_CD) && ($PREVIOUS_GPC_S_CD != "") )  {
				echo $GPC_S_CD." | ".$PREVIOUS_GPC_S_CD; 
				$Corps .= 	Template("template_gpc_list_xml",4,$Params=array(
				));					
			} // if
			
// -------------- Ouverture -------------------------------	

			if($GPC_S_CD  != $PREVIOUS_GPC_S_CD )  {
				
				$i_s = 1;	

				$GPC_CD = $GPC_S_CD;
				$SQL = "select gpc_nm from gpc where gpc_cd = '".$GPC_CD."' and gpc_lang = 'EN'";
				$DataSet 	= mysql_query($SQL);
				$Record 	= mysql_fetch_array($DataSet);	
				$GPC_NM 		= $Record["gpc_nm"];	
				
				$Corps .= 	Template("template_gpc_list_xml",3,$Params=array(
					"VALUE_GPC_CD"					=> $GPC_CD,
					"VALUE_GPC_NM"					=> $GPC_NM
				));
								
			} // if
			
				if($GPC_F_CD  != $PREVIOUS_GPC_F_CD )  {
	
					$GPC_CD = $GPC_F_CD;
					$SQL = "select gpc_nm from gpc where gpc_cd = '".$GPC_CD."' and gpc_lang = 'EN'";
					$DataSet 	= mysql_query($SQL);
					$Record 	= mysql_fetch_array($DataSet);	
					$GPC_NM 		= $Record["gpc_nm"];	
					
					$Corps .= 	Template("template_gpc_list_xml",5,$Params=array(
						"VALUE_GPC_CD"					=> $GPC_CD,
						"VALUE_GPC_NM"					=> $GPC_NM
					));
									
				} // if
				
					if($GPC_C_CD  != $PREVIOUS_GPC_C_CD )  {
								
						$GPC_CD = $GPC_C_CD;
						$SQL = "select gpc_nm from gpc where gpc_cd = '".$GPC_CD."' and gpc_lang = 'EN'";
						$DataSet 	= mysql_query($SQL);
						$Record 	= mysql_fetch_array($DataSet);	
						$GPC_NM 		= $Record["gpc_nm"];	
						
						$Corps .= 	Template("template_gpc_list_xml",7,$Params=array(
							"VALUE_GPC_CD"					=> $GPC_CD,
							"VALUE_GPC_NM"					=> $GPC_NM
						));
										
					} // if
					
						if($GPC_B_CD  != $PREVIOUS_GPC_B_CD )  {
			
							$GPC_CD = $GPC_B_CD;
							$SQL = "select gpc_nm from gpc where gpc_cd = '".$GPC_CD."' and gpc_lang = 'EN'";
							$DataSet 	= mysql_query($SQL);
							$Record 	= mysql_fetch_array($DataSet);	
							$GPC_NM 		= $Record["gpc_nm"];	
							
							$Corps .= 	Template("template_gpc_list_xml",9,$Params=array(
								"VALUE_GPC_CD"					=> $GPC_CD,
								"VALUE_GPC_NM"					=> $GPC_NM
							));
											
						} // if



			
			$PREVIOUS_GPC_S_CD = $GPC_S_CD;	
			$PREVIOUS_GPC_F_CD = $GPC_F_CD;	
			$PREVIOUS_GPC_C_CD = $GPC_C_CD;	
			$PREVIOUS_GPC_B_CD = $GPC_B_CD;	
			//break;													

	} // while
	
			$Corps .= 	Template("template_gpc_list_xml",8,$Params=array(
			));		

		$Corps .= 	Template("template_gpc_list_xml",6,$Params=array(
		));	

	$Corps .= 	Template("template_gpc_list_xml",4,$Params=array(
	));			

	$Corps .= 	Template("template_gpc_list_xml",2,$Params=array(
	));	
		
	$Corps = str_replace('&','&amp;',$Corps);
		
	$file = fopen($FileName.".xml", 'w');
	fputs($file, $Corps);
	fclose($file); 
	echo $GPC_B_CD." -> Fichier généré<hr/>";
	ob_flush();
	flush();	


	
?>