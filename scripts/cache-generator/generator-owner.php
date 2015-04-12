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
	
	$SQL = "SELECT * FROM brand_owner order by owner_nm";
	$DataSet_liste_owner = mysql_query($SQL);	
	While ($Record_liste_owner = mysql_fetch_array($DataSet_liste_owner)) {	
	
		$OWNER_CD 			= $Record_liste_owner["OWNER_CD"];
		$OWNER_NM 			= $Record_liste_owner["OWNER_NM"];
		$OWNER_LINK 		= $Record_liste_owner["OWNER_LINK"];
		$OWNER_WIKI_EN 		= $Record_liste_owner["OWNER_WIKI_EN"];

		$Corps = 	Template("template_list_owner_item",1,$Params=array(
			"VALUE_OWNER_CD" 		=> $OWNER_CD,
			"VALUE_OWNER_NM" 		=> $OWNER_NM,
			"VALUE_OWNER_IMG"		=> "owner/".str_pad($OWNER_CD,6,"0",STR_PAD_LEFT).".jpg",
			"VALUE_OWNER_LINK" 		=> $OWNER_LINK,
			"VALUE_OWNER_WIKI_EN" 	=> $OWNER_WIKI_EN
		));							
				
		$SQL = "select * from brand A, brand_owner_bsin B where A.BSIN = B.BSIN and B.owner_cd =".$OWNER_CD." order by A.brand_nm";
		$DataSet 	= mysql_query($SQL);
		While($Record 	= mysql_fetch_array($DataSet)) {		
								
			$BSIN 						= $Record["BSIN"];								
			$BRAND_NM 					= $Record["BRAND_NM"];
			$BRAND_LINK					= $Record["BRAND_LINK"];

			
			$Corps .= 	Template("template_list_owner_item",2,$Params=array(
				"VALUE_BSIN"						=> $BSIN,
				"VALUE_BRAND_NM"					=> $BRAND_NM,
				"VALUE_BRAND_LINK"					=> $BRAND_LINK,
				"VALUE_BRAND_IMG"					=> "brand/".$BSIN.".jpg"
			));										
		
		} // while
					
		$Corps .= 	Template("template_list_owner_item",3,$Params=array(
		));	

		$FileName = $DataFolder."product-owner-".str_pad($OWNER_CD,6,"0",STR_PAD_LEFT).".html";				
		$file = fopen($FileName,'w');
		fputs($file, $Corps);
		fclose($file); 
		
		echo $OWNER_NM." -> File generated<hr/>";
		
		ob_flush();
		flush();	

	} // while
	
?>