<?php header("Content-Type: text/html; charset=utf-8");

	// -----------------------------------------------------------------------------------------------------------
	// On inclue les fichiers de contexte
	// -----------------------------------------------------------------------------------------------------------
	
	require("../secret/connexion.php");
	require("../fonctions.php");
	
	// -----------------------------------------------------------------------------------------------------------
	// Déclaration des variables
	// -----------------------------------------------------------------------------------------------------------
	
	//$URL_Base = "http://product.okfn.org.s3.amazonaws.com/";
	$generate_owner_items = 1;
	$DataFolder = "../cache/";	
	
	// -----------------------------------------------------------------------------------------------------------	
	// Traitement
	// -----------------------------------------------------------------------------------------------------------

	$i=0;

	$Corps = 	Template("template_list_owner",1,$Params=array(
	));	

	$SQL = "SELECT * FROM brand_owner order by owner_nm";
	$DataSet_liste_owner = mysql_query($SQL);	
	While ($Record_liste_owner = mysql_fetch_array($DataSet_liste_owner)) {	
	
		$OWNER_CD 			= $Record_liste_owner["OWNER_CD"];
		$OWNER_NM 			= $Record_liste_owner["OWNER_NM"];
		$OWNER_LINK 		= $Record_liste_owner["OWNER_LINK"];

		$Corps_temp_1 .= 	Template("template_list_owner",5,$Params=array(
			"VALUE_OWNER_CD" 		=> $OWNER_CD,
			"VALUE_OWNER_NM" 		=> $OWNER_NM,
			"VALUE_OWNER_LINK" 		=> $OWNER_LINK,	
			"VALUE_IMG"				=> "owner/".str_pad($OWNER_CD,6,"0",STR_PAD_LEFT).".jpg"	
		));	
		

		$Corps_temp_2 .= 	Template("template_list_owner",6,$Params=array(
			"VALUE_OWNER_NM" 		=> $OWNER_NM,
		));	

		$i++;
		
		if($i==4) {
			
			$Corps .= 	Template("template_list_owner",3,$Params=array(
			));	
			
			$Corps .= 	$Corps_temp_1;
			
			$Corps .= 	Template("template_list_owner",4,$Params=array(
			));			
			
			$Corps .= 	Template("template_list_owner",3,$Params=array(
			));
										
			$Corps .= 	$Corps_temp_2;
			
			$Corps .= 	Template("template_list_owner",4,$Params=array(
			));	
			
			$Corps_temp_1 = '';		
			$Corps_temp_2 = '';		
			$i=0;				
															
		} // 3

	}
	
	if($i==1) {
		
		$Corps .= 	Template("template_list_owner",3,$Params=array(
		));	
		
		$Corps .= 	$Corps_temp_1."<td></td><td></td><td></td>";
		
		$Corps .= 	Template("template_list_owner",4,$Params=array(
		));			
		
		$Corps .= 	Template("template_list_owner",3,$Params=array(
		));
									
		$Corps .= 	$Corps_temp_2."<td></td><td></td><td></td>";
		
		$Corps .= 	Template("template_list_owner",4,$Params=array(
		));	
	}

	if($i==2) {
		
		$Corps .= 	Template("template_list_owner",3,$Params=array(
		));	
		
		$Corps .= 	$Corps_temp_1."<td></td><td></td>";
		
		$Corps .= 	Template("template_list_owner",4,$Params=array(
		));			
		
		$Corps .= 	Template("template_list_owner",3,$Params=array(
		));
									
		$Corps .= 	$Corps_temp_2."<td></td><td></td>";
		
		$Corps .= 	Template("template_list_owner",4,$Params=array(
		));	
	}

	if($i==3) {
		
		$Corps .= 	Template("template_list_owner",3,$Params=array(
		));	
		
		$Corps .= 	$Corps_temp_1."<td></td>";
		
		$Corps .= 	Template("template_list_owner",4,$Params=array(
		));			
		
		$Corps .= 	Template("template_list_owner",3,$Params=array(
		));
									
		$Corps .= 	$Corps_temp_2."<td></td>";
		
		$Corps .= 	Template("template_list_owner",4,$Params=array(
		));	
	}
	
		
	$Corps .= 	Template("template_list_owner",2,$Params=array(
	));


		
	//$Corps = str_replace('&','&amp;',$Corps);

	$FileName 	= $DataFolder."product-owner-list".".html";		
	$file = fopen($FileName, 'w');
	fputs($file, $Corps);
	fclose($file); 
	
	echo "Owners file generated<hr/>";
		


	
?>