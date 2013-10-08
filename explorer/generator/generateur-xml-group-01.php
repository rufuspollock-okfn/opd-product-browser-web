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
	$generate_group_items = 1;
	
	
	// -----------------------------------------------------------------------------------------------------------	
	// Traitement
	// -----------------------------------------------------------------------------------------------------------
	
	if($generate_group_items == 1) {

		$SQL = "SELECT * FROM brand_group order by group_nm";
		$DataSet_liste_group = mysql_query($SQL);	
		While ($Record_liste_group = mysql_fetch_array($DataSet_liste_group)) {	
		
			$Corps = "";
		
			$GROUP_CD 			= $Record_liste_group["GROUP_CD"];
			$GROUP_NM 			= $Record_liste_group["GROUP_NM"];
			$GROUP_LINK 		= $Record_liste_group["GROUP_LINK"];
			$GROUP_WIKI_EN 		= $Record_liste_group["GROUP_WIKI_EN"];

			$FileName 						= "../../POD-Website/data/product-group-".str_pad($GROUP_CD,6,"0",STR_PAD_LEFT);
		
			$Corps .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
		
			$Corps .= 	Template("template_group_xml",1,$Params=array(
				"VALUE_GROUP_CD" 		=> $GROUP_CD,
				"VALUE_GROUP_NM" 		=> $GROUP_NM,
				"VALUE_GROUP_IMG"		=> $URL_Base."images/group/".str_pad($GROUP_CD,6,"0",STR_PAD_LEFT).".jpg",
				"VALUE_GROUP_LINK" 		=> $GROUP_LINK,
				"VALUE_GROUP_WIKI_EN" 	=> $GROUP_WIKI_EN
				
			));							
					
			$SQL = "select * from brand where group_cd =".$GROUP_CD." order by brand_nm";
			$DataSet 	= mysql_query($SQL);
			While($Record 	= mysql_fetch_array($DataSet)) {		
								
				$BRAND_CD 					= $Record["BRAND_CD"];									
				$BRAND_NM 					= $Record["BRAND_NM"];
				$BRAND_LINK					= $Record["BRAND_LINK"];
				
				$BRAND_IMG					= $URL_Base."images/brand/".str_pad($BRAND_CD,8,"0",STR_PAD_LEFT).".jpg";

				
				$Corps .= 	Template("template_group_xml",2,$Params=array(
					"VALUE_BRAND_CD"					=> $BRAND_CD,
					"VALUE_BRAND_NM"					=> $BRAND_NM,
					"VALUE_BRAND_LINK"					=> $BRAND_LINK,
					"VALUE_BRAND_IMG"					=> $BRAND_IMG
				));										
			
			} // while
						
			$Corps .= 	Template("template_group_xml",3,$Params=array(
			));	
			
			$Corps = str_replace('&','&amp;',$Corps);
				
			$file = fopen($FileName.".xml", 'w');
			fputs($file, $Corps);
			fclose($file); 
			echo $GROUP_NM." -> Fichier généré<hr/>";
			ob_flush();
			flush();	
	
		} // while
	
	} // if 
	
	//exit;
	
	//----------------------------------------------------------------------------
	// List ----------------------------------------------------------------------
	//

	$i = 1;

	$FileName 						= "../../POD-Website/data/product-group-list";
	$Corps = "";
	$Corps .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	
	$Corps .= 	Template("template_group_list_xml",1,$Params=array(
	));	

	$SQL = "SELECT * FROM brand_group order by group_nm";
	$DataSet_liste_group = mysql_query($SQL);	
	While ($Record_liste_group = mysql_fetch_array($DataSet_liste_group)) {	
	
		$GROUP_CD 			= $Record_liste_group["GROUP_CD"];
		$GROUP_NM 			= $Record_liste_group["GROUP_NM"];
		$GROUP_LINK 		= $Record_liste_group["GROUP_LINK"];



		$Corps .= 	Template("template_group_list_xml",2,$Params=array(
			"VALUE_GROUP_CD" 		=> $GROUP_CD,
			"VALUE_GROUP_NM" 		=> $GROUP_NM,
			"VALUE_GROUP_LINK" 		=> $GROUP_LINK			
		));	

	}

	$Corps .= 	Template("template_group_list_xml",3,$Params=array(
	));	
		
	$Corps = str_replace('&','&amp;',$Corps);
		
	$file = fopen($FileName.".xml", 'w');
	fputs($file, $Corps);
	fclose($file); 
	echo $GPC_B_CD." -> Fichier liste groupes généré<hr/>";
	ob_flush();
	flush();	
	
	$i++;

	
?>