<?php header("Content-Type: text/html; charset=utf-8");

	// -----------------------------------------------------------------------------------------------------------
	// On inclue les fichiers de contexte
	// -----------------------------------------------------------------------------------------------------------
	
	require("../secret/connexion.php");
	require("../fonctions.php");
	
	// -----------------------------------------------------------------------------------------------------------
	// Déclaration des variables
	// -----------------------------------------------------------------------------------------------------------
	
	$DataFolder = "../cache/";	
	
	// -----------------------------------------------------------------------------------------------------------	
	// Traitement
	// -----------------------------------------------------------------------------------------------------------


	$SQL = "SELECT * FROM gs1_prefix where country_iso_cd <> 'WW' and country_iso_cd <> '' ";
	$DataSet_registration = mysql_query($SQL);	
	While ($Record_registration = mysql_fetch_array($DataSet_registration)) {
		$Prefixe_cd =$Record_registration["PREFIX_CD"];
		$registration[$Prefixe_cd]["C"] = $Record_registration["COUNTRY_ISO_CD"];
		$registration[$Prefixe_cd]["N"] = $Record_registration["PREFIX_NM"];
	}
	
	//$SQL = "SELECT * FROM brand where brand_cd = 46";
	//$SQL = "SELECT * FROM brand where brand_nm like 'canada%'";
	$SQL = "SELECT * FROM brand";
	$DataSet_liste_brand = mysql_query($SQL);	
	While ($Record_liste_brand = mysql_fetch_array($DataSet_liste_brand)) {	
	
		$Corps = "";
	
		$BRAND_CD 			= $Record_liste_brand["BRAND_CD"];
		$BSIN 				= $Record_liste_brand["BSIN"];
		$BRAND_NM 			= $Record_liste_brand["BRAND_NM"];
		$BRAND_TYPE_CD 		= $Record_liste_brand["BRAND_TYPE_CD"];
		$BRAND_LINK 		= $Record_liste_brand["BRAND_LINK"];
		$OWNER_CD 			= $Record_liste_brand["OWNER_CD"];
		
		$SQL = "SELECT * FROM brand_type where brand_type_cd =".$BRAND_TYPE_CD;
		$DataSet_liste_brand_type = mysql_query($SQL);	
		$Record_liste_brand_type = mysql_fetch_array($DataSet_liste_brand_type);
		
		$BRAND_TYPE_NM = $Record_liste_brand_type["BRAND_TYPE_NM"];
		
		if($OWNER_CD != "") {
			$SQL = "SELECT * FROM brand_owner where OWNER_CD =".$OWNER_CD;
			$DataSet_owner = mysql_query($SQL);	
			$Record_owner = mysql_fetch_array($DataSet_owner);
			
			$OWNER_NM = $Record_owner["OWNER_NM"];
		} else {
			$OWNER_NM = "";
		}

					
		$Corps .= 	Template("template_list_brand_item",1,$Params=array(
			"VALUE_BRAND_IMG"		=> "brand/".$BSIN.".jpg",
			"VALUE_BRAND_NM"		=> $BRAND_NM,
			"VALUE_BSIN"			=> $BSIN,
			"VALUE_BRAND_TYPE_NM"	=> $BRAND_TYPE_NM,
			"VALUE_BRAND_LINK"		=> $BRAND_LINK,
			"VALUE_OWNER_CD"		=> $OWNER_CD,
			"VALUE_OWNER_NM"		=> $OWNER_NM
		));		
				
		$SQL = "select * from gtin A, gs1_prefix B where left(A.GTIN_CD,3) = B.PREFIX_CD and brand_cd =".$BRAND_CD." order by B.COUNTRY_ISO_CD, A.product_line desc, A.gtin_nm, A.pkg_unit, A.m_g, A.m_oz, A.m_ml, A.m_floz";
		$DataSet 	= mysql_query($SQL);
		While($Record 	= mysql_fetch_array($DataSet)) {		
							
			$GTIN_CD 					= $Record["GTIN_CD"];									
			$GTIN_NM 					= $Record["GTIN_NM"];
			
			$GTIN_REG_C					= $registration[substr($GTIN_CD,0,3)]["C"];
			$GTIN_REG_N					= $registration[substr($GTIN_CD,0,3)]["N"];
			
			$GCP_CD 					= $Record["GCP_CD"];
			
			$GPC_S_CD 					= $Record["GPC_S_CD"];
				
		
			$GPC_S_NM 					= $Record["GPC_S_NM"];
			
			$PL_NM						= $Record["PRODUCT_LINE"];
			
			$GTIN_M_G 					= $Record["M_G"];
			$GTIN_M_OZ 					= $Record["M_OZ"];
			$GTIN_M_ML 					= $Record["M_ML"];
			$GTIN_M_FLOZ 				= $Record["M_FLOZ"];
			$GTIN_M_ABV 				= $Record["M_ABV"];
			$GTIN_M_ABW 				= $Record["M_ABW"];
			
			$GTIN_PKG_UNIT 				= $Record["PKG_UNIT"];
			
			$GTIN_IMG					= "gtin/gtin-".substr($GTIN_CD,0,3)."/".$GTIN_CD.".jpg";
			
			$SQL = "select * from nutrition_us where GTIN_CD = '".$GTIN_CD."'";
			$DataSet_NUS 	= mysql_query($SQL);
			$NUTRI_FLAG = mysql_num_rows($DataSet_NUS) ;	
			
			if(substr($GTIN_CD,0,1) == "0") {
				//echo $GTIN_CD;
				$UPC_CD = substr($GTIN_CD,1,12);
				$HTML_UPC_CD = " / UPC ".$UPC_CD;
			} else {
				$HTML_UPC_CD = "";
			}

					
			$Corps .= 	Template("template_list_brand_item",2,$Params=array(
				"VALUE_GTIN_CD"					=> $GTIN_CD,
				"VALUE_UPC_CD"					=> $HTML_UPC_CD,
				"VALUE_GTIN_NM"					=> $GTIN_NM,
				"VALUE_GCP_CD"					=> $GCP_CD,
				
				"VALUE_GPC_S_IMG" 				=> $GPC_S_IMG,	
				"VALUE_GPC_S_NM" 				=> $GPC_S_NM,	
				
				
				"VALUE_REG_N"					=> $REG_N,
				"VALUE_REG_C"					=> $REG_C,
				
				"VALUE_BRAND_NM"				=> $BRAND_NM,
				"VALUE_PRODUCT_LINE"			=> $GTIN_PRODUCT_LINE,
				
				"VALUE_M_G"						=> $GTIN_M_G,
				"VALUE_M_OZ"					=> $GTIN_M_OZ,
				"VALUE_M_ML"					=> $GTIN_M_ML,
				"VALUE_M_FLOZ"					=> $GTIN_M_FLOZ,
				"VALUE_M_ABV"					=> $GTIN_M_ABV,
				"VALUE_M_ABW"					=> $GTIN_M_ABW,
				"VALUE_PKG_UNIT"				=> $GTIN_PKG_UNIT,
				
				"VALUE_NUTRI_FLAG"				=> $NUTRI_FLAG,
				
				"VALUE_GTIN_IMG"				=> $GTIN_IMG
				
				
			));											
		
		} // while
					
		
		$Corps .= 	Template("template_list_brand_item",3,$Params=array(
		));	
		
		$FileName 	= $DataFolder."product-brand-".str_pad($BRAND_CD,8,"0",STR_PAD_LEFT).".html";
		$file = fopen($FileName, 'w');
		fputs($file, $Corps);
		fclose($file); 
		
		echo "File generated : ".$BRAND_NM."<hr/>";
		
		ob_flush();
		flush();	

	} // while


	
?>