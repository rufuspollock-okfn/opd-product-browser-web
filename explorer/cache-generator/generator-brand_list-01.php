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
						


	$j = 1; // to name files
	
	foreach(range('a','z') as $lettre) {

		$i = 0; // to draw the table								
		$Corps = "";
		$Corps_temp_1 = '';		
		$Corps_temp_2 = '';	
	
		$SQL = "SELECT * FROM BRAND where left(brand_nm,1) = '".$lettre."' order by brand_nm";
		$DataSet_liste_brand = mysql_query($SQL);	
		While ($Record_liste_brand = mysql_fetch_array($DataSet_liste_brand)) {	
		
			$BSIN 				= $Record_liste_brand["BSIN"];
			$BRAND_NM 			= $Record_liste_brand["BRAND_NM"];
			$BRAND_LINK 		= $Record_liste_brand["BRAND_LINK"];

			$Corps_temp_1 .= 	Template("template_list_brand",5,$Params=array(
				"VALUE_BSIN" 			=> $BSIN,
				"VALUE_BRAND_LINK" 		=> $BRAND_LINK,
				"VALUE_BRAND_NM" 		=> $BRAND_NM,
				"VALUE_IMG"				=> "brand/".$BSIN.".jpg"
			));	
			
			$Corps_temp_2 .= 	Template("template_list_brand",6,$Params=array(
				"VALUE_BRAND_NM" 		=> $BRAND_NM
			));	
	
			$i++;
			
			if($i==4) {
				
				$Corps .= 	Template("template_list_brand",3,$Params=array(
				));	
				
				$Corps .= 	$Corps_temp_1;
				
				$Corps .= 	Template("template_list_brand",4,$Params=array(
				));			
				
				$Corps .= 	Template("template_list_brand",3,$Params=array(
				));
											
				$Corps .= 	$Corps_temp_2;
				
				$Corps .= 	Template("template_list_brand",4,$Params=array(
				));	
				
				$Corps_temp_1 = '';		
				$Corps_temp_2 = '';		
				$i=0;				
																
			} // 4
	
		} // while


		if($i==1) {
			
			$Corps .= 	Template("template_list_brand",3,$Params=array(
			));	
			
			$Corps .= 	$Corps_temp_1."<td></td><td></td><td></td>";
			
			$Corps .= 	Template("template_list_brand",4,$Params=array(
			));			
			
			$Corps .= 	Template("template_list_brand",3,$Params=array(
			));
										
			$Corps .= 	$Corps_temp_2."<td></td><td></td><td></td>";
			
			$Corps .= 	Template("template_list_brand",4,$Params=array(
			));	
		}

		if($i==2) {
			
			$Corps .= 	Template("template_list_brand",3,$Params=array(
			));	
			
			$Corps .= 	$Corps_temp_1."<td></td><td></td>";
			
			$Corps .= 	Template("template_list_brand",4,$Params=array(
			));			
			
			$Corps .= 	Template("template_list_brand",3,$Params=array(
			));
										
			$Corps .= 	$Corps_temp_2."<td></td><td></td>";
			
			$Corps .= 	Template("template_list_brand",4,$Params=array(
			));	
		}

		if($i==3) {
			
			$Corps .= 	Template("template_list_brand",3,$Params=array(
			));	
			
			$Corps .= 	$Corps_temp_1."<td></td>";
			
			$Corps .= 	Template("template_list_brand",4,$Params=array(
			));			
			
			$Corps .= 	Template("template_list_brand",3,$Params=array(
			));
										
			$Corps .= 	$Corps_temp_2."<td></td>";
			
			$Corps .= 	Template("template_list_brand",4,$Params=array(
			));	
		}
	
		
		$Corps .= 	Template("template_list_brand",2,$Params=array(
		));

		$FileName 	= $DataFolder."product-brand-list-".$j.".html";			
		$file = fopen($FileName, 'w');
		fputs($file, $Corps);
		fclose($file); 
		
		echo "File generated : brands starting with ".$lettre."<hr/>";
		
		ob_flush();
		flush();	
		
		$j++;
	
	} // foreach

	// Additional file for brands starting with an digit

	$i = 0; // to draw the table
	$Corps = "";
	$Corps_temp_1 = "";
	$Corps_temp_2 = "";
		
	$SQL = "SELECT * FROM BRAND where left(brand_nm,1) in ('0','1','2','3','4','5','6','7','8','9') order by brand_nm";
	$DataSet_liste_brand = mysql_query($SQL);	
	While ($Record_liste_brand = mysql_fetch_array($DataSet_liste_brand)) {	
	
		$BSIN 				= $Record_liste_brand["BSIN"];
		$BRAND_NM 			= $Record_liste_brand["BRAND_NM"];
		$BRAND_LINK 		= $Record_liste_brand["BRAND_LINK"];

		$Corps_temp_1 .= 	Template("template_list_brand",5,$Params=array(
			"VALUE_BSIN" 			=> $BSIN,
			"VALUE_BRAND_LINK" 		=> $BRAND_LINK,
			"VALUE_BRAND_NM" 		=> $BRAND_NM,
			"VALUE_IMG"				=> "brand/".$BSIN.".jpg"
		));	
		
		$Corps_temp_2 .= 	Template("template_list_brand",6,$Params=array(
			"VALUE_BRAND_NM" 		=> $BRAND_NM
		));	

		$i++;
		
		if($i==4) {
			
			$Corps .= 	Template("template_list_brand",3,$Params=array(
			));	
			
			$Corps .= 	$Corps_temp_1;
			
			$Corps .= 	Template("template_list_brand",4,$Params=array(
			));			
			
			$Corps .= 	Template("template_list_brand",3,$Params=array(
			));
										
			$Corps .= 	$Corps_temp_2;
			
			$Corps .= 	Template("template_list_brand",4,$Params=array(
			));	
			
			$Corps_temp_1 = '';		
			$Corps_temp_2 = '';		
			$i=0;				
															
		} // 4

	} // while


	if($i==1) {
		
		$Corps .= 	Template("template_list_brand",3,$Params=array(
		));	
		
		$Corps .= 	$Corps_temp_1."<td></td><td></td><td></td>";
		
		$Corps .= 	Template("template_list_brand",4,$Params=array(
		));			
		
		$Corps .= 	Template("template_list_brand",3,$Params=array(
		));
									
		$Corps .= 	$Corps_temp_2."<td></td><td></td><td></td>";
		
		$Corps .= 	Template("template_list_brand",4,$Params=array(
		));	
	}

	if($i==2) {
		
		$Corps .= 	Template("template_list_brand",3,$Params=array(
		));	
		
		$Corps .= 	$Corps_temp_1."<td></td><td></td>";
		
		$Corps .= 	Template("template_list_brand",4,$Params=array(
		));			
		
		$Corps .= 	Template("template_list_brand",3,$Params=array(
		));
									
		$Corps .= 	$Corps_temp_2."<td></td><td></td>";
		
		$Corps .= 	Template("template_list_brand",4,$Params=array(
		));	
	}

	if($i==3) {
		
		$Corps .= 	Template("template_list_brand",3,$Params=array(
		));	
		
		$Corps .= 	$Corps_temp_1."<td></td>";
		
		$Corps .= 	Template("template_list_brand",4,$Params=array(
		));			
		
		$Corps .= 	Template("template_list_brand",3,$Params=array(
		));
									
		$Corps .= 	$Corps_temp_2."<td></td>";
		
		$Corps .= 	Template("template_list_brand",4,$Params=array(
		));	
	}

	
	$Corps .= 	Template("template_list_brand",2,$Params=array(
	));


	$FileName = $DataFolder."product-brand-list-27.html";		
	$file = fopen($FileName, 'w');
	fputs($file, $Corps);
	fclose($file); 
	
	echo "File generated : brands starting with digits<hr/>";
	
?>