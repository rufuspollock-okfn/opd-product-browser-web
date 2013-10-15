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
	$generate_brand_items = 1;
	$DataFolder = "../";
	
	
	// -----------------------------------------------------------------------------------------------------------	
	// Traitement
	// -----------------------------------------------------------------------------------------------------------
	
	if($generate_brand_items == 1) {

		$SQL = "SELECT * FROM gs1_prefix where country_iso_cd <> 'WW' and country_iso_cd <> '' ";
		$DataSet_registration = mysql_query($SQL);	
		While ($Record_registration = mysql_fetch_array($DataSet_registration)) {
			$Prefixe_cd =$Record_registration["PREFIX_CD"];
			$registration[$Prefixe_cd]["C"] = $Record_registration["COUNTRY_ISO_CD"];
			$registration[$Prefixe_cd]["N"] = $Record_registration["PREFIX_NM"];
		}
		
		//$SQL = "SELECT * FROM brand where brand_cd = 46";
		$SQL = "SELECT * FROM brand where brand_nm like 'bush%'";
		//$SQL = "SELECT * FROM brand";
		$DataSet_liste_brand = mysql_query($SQL);	
		While ($Record_liste_brand = mysql_fetch_array($DataSet_liste_brand)) {	
		
			$Corps = "";
		
			$BRAND_CD 			= $Record_liste_brand["BRAND_CD"];
			$BRAND_NM 			= $Record_liste_brand["BRAND_NM"];
			$BRAND_TYPE_CD 		= $Record_liste_brand["BRAND_TYPE_CD"];
			$BRAND_LINK 		= $Record_liste_brand["BRAND_LINK"];
			$GROUP_CD 			= $Record_liste_brand["GROUP_CD"];
			
			$SQL = "SELECT * FROM brand_type where brand_type_cd =".$BRAND_TYPE_CD;
			$DataSet_liste_brand_type = mysql_query($SQL);	
			$Record_liste_brand_type = mysql_fetch_array($DataSet_liste_brand_type);
			
			$BRAND_TYPE_NM = $Record_liste_brand_type["BRAND_TYPE_NM"];
			
			if($GROUP_CD != "") {
				$SQL = "SELECT * FROM brand_group where GROUP_CD =".$GROUP_CD;
				$DataSet_group = mysql_query($SQL);	
				$Record_group = mysql_fetch_array($DataSet_group);
				
				$GROUP_NM = $Record_group["GROUP_NM"];
			} else {
				$GROUP_NM = "";
			}
	
			$FileName 						= $DataFolder."data/product-brand-".str_pad($BRAND_CD,8,"0",STR_PAD_LEFT);
		
			$Corps .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
		
			$Corps .= 	Template("template_brand_xml",1,$Params=array(
				"VALUE_BRAND_CD" 		=> $BRAND_CD,
				"VALUE_BRAND_NM" 		=> $BRAND_NM,
				"VALUE_BRAND_TYPE_NM" 	=> $BRAND_TYPE_NM,
				"VALUE_BRAND_IMG"		=> $URL_Base."images/brand/".str_pad($BRAND_CD,8,"0",STR_PAD_LEFT).".jpg",
				"VALUE_BRAND_LINK" 		=> $BRAND_LINK,
				"VALUE_GROUP_CD" 		=> $GROUP_CD,
				"VALUE_GROUP_NM" 		=> $GROUP_NM
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
				
				$GTIN_IMG					= $URL_Base."images/gtin/gtin-".substr($GTIN_CD,0,3)."/".$GTIN_CD.".jpg";
				$GPC_S_IMG					= $URL_Base."images/gpc/".$GPC_S_CD .".jpg";
				
				$SQL = "select * from nutrition_us where GTIN_CD = '".$GTIN_CD."'";
				$DataSet_NUS 	= mysql_query($SQL);
				$NUTRI_FLAG = mysql_num_rows($DataSet_NUS) ;	
				
				$Corps .= 	Template("template_brand_xml",2,$Params=array(
					"VALUE_GTIN_CD"					=> $GTIN_CD,
					"VALUE_GTIN_NM"					=> $GTIN_NM,
					"VALUE_GCP_CD"					=> $GCP_CD,
					
					"VALUE_GPC_S_IMG" 				=> $GPC_S_IMG,
					"VALUE_GPC_S_NM" 				=> $GPC_S_NM,
					
					"VALUE_REG_C"					=> $GTIN_REG_C,
					"VALUE_REG_N"					=> $GTIN_REG_N,
					
					"VALUE_BRAND_NM"				=> $BRAND_NM,
					"VALUE_PL_NM"					=> $PL_NM,
					
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
						
			$Corps .= 	Template("template_brand_xml",3,$Params=array(
			));	
			
			$Corps = str_replace('&','&amp;',$Corps);
				
			$file = fopen($FileName.".xml", 'w');
			fputs($file, $Corps);
			fclose($file); 
			echo $BRAND_NM." -> Fichier généré<hr/>";
			ob_flush();
			flush();	
	
		} // while
	
	} // if 
	
	//exit;
	
	//----------------------------------------------------------------------------
	// List ----------------------------------------------------------------------
	//

	$i = 1;
	foreach(range('a','z') as $lettre) {

		$FileName 						= $DataFolder."data/product-brand-list-".$i;
		$Corps = "";
		$Corps .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
		
		$Corps .= 	Template("template_brand_list_xml",1,$Params=array(
		));	
	
		$SQL = "SELECT * FROM BRAND where left(brand_nm,1) = '".$lettre."' order by brand_nm";
		$DataSet_liste_brand = mysql_query($SQL);	
		While ($Record_liste_brand = mysql_fetch_array($DataSet_liste_brand)) {	
		
			$BRAND_CD 			= $Record_liste_brand["BRAND_CD"];
			$BRAND_NM 			= $Record_liste_brand["BRAND_NM"];
			$BRAND_TYPE_CD 		= $Record_liste_brand["BRAND_TYPE_CD"];
			$BRAND_LINK 		= $Record_liste_brand["BRAND_LINK"];
	
			$SQL = "SELECT * FROM BRAND_TYPE where BRAND_TYPE_CD =".$BRAND_TYPE_CD;
			$DataSet_brand_type = mysql_query($SQL);	
			$Record_brand_type = mysql_fetch_array($DataSet_brand_type);	
			
			$BRAND_TYPE_NM = $Record_brand_type["BRAND_TYPE_NM"];
	
			$Corps .= 	Template("template_brand_list_xml",2,$Params=array(
				"VALUE_BRAND_CD" 		=> $BRAND_CD,
				"VALUE_BRAND_NM" 		=> $BRAND_NM,
				"VALUE_BRAND_TYPE_NM" 	=> $BRAND_TYPE_NM,
				"VALUE_BRAND_LINK" 		=> $BRAND_LINK	
			));	
	
		}
	
		$Corps .= 	Template("template_brand_list_xml",3,$Params=array(
		));	
			
		$Corps = str_replace('&','&amp;',$Corps);
			
		$file = fopen($FileName.".xml", 'w');
		fputs($file, $Corps);
		fclose($file); 
		echo $GPC_B_CD." -> Fichier généré<hr/>";
		ob_flush();
		flush();	
		
		$i++;
	
	} // foreach

		$FileName 						= $DataFolder."data/product-brand-list-27";
		$Corps = "";
		$Corps .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
		
		$Corps .= 	Template("template_brand_list_xml",1,$Params=array(
		));	
	
		$SQL = "SELECT * FROM BRAND where left(brand_nm,1) in ('0','1','2','3','4','5','6','7','8','9') order by brand_nm";
		$DataSet_liste_brand = mysql_query($SQL);	
		While ($Record_liste_brand = mysql_fetch_array($DataSet_liste_brand)) {	
		
			$BRAND_CD 			= $Record_liste_brand["BRAND_CD"];
			$BRAND_NM 			= $Record_liste_brand["BRAND_NM"];
			$BRAND_TYPE_CD 		= $Record_liste_brand["BRAND_TYPE_CD"];
			$BRAND_LINK 		= $Record_liste_brand["BRAND_LINK"];
	
			$SQL = "SELECT * FROM BRAND_TYPE where BRAND_TYPE_CD =".$BRAND_TYPE_CD;
			$DataSet_brand_type = mysql_query($SQL);	
			$Record_brand_type = mysql_fetch_array($DataSet_brand_type);	
			
			$BRAND_TYPE_NM = $Record_brand_type["BRAND_TYPE_NM"];
	
			$Corps .= 	Template("template_brand_list_xml",2,$Params=array(
				"VALUE_BRAND_CD" 		=> $BRAND_CD,
				"VALUE_BRAND_NM" 		=> $BRAND_NM,
				"VALUE_BRAND_TYPE_NM" 	=> $BRAND_TYPE_NM,
				"VALUE_BRAND_LINK" 		=> $BRAND_LINK	
			));	
	
		}
	
		$Corps .= 	Template("template_brand_list_xml",3,$Params=array(
		));	
			
		$Corps = str_replace('&','&amp;',$Corps);
			
		$file = fopen($FileName.".xml", 'w');
		fputs($file, $Corps);
		fclose($file); 
		echo $GPC_B_CD." -> Fichier généré<hr/>";
		ob_flush();
		flush();	
		
		$i++;
	
?>