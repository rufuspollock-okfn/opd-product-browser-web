<?php header("Content-Type: text/html; charset=utf-8");

	// -----------------------------------------------------------------------------------------------------------
	// On inclue les fichiers de contexte
	// -----------------------------------------------------------------------------------------------------------
	
	require("../secret/connexion.php");
	require("fonctions.php");
	
	// -----------------------------------------------------------------------------------------------------------
	// Déclaration des variables
	// -----------------------------------------------------------------------------------------------------------
	
	$URL_Base = "http://product.okfn.org.s3.amazonaws.com/";
	$generate_owner_items = 1;
	$DataFolder = "../";	
	
	// -----------------------------------------------------------------------------------------------------------	
	// Traitement
	// -----------------------------------------------------------------------------------------------------------
	
	if($generate_owner_items == 1) {

		$SQL = "SELECT * FROM brand_owner order by owner_nm";
		$DataSet_liste_owner = mysql_query($SQL);	
		While ($Record_liste_owner = mysql_fetch_array($DataSet_liste_owner)) {	
		
			$Corps = "";
		
			$OWNER_CD 			= $Record_liste_owner["OWNER_CD"];
			$OWNER_NM 			= $Record_liste_owner["OWNER_NM"];
			$OWNER_LINK 		= $Record_liste_owner["OWNER_LINK"];
			$OWNER_WIKI_EN 		= $Record_liste_owner["OWNER_WIKI_EN"];

			$FileName 			= $DataFolder."data/product-owner-".str_pad($OWNER_CD,6,"0",STR_PAD_LEFT);
		
			$Corps .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
		
			$Corps .= 	Template("template_owner_xml",1,$Params=array(
				"VALUE_OWNER_CD" 		=> $OWNER_CD,
				"VALUE_OWNER_NM" 		=> $OWNER_NM,
				"VALUE_OWNER_IMG"		=> $URL_Base."images/owner/".str_pad($OWNER_CD,6,"0",STR_PAD_LEFT).".jpg",
				"VALUE_OWNER_LINK" 		=> $OWNER_LINK,
				"VALUE_OWNER_WIKI_EN" 	=> $OWNER_WIKI_EN
				
			));							
					
			$SQL = "select * from brand where owner_cd =".$OWNER_CD." order by brand_nm";
			$DataSet 	= mysql_query($SQL);
			While($Record 	= mysql_fetch_array($DataSet)) {		
								
				$BRAND_CD 					= $Record["BRAND_CD"];		
				$BSIN 						= $Record["BSIN"];								
				$BRAND_NM 					= $Record["BRAND_NM"];
				$BRAND_LINK					= $Record["BRAND_LINK"];
				
				$BRAND_IMG					= $URL_Base."images/brand/".$BSIN.".jpg";

				
				$Corps .= 	Template("template_owner_xml",2,$Params=array(
					"VALUE_BRAND_CD"					=> $BRAND_CD,
					"VALUE_BSIN"						=> $BSIN,
					"VALUE_BRAND_NM"					=> $BRAND_NM,
					"VALUE_BRAND_LINK"					=> $BRAND_LINK,
					"VALUE_BRAND_IMG"					=> $BRAND_IMG
				));										
			
			} // while
						
			$Corps .= 	Template("template_owner_xml",3,$Params=array(
			));	
			
			$Corps = str_replace('&','&amp;',$Corps);
				
			$file = fopen($FileName.".xml", 'w');
			fputs($file, $Corps);
			fclose($file); 
			echo $OWNER_NM." -> Fichier généré<hr/>";
			ob_flush();
			flush();	
	
		} // while
	
	} // if 
	
	//exit;
	
	//----------------------------------------------------------------------------
	// List ----------------------------------------------------------------------
	//

	$i = 1;

	$FileName 						= $DataFolder."data/product-owner-list";
	$Corps = "";
	$Corps .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	
	$Corps .= 	Template("template_owner_list_xml",1,$Params=array(
	));	

	$SQL = "SELECT * FROM brand_owner order by owner_nm";
	$DataSet_liste_owner = mysql_query($SQL);	
	While ($Record_liste_owner = mysql_fetch_array($DataSet_liste_owner)) {	
	
		$OWNER_CD 			= $Record_liste_owner["OWNER_CD"];
		$OWNER_NM 			= $Record_liste_owner["OWNER_NM"];
		$OWNER_LINK 		= $Record_liste_owner["OWNER_LINK"];



		$Corps .= 	Template("template_owner_list_xml",2,$Params=array(
			"VALUE_OWNER_CD" 		=> $OWNER_CD,
			"VALUE_OWNER_NM" 		=> $OWNER_NM,
			"VALUE_OWNER_LINK" 		=> $OWNER_LINK			
		));	

	}

	$Corps .= 	Template("template_owner_list_xml",3,$Params=array(
	));	
		
	$Corps = str_replace('&','&amp;',$Corps);
		
	$file = fopen($FileName.".xml", 'w');
	fputs($file, $Corps);
	fclose($file); 
	echo $GPC_B_CD." -> Fichier liste owneres généré<hr/>";
	ob_flush();
	flush();	
	
	$i++;

	
?>