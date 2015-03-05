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
	
	$SQL = "SELECT * FROM pss";
	$DataSet_liste_gln = mysql_query($SQL);	
	While ($Record_liste_gln = mysql_fetch_array($DataSet_liste_gln)) {	
	
		$Corps = "";
	
		$GLN_CD 	= $Record_liste_gln["gln_cd"];
		$PSS_NM 	= $Record_liste_gln["pss_nm"];

		$FileName 						= "../../POD-Website/pss/pss-gln-".$GLN_CD;
	
		$Corps .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	
		$Corps .= 	Template("template_pss_xml",1,$Params=array(
			"VALUE_PSS_NM"					=> $PSS_NM,
			"VALUE_PSS_DESC"				=> "Product list collected by product-open-data.com",
			"VALUE_PSS_LANG"				=> "fr",
			"VALUE_PSS_PUB_DT"				=> date(DATE_RSS),
			"VALUE_PSS_LB_DT"				=> date(DATE_RSS),
			"VALUE_PSS_ME_MAIL"				=> "pss@product-open-data.com",
			"VALUE_PSS_WM_MAIL"				=> "pss@product-open-data.com"		
		));
	
		// GLN LIST
		$DataSet_GLN = mysql_query("SELECT * FROM gcp where GLN_CD = '".$GLN_CD."'");
		$Record_GLN = mysql_fetch_array($DataSet_GLN);
	
			$GLN_RETURN_CODE 			= $Record_GLN["RETURN_CODE"];
			$GLN_NM 					= $Record_GLN["GLN_NM"];
			$GLN_ADDR_02 				= $Record_GLN["GLN_ADDR_02"];
			$GLN_ADDR_03 				= $Record_GLN["GLN_ADDR_03"];
			$GLN_ADDR_04 				= $Record_GLN["GLN_ADDR_04"];
			$GLN_ADDR_POSTALCODE 		= $Record_GLN["GLN_ADDR_POSTALCODE"];
			$GLN_ADDR_CITY 				= $Record_GLN["GLN_ADDR_CITY"];
			$GLN_COUNTRY_ISO_CD 		= $Record_GLN["GLN_COUNTRY_ISO_CD"];
			
			$GLN_IMG 					= $URL_Base."images/gln/".$GLN_CD.".jpg";
			
			$Corps .= 	Template("template_pss_xml",3,$Params=array(
				"VALUE_GLN_RETURN_CODE"			=> $GLN_RETURN_CODE,
	
				"VALUE_GLN_CD"					=> $GLN_CD,
				"VALUE_GLN_NM"					=> $GLN_NM,
				"VALUE_GLN_ADDR_02"				=> $GLN_ADDR_02,
				"VALUE_GLN_ADDR_03"				=> $GLN_ADDR_03,
				"VALUE_GLN_ADDR_04"				=> $GLN_ADDR_04,
				"VALUE_GLN_ADDR_POSTALCODE"		=> $GLN_ADDR_POSTALCODE,
				"VALUE_GLN_ADDR_CITY"			=> $GLN_ADDR_CITY,
				"VALUE_GLN_COUNTRY_ISO_CD"		=> $GLN_COUNTRY_ISO_CD,
				
				"VALUE_GLN_IMG"					=> $GLN_IMG
			));
	
			// BRAND LIST
			$DataSet_GLN = mysql_query("SELECT * FROM gcp where GLN_CD = '".$GLN_CD."'");
			While($Record_GLN = mysql_fetch_array($DataSet_GLN)) {				
	
				$GCP_CD 					= $Record_GLN["GCP_CD"];			
	
				$SQL = "SELECT distinct brand_cd FROM gtin where gcp_cd = '".$GCP_CD."'";
				$DataSet_BRAND = mysql_query($SQL);
				While($Record_BRAND = mysql_fetch_array($DataSet_BRAND)) {

					$BRAND_CD					= $Record_BRAND["brand_cd"];	
					
					if($BRAND_CD != '') {
						$SQL = "SELECT * FROM brand where brand_cd = ".$BRAND_CD;
						$DataSet_BRAND2 = mysql_query($SQL);
						$Record_BRAND2 = mysql_fetch_array($DataSet_BRAND2);
					
						$BRAND_NM					= $Record_BRAND2["BRAND_NM"];
						$BRAND_TYPE_CD			    = $Record_BRAND2["BRAND_TYPE_CD"];
						$BRAND_LINK					= trim($Record_BRAND2["BRAND_LINK"]);
						
						$BRAND_IMG					= $URL_Base."images/brand/".str_pad($BRAND_CD,8,"0",STR_PAD_LEFT).".jpg";
						
						if($BRAND_TYPE_CD != '') {
							$SQL = "SELECT * FROM brand_type where brand_type_cd = ".$BRAND_TYPE_CD;
							$DataSet_BRAND_TYPE = mysql_query($SQL);
							$Record_BRAND_TYPE = mysql_fetch_array($DataSet_BRAND_TYPE);
				
							$BRAND_TYPE_NM					= trim($Record_BRAND_TYPE["BRAND_TYPE_NM"]);
		
							$Corps .= Template("template_pss_xml",5,$Params=array(
								"VALUE_GCP_CD"					=> $GCP_CD,
								"VALUE_BRAND_CD"				=> $BRAND_CD,	
								"VALUE_BRAND_NM"				=> $BRAND_NM,	
								"VALUE_BRAND_TYPE_NM"			=> $BRAND_TYPE_NM,
								"VALUE_BRAND_LINK"				=> $BRAND_LINK,
								"VALUE_BRAND_IMG"				=> $BRAND_IMG
							));
						}

					
					
						// ITEM LIST
					
						$SQL = "select * from gtin where gcp_cd = '".$GCP_CD."' and brand_cd = ".$BRAND_CD." and gtin_level_cd=1 order by  product_line, pkg_unit, m_g, m_oz, m_ml, m_floz, gtin_nm";
						$DataSet 	= mysql_query($SQL);
						While($Record 	= mysql_fetch_array($DataSet)) {		
											
							$GTIN_CD 					= $Record["GTIN_CD"];									
							$GTIN_NM 					= $Record["GTIN_NM"];
							
							$PL_NM						= $Record["PRODUCT_LINE"];
							
							$GTIN_M_G 					= $Record["M_G"];
							$GTIN_M_OZ 					= $Record["M_OZ"];
							$GTIN_M_ML 					= $Record["M_ML"];
							$GTIN_M_FLOZ 				= $Record["M_FLOZ"];
							$GTIN_M_ABV 				= $Record["M_ABV"];
							$GTIN_M_ABW 				= $Record["M_ABW"];
							
							$GTIN_PKG_UNIT 				= $Record["PKG_UNIT"];
							
							$GTIN_IMG					= $URL_Base."images/gtin/gtin-".substr($GTIN_CD,0,3)."/".$GTIN_CD.".jpg";
							
							$Corps .= 	Template("template_pss_xml",7,$Params=array(
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
						
						$Corps .= 	Template("template_pss_xml",6,$Params=array(
						));	
					
					} // if						
				
				
				} // while
					
			
			} // while		
	
	
	
	
		$Corps .= 	Template("template_pss_xml",4,$Params=array(
		));
		
		
		$Corps .= 	Template("template_pss_xml",2,$Params=array(
		));	
		
		$Corps = str_replace('&','&amp;',$Corps);
			
		$file = fopen($FileName.".xml", 'w');
		fputs($file, $Corps);
		fclose($file); 
		echo $PSS_NM ;
		echo "<br/>Fichier généré<hr/>";
		ob_flush();
		flush();	

	} // while
?>