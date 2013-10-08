<?
	if($_SERVER['HTTP_HOST'] == "localhost") {
		define('URL_BASE',						"D:/Programmes/wamp/www/github/products/explorer/");	
		define('SITE_BASE',						"http://localhost/github/products/explorer/");	
		
	} else {
		define('URL_BASE',						"");
		define('SITE_BASE',						"http://www.product-open-data.com/");	
	}
	
	define('EXTENSION',							".html");

	define('DOSSIER_RESSOURCES',				URL_BASE."ressources/");

	define('DOSSIER_DOCS',						"docs/");	
	if($_SERVER['HTTP_HOST'] == "localhost") {
		define('DOSSIER_IMG',					"../../../images/");
	} else {
		define('DOSSIER_IMG',					"images/");
	}
	define('DOSSIER_IMG_LANG',					DOSSIER_IMG."lang/");
	define('DOSSIER_IMG_COUNTRY',				DOSSIER_IMG."country/");

	//======================================================================================================== 
	// Variables
	//======================================================================================================== 

	// GET----------------------------------------------------------------------
	$p = ((isset($_GET['p']))  && ($_GET['p']>0) ) ? $_GET['p'] : 0; //&& (ctype_digit($_GET['']))
	$m = ((isset($_GET['m']))  && ($_GET['m']>0) ) ? $_GET['m'] : 0; //&& (ctype_digit($_GET['']))
	$n = ((isset($_GET['n']))  && ($_GET['n']>0) ) ? $_GET['n'] : 0; //&& (ctype_digit($_GET['']))
	$Language = (isset($_GET['l'])) ?  $_GET['l'] : "en";
	
	define('SITE_LANG',					$Language);

	// POST----------------------------------------------------------------------
	$gtin = ((isset($_POST['gtin']))  && (trim($_POST['gtin'])>0) && (strlen(trim($_POST['gtin']))==13) ) ? trim($_POST['gtin']) : 0; //&& (ctype_digit($_GET['']))


	// SESSION ------------------------------------------------------------------

	define('LINK_BASE',							SITE_LANG."/");	

	$url_page = explode(SITE_LANG.'/',$_SERVER['REQUEST_URI']);
	define('URL_CURRENT_END',					$url_page[1]);	
	

	//======================================================================================================== 
	// Require
	//======================================================================================================== 

	require("secret/connexion.php");
	require("fonctions.php");
	require(DOSSIER_RESSOURCES."global_".SITE_LANG.".php");
	
	if((URL_CURRENT_END == '') && ($p < 2) ) {
		$SiteTitle = SITE_TITLE;
	} else {
		if(URL_CURRENT_END == '') {
			$tmp = explode('/',$_SERVER['REQUEST_URI']);
			$Complement = str_replace("-",' ',end($tmp)); 
		} else { 
			$Complement = str_replace("-",' ',str_replace(range(0,9),'',URL_CURRENT_END));
		}
		$SiteTitle = SITE_TITLE." - ".$Complement;		
	}


	//======================================================================================================== 
	// Stats
	//======================================================================================================== 

	if($_SERVER['SERVER_NAME'] == "localhost2" ){
		
		$SQL = "select count(*) as NB from gtin";
		$DataSet 	= mysql_query($SQL);
		$Record 	= mysql_fetch_array($DataSet);		
		
		$NbGTIN = $Record["NB"];
		
	} else {
		$NbGTIN = "920131";
	}
	
	$NbGTIN = str_pad($NbGTIN,11,"0",STR_PAD_LEFT);
	$digits =(string)$NbGTIN;
	$CountGTIN[0] = $digits{0};
	$CountGTIN[1] = $digits{1};
	$CountGTIN[2] = $digits{2};
	$CountGTIN[3] = $digits{3};
	$CountGTIN[4] = $digits{4};
	$CountGTIN[5] = $digits{5};
	$CountGTIN[6] = $digits{6};
	$CountGTIN[7] = $digits{7};
	$CountGTIN[8] = $digits{8};
	$CountGTIN[9] = $digits{9};
	$CountGTIN[10] = $digits{10};

	//======================================================================================================== 
	// Processing
	//======================================================================================================== 

	switch ($p) {
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 100: // Recherche code barre

			$Corps .= 	Template("template_search",1,$Params=array(
			));
		
			if ((check_gtin($gtin) == 0 ) || ($gtin == 0)){ 
				$Corps .= 	Template("template_search",2,$Params=array(
					"VALUE_GTIN_CD"			=> $gtin
				));
			} else {
				$SQL = "select * from gtin where gtin_cd = '".$gtin."'";
				$DataSet 	= mysql_query($SQL);
				$Record 	= mysql_fetch_array($DataSet);		
				
				$GTIN_NM 					= $Record["GTIN_NM"];
				$GCP_CD 					= $Record["GCP_CD"];
				$BRAND_CD 					= $Record["BRAND_CD"];
				$PRODUCT_LINE 				= $Record["PRODUCT_LINE"];
				
				$GPC_S_CD 					= $Record["GPC_S_CD"];
				$GPC_F_CD 					= $Record["GPC_F_CD"];
				$GPC_C_CD 					= $Record["GPC_C_CD"];
				$GPC_B_CD 					= $Record["GPC_B_CD"];
				
				$REF_CD 					= $Record["REF_CD"];
				
				$GTIN_M_G 					= $Record["M_G"];
				$GTIN_M_OZ 					= $Record["M_OZ"];
				$GTIN_M_ML 					= $Record["M_ML"];
				$GTIN_M_FLOZ 				= $Record["M_FLOZ"];
				$GTIN_M_ABV 				= $Record["M_ABV"];
				$GTIN_M_ABW 				= $Record["M_ABW"];
				
				$GTIN_PKG_UNIT 				= $Record["PKG_UNIT"];
				
				if($BRAND_CD == "")  $BRAND_CD = 0;
	
				$DataSet_GPC = mysql_query("SELECT * FROM gs1_gpc where GPC_CD = '".$GPC_S_CD."' and GPC_LANG = 'EN'");
				$Record_GPC = mysql_fetch_array($DataSet_GPC);
				$GPC_S_NM					= $Record_GPC["GPC_NM"];
				
				$DataSet_GPC = mysql_query("SELECT * FROM gs1_gpc where GPC_CD = '".$GPC_F_CD."' and GPC_LANG = 'EN'");
				$Record_GPC = mysql_fetch_array($DataSet_GPC);
				$GPC_F_NM					= $Record_GPC["GPC_NM"];

				$DataSet_GPC = mysql_query("SELECT * FROM gs1_gpc where GPC_CD = '".$GPC_C_CD."' and GPC_LANG = 'EN'");
				$Record_GPC = mysql_fetch_array($DataSet_GPC);
				$GPC_C_NM					= $Record_GPC["GPC_NM"];
				
				$DataSet_GPC = mysql_query("SELECT * FROM gs1_gpc where GPC_CD = '".$GPC_B_CD."' and GPC_LANG = 'EN'");
				$Record_GPC = mysql_fetch_array($DataSet_GPC);
				$GPC_B_NM					= $Record_GPC["GPC_NM"];
	
				$SQL = "SELECT * FROM brand where BRAND_CD = ".$BRAND_CD;
				$DataSet_BRAND = mysql_query($SQL);
				$Record_BRAND = mysql_fetch_array($DataSet_BRAND);
	
				$BRAND_NM					= $Record_BRAND["BRAND_NM"];
				$GROUP_CD					= $Record_BRAND["GROUP_CD"];
				$BRAND_TYPE_CD			    = $Record_BRAND["BRAND_TYPE_CD"];
				$BRAND_LINK					= trim($Record_BRAND["BRAND_LINK"]);

				if($GROUP_CD != "") {
					$SQL = "SELECT * FROM groups where GROUP_CD = ".$GROUP_CD;
					$DataSet_GROUP = mysql_query($SQL);
					$Record_GROUP = @mysql_fetch_array($DataSet_GROUP);
			
					$GROUP_NM					= $Record_GROUP["GROUP_NM"];
				
				}
				
				if($BRAND_TYPE_CD != '') {
					$SQL = "SELECT * FROM brand_type where brand_type_cd = ".$BRAND_TYPE_CD;
					$DataSet_BRAND = mysql_query($SQL);
					$Record_BRAND = @mysql_fetch_array($DataSet_BRAND);
		
					$BRAND_TYPE_NM					= trim($Record_BRAND["BRAND_TYPE_NM"]);
				}
	
	
				$DataSet_GLN = mysql_query("SELECT * FROM gs1_gcp where GCP_CD = '".$GCP_CD."'");
				//$DataSet_GLN = mysql_query("select * from gs1_gcp where '".$GCP_CD."' like concat(gcp_cd,'%') order by length(gcp_cd) asc");
				$Record_GLN = mysql_fetch_array($DataSet_GLN);
	
				$GLN_RETURN_CODE 			= $Record_GLN["RETURN_CODE"];
	
				$GLN_CD 					= $Record_GLN["GLN_CD"];
				$GLN_NM 					= $Record_GLN["GLN_NM"];
				$GLN_ADDR_02 				= $Record_GLN["GLN_ADDR_02"];
				$GLN_ADDR_03 				= $Record_GLN["GLN_ADDR_03"];
				$GLN_ADDR_04 				= $Record_GLN["GLN_ADDR_04"];
				$GLN_ADDR_POSTALCODE 		= $Record_GLN["GLN_ADDR_POSTALCODE"];
				$GLN_ADDR_CITY 				= $Record_GLN["GLN_ADDR_CITY"];
				$GLN_COUNTRY_ISO_CD 		= $Record_GLN["GLN_COUNTRY_ISO_CD"];
				
				if(file_exists(DOSSIER_IMG."gtin/gtin-".substr($gtin,0,3)."/".$gtin.".jpg")) { 
					$IMG_GTIN = DOSSIER_IMG."gtin/gtin-".substr($gtin,0,3)."/".$gtin.".jpg"; 
				} else {
					$IMG_GTIN = DOSSIER_IMG."coming-soon.jpg";
				}
				
				if(file_exists(DOSSIER_IMG."brand/".str_pad($BRAND_CD,8,"0",STR_PAD_LEFT).".jpg")) { 
					$IMG_BRAND = DOSSIER_IMG."brand/".str_pad($BRAND_CD,8,"0",STR_PAD_LEFT).".jpg"; 
				} else {
					$IMG_BRAND = DOSSIER_IMG."coming-soon.jpg";
				}
				
				if(file_exists(DOSSIER_IMG."gpc/".$GPC_S_CD.".jpg")) { 
					$IMG_GPC = DOSSIER_IMG."gpc/".$GPC_S_CD.".jpg"; 
				} else {
					$IMG_GPC = DOSSIER_IMG."coming-soon.jpg";
				}
				
				$Corps .= 	Template("template_search",3,$Params=array(
				
					"VALUE_IMG_GTIN"				=> $IMG_GTIN,
					"VALUE_IMG_BRAND"				=> $IMG_BRAND,
					"VALUE_IMG_GPC"					=> $IMG_GPC,
					
					"VALUE_GTIN_CD"					=> $gtin,
					"VALUE_GTIN_NM"					=> $GTIN_NM,
					"VALUE_GCP_CD"					=> $GCP_CD,
					"VALUE_BRAND_CD"				=> $BRAND_CD,
					"VALUE_REF_CD"					=> $REF_CD,
					
					"VALUE_PRODUCT_LINE"			=> $PRODUCT_LINE,
					
					"VALUE_GROUP_CD"				=> $GROUP_CD,
					"VALUE_GROUP_NM"				=> $GROUP_NM,
					
					"VALUE_M_G"						=> $GTIN_M_G,
					"VALUE_M_OZ"					=> $GTIN_M_OZ,
					"VALUE_M_ML"					=> $GTIN_M_ML,
					"VALUE_M_FLOZ"					=> $GTIN_M_FLOZ,
					"VALUE_M_ABV"					=> $GTIN_M_ABV,
					"VALUE_M_ABW"					=> $GTIN_M_ABW,
					"VALUE_PKG_UNIT"				=> $GTIN_PKG_UNIT,
					
					"VALUE_GPC_S_CD"				=> $GPC_S_CD,
					"VALUE_GPC_F_CD"				=> $GPC_F_CD,
					"VALUE_GPC_C_CD"				=> $GPC_C_CD,
					"VALUE_GPC_B_CD"				=> $GPC_B_CD,
					
					"VALUE_GPC_S_NM"				=> $GPC_S_NM,
					"VALUE_GPC_F_NM"				=> $GPC_F_NM,
					"VALUE_GPC_C_NM"				=> $GPC_C_NM,
					"VALUE_GPC_B_NM"				=> $GPC_B_NM,
					
					"VALUE_BRAND_NM"				=> $BRAND_NM,	
					"VALUE_BRAND_TYPE_NM"			=> $BRAND_TYPE_NM,
					"VALUE_BRAND_LINK"				=> $BRAND_LINK,					
					
			
				));	
				
				$DataSet_NUS = mysql_query("SELECT * FROM nutrition_us where gtin_cd = '".$gtin."'");
				$NB_NUS = mysql_num_rows($DataSet_NUS);
				$Record_NUS = mysql_fetch_array($DataSet_NUS);				
				
				$INGREDIENTS 				= $Record_NUS["INGREDIENTS"];
				$SERV_SIZE_G 				= $Record_NUS["SERV_SIZE_G"];
				$SERV_SIZE_ML 				= $Record_NUS["SERV_SIZE_ML"];
				$SERV_CT 					= $Record_NUS["SERV_CT"];
				$CAL 						= $Record_NUS["CAL"];
				$CAL_FROM_FAT 				= $Record_NUS["CAL_FROM_FAT"];
				$TOT_FAT_G 					= $Record_NUS["TOT_FAT_G"];
				$TOT_FAT_DV 				= $Record_NUS["TOT_FAT_DV"];
				$SAT_FAT_G 					= $Record_NUS["SAT_FAT_G"];
				$SAT_FAT_DV 				= $Record_NUS["SAT_FAT_DV"];
				$TRANS_FAT_G 				= $Record_NUS["TRANS_FAT_G"];
				$CHOL_MG 					= $Record_NUS["CHOL_MG"];
				$CHOL_DV 					= $Record_NUS["CHOL_DV"];		
				$SOD_MG 					= $Record_NUS["SOD_MG"];
				$SOD_DV 					= $Record_NUS["SOD_DV"];
				$TOT_CARB_G 				= $Record_NUS["TOT_CARB_G"];
				$TOT_CARB_DV 				= $Record_NUS["TOT_CARB_DV"];
				$DIET_FIBER_G 				= $Record_NUS["DIET_FIBER_G"];
				$DIET_FIBER_DV 				= $Record_NUS["DIET_FIBER_DV"];	
				$SUGARS_G 					= $Record_NUS["SUGARS_G"];
				$PROTEIN_G 					= $Record_NUS["PROTEIN_G"];	
				$VITAMIN_A 					= $Record_NUS["VITAMIN_A"];
				$VITAMIN_C 					= $Record_NUS["VITAMIN_C"];
				$CALCIUM 					= $Record_NUS["CALCIUM"];	
				$IRON 						= $Record_NUS["IRON"];	
				$SOURCE 					= $Record_NUS["SOURCE"];
				$SYNC_DT 					= $Record_NUS["SYNC_DT"];	
				
				if($SERV_SIZE_G == 0) {	$SERV_SIZE =  $SERV_SIZE_ML."ml"; } else { $SERV_SIZE =  $SERV_SIZE_G."g"; }
				
				if($NB_NUS == 1) { 
				
					$Corps .= 	Template("template_search",4,$Params=array(
	
						"VALUE_INGREDIENTS"			=> $INGREDIENTS,
						"VALUE_SERV_SIZE"			=> $SERV_SIZE,
						"VALUE_SERV_CT"				=> $SERV_CT,					
						"VALUE_CAL"					=> $CAL,
						"VALUE_CAL_FROM_FAT"		=> $CAL_FROM_FAT,
						"VALUE_TOT_FAT_G"			=> $TOT_FAT_G,
						"VALUE_TOT_FAT_DV"			=> $TOT_FAT_DV,
						"VALUE_SAT_FAT_G"			=> $SAT_FAT_G,
						"VALUE_SAT_FAT_DV"			=> $SAT_FAT_DV,
						"VALUE_TRANS_FAT_G"			=> $TRANS_FAT_G,
						"VALUE_TRANS_FAT_DV"		=> $TRANS_FAT_DV,
						"VALUE_CHOL_MG"				=> $CHOL_MG,
						"VALUE_CHOL_DV"				=> $CHOL_DV,	
						"VALUE_SOD_MG"				=> $SOD_MG,
						"VALUE_SOD_DV"				=> $SOD_DV,
						"VALUE_TOT_CARB_G"			=> $TOT_CARB_G,
						"VALUE_TOT_CARB_DV"			=> $TOT_CARB_DV,
						"VALUE_DIET_FIBER_G"		=> $DIET_FIBER_G,
						"VALUE_DIET_FIBER_DV"		=> $DIET_FIBER_DV,
						"VALUE_SUGARS_G"			=> $SUGARS_G,
						"VALUE_PROTEIN_G"			=> $PROTEIN_G,	
						"VALUE_VITAMIN_A"			=> $VITAMIN_A,
						"VALUE_VITAMIN_C"			=> $VITAMIN_C,
						"VALUE_CALCIUM"				=> $CALCIUM,	
						"VALUE_IRON"				=> $IRON,	
						"VALUE_SOURCE"				=> $SOURCE,
						"VALUE_SYNC_DT"				=> $SYNC_DT	
				
					));		
				
				}
				
				$Corps .= 	Template("template_search",5,$Params=array(				
					"VALUE_GLN_RETURN_CODE"			=> $GLN_RETURN_CODE,
	
					"VALUE_GLN_CD"					=> $GLN_CD,
					"VALUE_GLN_NM"					=> $GLN_NM,
					"VALUE_GLN_ADDR_02"				=> $GLN_ADDR_02,
					"VALUE_GLN_ADDR_03"				=> $GLN_ADDR_03,
					"VALUE_GLN_ADDR_04"				=> $GLN_ADDR_04,
					"VALUE_GLN_ADDR_POSTALCODE"		=> $GLN_ADDR_POSTALCODE,
					"VALUE_GLN_ADDR_CITY"			=> $GLN_ADDR_CITY,
					"VALUE_GLN_COUNTRY_ISO_CD"		=> $GLN_COUNTRY_ISO_CD
				));				
				
				
				$SQL	 				= "select count(*) as NB from search where GTIN_CD = '".$gtin."'";
				$DataSet_Search_01 		= mysql_query($SQL);
				$Record_Search_01		= mysql_fetch_array($DataSet_Search_01);
				if($Record_Search_01["NB"] == 0 ) {
					$SQL	 				= "insert into search (GTIN_CD,SEARCH_NB) values ('".$gtin."',1)";
					mysql_query($SQL);				
				} else {
					$SQL	 				= "update search set SEARCH_NB = SEARCH_NB + 1 where GTIN_CD = '".$gtin."'";
					mysql_query($SQL);			
				}
					
			} // if


			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 101: // display html files
			
			$Corps 		= file_get_contents("template_pss.php");

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 102: // display html files
			
			include("quality.php");

			$Corps .= 	Template("template_quality",1,$Params=array(
				"VALUE_S"					=> $s,
				"VALUE_TITRE"				=> $titre,
				"VALUE_PIE"					=> $VALUE_PIE,
				
			));	

			if(isset($List)) { 
			
				$Corps .= 	Template("template_quality",2,$Params=array(
				));	

				foreach($List as $element) {
					$Corps .= 	Template("template_quality",3,$Params=array(
						"VALUE_CD"					=> $element["cd"],
						"VALUE_NM"					=> $element["nm"]
					));	
				}

				$Corps .= 	Template("template_quality",4,$Params=array(
				));	
           
 			} 

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 103: // display html files
			
			$Corps 		= file_get_contents("template_terms_of_use.php");

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 104: // display html files
			
			$Corps 		= file_get_contents("template_download.php");

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 108: // display html files

			if($m > 0) {
	
				$URL_Base = "http://www.product-open-data.com/";
				if($_SERVER['SERVER_NAME'] == "localhost" ){
					$URL_Base_Replace 	= "";
				} else {
					$URL_Base_Replace 	= "";
				}
	
				if(!file_exists("pss/pss-gln-".$m.".xml")) {
					$Corps = "<br/>Content not available";
				} else {
				
					$PssFile = file_get_contents("pss/pss-gln-".$m.".xml");
					//echo $PssFile;
					$xml = new SimpleXMLElement($PssFile);
		
					$GLN_RETURN_CODE 			= $xml->gln->gepir_rc;
					$GLN_CD 					= $xml->gln->code;
					$GLN_NM 					= $xml->gln->name;
					$GLN_ADDR_02 				= $xml->gln->address_1;
					$GLN_ADDR_03 				= $xml->gln->address_2;
					$GLN_ADDR_04 				= $xml->gln->address_3;
					$GLN_ADDR_POSTALCODE 		= $xml->gln->address_cp;
					$GLN_ADDR_CITY 				= $xml->gln->address_city;
					$GLN_COUNTRY_ISO_CD 		= $xml->gln->address_country;
					
					$GLN_IMG 					= str_replace($URL_Base,$URL_Base_Replace,$xml->gln->image);
					
					$Corps .= 	Template("template_list_manufacturer_item",1,$Params=array(
						
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
		
					$Corps .= 	Template("template_list_manufacturer_item",2,$Params=array(
					));		
					
					$Corps .= 	Template("template_list_manufacturer_item",3,$Params=array(
					));							
		
					foreach($xml->gln as $gln){ 				
						foreach($gln->brand as $brand){ 	
							$GCP_CD						= trim($brand->gcp);		
							$BRAND_CD					= trim($brand->code);	
							$BRAND_NM					= trim($brand->name);	
							$BRAND_TYPE_NM			    = trim($brand->type);
							$BRAND_LINK					= trim($brand->link);
							
							$BRAND_IMG					= str_replace($URL_Base,$URL_Base_Replace,$brand->image); 

							if($PREVIOUS_GCP_CD != $GCP_CD) { 
								$Corps .= 	Template("template_list_manufacturer_item",5,$Params=array(
								));		
								$Corps .= "<h3>GCP ".$GCP_CD."</h3>";  
								$Corps .= 	Template("template_list_manufacturer_item",3,$Params=array(
								));	
							}
							
							$Corps .= Template("template_list_manufacturer_item",4,$Params=array(
								"VALUE_GCP_CD"					=> $GCP_CD,
								"VALUE_BRAND_CD"				=> $BRAND_CD,	
								"VALUE_BRAND_NM"				=> $BRAND_NM,	
								"VALUE_BRAND_TYPE_NM"			=> $BRAND_TYPE_NM,
								"VALUE_BRAND_LINK"				=> $BRAND_LINK,
								
								"VALUE_BRAND_IMG"				=> $BRAND_IMG
							));	
							

							$PREVIOUS_GCP_CD			= $GCP_CD;	
						}
					}
					
					$Corps .= 	Template("template_list_manufacturer_item",5,$Params=array(
					));
					
					$Corps .= 	Template("template_list_manufacturer_item",6,$Params=array(
					));
		
					$Corps .= 	Template("template_list_manufacturer_item",7,$Params=array(
					));	
					
					foreach($xml->gln as $gln) {			
						foreach($gln->brand as $brand) { 
							$GCP_CD						= trim($brand->gcp);	
							$BRAND_CD					= trim($brand->code);	
							$BRAND_NM					= trim($brand->name);		
							foreach($brand->item as $item) { 	
			
								$GTIN_CD 					= $item->gtin;									
								$GTIN_NM 					= $item->name;
								
								$GTIN_PRODUCT_LINE 			= $item->productLine;
								
								$GTIN_M_G 					= $item->measure->g;
								$GTIN_M_OZ 					= $item->measure->oz;
								$GTIN_M_ML 					= $item->measure->ml;
								$GTIN_M_FLOZ 				= $item->measure->floz;
								$GTIN_M_ABV 				= $item->measure->abv;
								$GTIN_M_ABW 				= $item->measure->abw;
								
								$GTIN_PKG_UNIT 				= $item->packaging->internalUnit;
								
								$GTIN_IMG					= str_replace($URL_Base,$URL_Base_Replace,$item->image);


								if($PREVIOUS_GCP_CD != $GCP_CD) { 
									$Corps .= 	Template("template_list_manufacturer_item",5,$Params=array(
									));		
									$Corps .= "<h3>GCP ".$GCP_CD."</h3>";  
									$Corps .= 	Template("template_list_manufacturer_item",3,$Params=array(
									));	
								}
								
								$Corps .= 	Template("template_list_manufacturer_item",8,$Params=array(
									"VALUE_GTIN_CD"					=> $GTIN_CD,
									"VALUE_GTIN_NM"					=> $GTIN_NM,
									"VALUE_GCP_CD"					=> $GCP_CD,
									
									"VALUE_BRAND_NM"				=> $BRAND_NM,
									"VALUE_PRODUCT_LINE"			=> $GTIN_PRODUCT_LINE,
									
									"VALUE_M_G"						=> $GTIN_M_G,
									"VALUE_M_OZ"					=> $GTIN_M_OZ,
									"VALUE_M_ML"					=> $GTIN_M_ML,
									"VALUE_M_FLOZ"					=> $GTIN_M_FLOZ,
									"VALUE_M_ABV"					=> $GTIN_M_ABV,
									"VALUE_M_ABW"					=> $GTIN_M_ABW,
									"VALUE_PKG_UNIT"				=> $GTIN_PKG_UNIT,
									
									"VALUE_GTIN_IMG"				=> $GTIN_IMG
								));	
								

								$PREVIOUS_GCP_CD			= $GCP_CD;	
									
							}
						}
					}
			
					$Corps .= 	Template("template_list_manufacturer_item",9,$Params=array(
					));	
					
					$Corps .= 	Template("template_list_manufacturer_item",10,$Params=array(
					));	
				
				} // if
			
			} else {
				
					$Corps .= 	Template("template_list_manufacturer",1,$Params=array(
					));						
								
			} // if
				
			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 106: // display html files
			
			$Corps 		= file_get_contents("template_pss-history.php");

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 109: // display tweets
			
			$Corps 		= file_get_contents("template_tweets.php");

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 110: // 

			$URL_Base = "http://www.product-open-data.com/";
			if($_SERVER['SERVER_NAME'] == "localhost" ){
				$URL_Base_Replace 	= "";
			} else {
				$URL_Base_Replace 	= "";
			}

			if($m > 0) {
	
				if(!file_exists("data/product-gpc-".$m.".xml")) {
					$Corps = "<br/>Content not available";
				} else {
					
					$Corps .= 	Template("template_list_gpc_item",1,$Params=array(
					));	
				
					$PssFile = file_get_contents("data/product-gpc-".$m.".xml");
					//echo $PssFile;
					$xml = new SimpleXMLElement($PssFile);
					
					foreach($xml->item as $item) { 	
	
						$GTIN_CD 					= $item->gtin;	
						$GCP_CD 					= $item->gcp;								
						$GTIN_NM 					= $item->name;
						
						$BRAND_NM 					= $item->brand;
						
						$GTIN_PRODUCT_LINE 			= $item->productLine;
						
						$GTIN_M_G 					= $item->measure->g;
						$GTIN_M_OZ 					= $item->measure->oz;
						$GTIN_M_ML 					= $item->measure->ml;
						$GTIN_M_FLOZ 				= $item->measure->floz;
						$GTIN_M_ABV 				= $item->measure->abv;
						$GTIN_M_ABW 				= $item->measure->abw;
						
						$GTIN_PKG_UNIT 				= $item->packaging->internalUnit;
						
						$GTIN_IMG					= str_replace($URL_Base,$URL_Base_Replace,$item->image);

						/*
						if($PREVIOUS_GCP_CD != $GCP_CD) { 
							$Corps .= 	Template("template_list_gpc_item",5,$Params=array(
							));		
							$Corps .= "<h3>GCP ".$GCP_CD."</h3>";  
							$Corps .= 	Template("template_list_gpc_item",3,$Params=array(
							));	
						}
						*/
						
						$Corps .= 	Template("template_list_gpc_item",2,$Params=array(
							"VALUE_GTIN_CD"					=> $GTIN_CD,
							"VALUE_GTIN_NM"					=> $GTIN_NM,
							"VALUE_GCP_CD"					=> $GCP_CD,
							
							"VALUE_BRAND_NM"				=> $BRAND_NM,
							"VALUE_PRODUCT_LINE"			=> $GTIN_PRODUCT_LINE,
							
							"VALUE_M_G"						=> $GTIN_M_G,
							"VALUE_M_OZ"					=> $GTIN_M_OZ,
							"VALUE_M_ML"					=> $GTIN_M_ML,
							"VALUE_M_FLOZ"					=> $GTIN_M_FLOZ,
							"VALUE_M_ABV"					=> $GTIN_M_ABV,
							"VALUE_M_ABW"					=> $GTIN_M_ABW,
							"VALUE_PKG_UNIT"				=> $GTIN_PKG_UNIT,
							
							"VALUE_GTIN_IMG"				=> $GTIN_IMG
						));	
						

						$PREVIOUS_GCP_CD			= $GCP_CD;	
							
					}
		
					$Corps .= 	Template("template_list_gpc_item",3,$Params=array(
					));	
				
				} // if
			
			} else {
				
				if(!file_exists("data/product-gpc-list.xml")) {
					$Corps = "<br/>Content not available";
				} else {
					
					$Corps .= 	Template("template_list_gpc",1,$Params=array(
					));	
				
					$PssFile = file_get_contents("data/product-gpc-list.xml");
					//echo $PssFile;
					$xml = new SimpleXMLElement($PssFile);
					
					foreach($xml->s as $s) { 	
						$Corps .= 	Template("template_list_gpc",2,$Params=array(
							"VALUE_GPC_CD" => $s->s_cd,
							"VALUE_GPC_NM" => $s->s_nm
						));	
						
						$Corps .= 	Template("template_list_gpc",3,$Params=array(
						));							
						
						foreach($s->f as $f) { 	
							$Corps .= 	Template("template_list_gpc",4,$Params=array(
								"VALUE_GPC_CD" => $f->f_cd,
								"VALUE_GPC_NM" => $f->f_nm
							));	
							
							$Corps .= 	Template("template_list_gpc",5,$Params=array(
							));							
							
							foreach($f->c as $c) { 
								$Corps .= 	Template("template_list_gpc",6,$Params=array(
									"VALUE_GPC_CD" => $c->c_cd,
									"VALUE_GPC_NM" => $c->c_nm
								));	
								
								$Corps .= 	Template("template_list_gpc",7,$Params=array(
								));							
									
								foreach($c->b as $b) { 	
								
									$Corps .= 	Template("template_list_gpc",8,$Params=array(
										"VALUE_GPC_CD" => $b->b_cd,
										"VALUE_GPC_NM" => $b->b_nm
									));	

								
								} // foreach	
								
				
								$Corps .= 	Template("template_list_gpc",9,$Params=array(
								));	

								$Corps .= 	Template("template_list_gpc",10,$Params=array(
								));		
							} // foreach
							$Corps .= 	Template("template_list_gpc",11,$Params=array(
							));	

							$Corps .= 	Template("template_list_gpc",12,$Params=array(
							));	
						} // foreach
						$Corps .= 	Template("template_list_gpc",13,$Params=array(
						));	

						$Corps .= 	Template("template_list_gpc",14,$Params=array(
						));	
					} // foreach
					$Corps .= 	Template("template_list_gpc",15,$Params=array(
					));	
					
				} // if
							
			} // if

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 111: // 
			
			$Corps 		= file_get_contents("template_navigate.php");

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 112: // 

			$URL_Base = "http://www.product-open-data.com/";
			if($_SERVER['SERVER_NAME'] == "localhost" ){
				$URL_Base_Replace 	= "../../../";
			} else {
				$URL_Base_Replace 	= "";
			}

			if($m > 0) {
	
				if(!file_exists("data/product-brand-".$m.".xml")) {
					$Corps = "<br/>Content not available";
				} else {
					
				
					$PssFile = file_get_contents("data/product-brand-".$m.".xml");
					//echo $PssFile;
					$xml = new SimpleXMLElement($PssFile);
					
					$Corps .= 	Template("template_list_brand_item",1,$Params=array(
						"VALUE_BRAND_IMG"		=> $xml->brand->image,
						"VALUE_BRAND_NM"		=> $xml->brand->name,
						"VALUE_BRAND_TYPE_NM"	=> $xml->brand->type,
						"VALUE_BRAND_LINK"		=> $xml->brand->link,
						"VALUE_GROUP_CD"		=> $xml->brand->group->code,
						"VALUE_GROUP_NM"		=> $xml->brand->group->name
					));	
					
					
					foreach($xml->item as $item) { 	
	
						$GTIN_CD 					= $item->gtin;	
						$GCP_CD 					= $item->gcp;								
						$GTIN_NM 					= $item->name;
						
						$GPC_S_IMG 					= $item->gpc->image;	
						$GPC_S_NM 					= $item->gpc->name;	
						
						$REG_C						= $item->registration->country;
						$REG_N						= $item->registration->office;
						
						$BRAND_NM 					= $item->brand;
						
						$GTIN_PRODUCT_LINE 			= $item->productLine;
						
						$GTIN_M_G 					= $item->measure->g;
						$GTIN_M_OZ 					= $item->measure->oz;
						$GTIN_M_ML 					= $item->measure->ml;
						$GTIN_M_FLOZ 				= $item->measure->floz;
						$GTIN_M_ABV 				= $item->measure->abv;
						$GTIN_M_ABW 				= $item->measure->abw;
						
						$GTIN_PKG_UNIT 				= $item->packaging->internalUnit;
						
						$NUTRI_FLAG 				= $item->nutri_flag;
						
						$GTIN_IMG					= str_replace($URL_Base,$URL_Base_Replace,$item->image);
					
						
						if(substr($GTIN_CD,0,1) == "0") {
							//echo $GTIN_CD;
							$UPC_CD = substr($GTIN_CD,1,12);
							$HTML_UPC_CD = " / UPC ".$UPC_CD;
						} else {
							$HTML_UPC_CD = "";
						}
						/*
						if($PREVIOUS_GCP_CD != $GCP_CD) { 
							$Corps .= 	Template("template_list_gpc_item",5,$Params=array(
							));		
							$Corps .= "<h3>GCP ".$GCP_CD."</h3>";  
							$Corps .= 	Template("template_list_gpc_item",3,$Params=array(
							));	
						}
						*/
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
						

						$PREVIOUS_GCP_CD			= $GCP_CD;	
							
					}
		
					$Corps .= 	Template("template_list_gpc_item",3,$Params=array(
					));	
				
				} // if
			
			} else {
				
				if($n > 0) {
					
					
					if(!file_exists("data/product-brand-list-".$n.".xml")) {
						$Corps = "<br/>Content not available";
					} else {
						
						$Corps .= 	Template("template_list_brand",1,$Params=array(
							"VALUE_N"	=> $n
						));	
					
						$PssFile = file_get_contents("data/product-brand-list-".$n.".xml");
						//echo $PssFile;
						$xml = new SimpleXMLElement($PssFile);
						$i=0;
						foreach($xml->brand as $brand) {
							
									
							$Corps_temp_1 .= 	Template("template_list_brand",5,$Params=array(
								"VALUE_BRAND_CD" 		=> $brand->code,
								"VALUE_BRAND_LINK" 		=> $brand->link,
								"VALUE_BRAND_NM" 		=> $brand->name,
								"VALUE_IMG"				=> DOSSIER_IMG."brand/".str_pad($brand->code,8,"0",STR_PAD_LEFT).".jpg"
							));	
							
							$Corps_temp_2 .= 	Template("template_list_brand",6,$Params=array(
								"VALUE_BRAND_NM" 		=> $brand->name
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
																				
							} // 3
						
						} // foreach
						
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
					} // if
						
				} // if							
													
			} // if

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 113: // 
			
			$Corps 		= file_get_contents("template_supporters.php");

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 114: // 

			$URL_Base = "http://www.product-open-data.com/";
			if($_SERVER['SERVER_NAME'] == "localhost" ){
				$URL_Base_Replace 	= "../../../";
			} else {
				$URL_Base_Replace 	= "";
			}

			if($n > 0) {
	
				if(!file_exists("data/product-group-".$n.".xml")) {
					$Corps = "<br/>Content not available";
				} else {	
					
				
					$PssFile = file_get_contents("data/product-group-".$n.".xml");
					//echo $PssFile;
					$xml = new SimpleXMLElement($PssFile);
					
					$Corps .= 	Template("template_list_group_item",1,$Params=array(
						"VALUE_GROUP_IMG"		=> $xml->group->image,
						"VALUE_GROUP_CD"		=> $xml->group->code,
						"VALUE_GROUP_NM"		=> $xml->group->name,
						"VALUE_GROUP_LINK"		=> $xml->group->link,
						"VALUE_GROUP_WIKI_EN"	=> $xml->group->wiki->en
					));	
					
					
					foreach($xml->item as $item) { 	
	
						$BRAND_CD 					= $item->code;								
						$BRAND_NM 					= $item->name;
						
						$BRAND_IMG					= str_replace($URL_Base,$URL_Base_Replace,$item->image);
						

						$Corps .= 	Template("template_list_group_item",2,$Params=array(
							"VALUE_BRAND_CD"				=> $BRAND_CD,
							"VALUE_BRAND_NM"				=> $BRAND_NM,							
							"VALUE_BRAND_IMG"				=> $BRAND_IMG
						));	
						
							
					}
		
					$Corps .= 	Template("template_list_group_item",3,$Params=array(
					));	
				
				} // if
			
			} else {
					
					if(!file_exists("data/product-group-list.xml")) {
						$Corps = "<br/>Content not available";
					} else {
						
						$Corps .= 	Template("template_list_group",1,$Params=array(
						));	
					
					
						$PssFile = file_get_contents("data/product-group-list.xml");
						//echo $PssFile;
						$xml = new SimpleXMLElement($PssFile);
						$i=0;
						foreach($xml->group as $group) {
							
							$IMG = DOSSIER_IMG."group/".str_pad($group->code,6,"0",STR_PAD_LEFT).".jpg";
									
							$Corps_temp_1 .= 	Template("template_list_group",5,$Params=array(
								"VALUE_GROUP_CD" 		=> $group->code,
								"VALUE_GROUP_LINK" 		=> $group->link,
								"VALUE_GROUP_NM" 		=> $group->name,
								"VALUE_IMG"				=> $IMG
							));	
							
							$Corps_temp_2 .= 	Template("template_list_group",6,$Params=array(
								"VALUE_GROUP_NM" 		=> $group->name
							));	
	
							$i++;
							
							if($i==4) {
								
								$Corps .= 	Template("template_list_group",3,$Params=array(
								));	
								
								$Corps .= 	$Corps_temp_1;
								
								$Corps .= 	Template("template_list_group",4,$Params=array(
								));			
								
								$Corps .= 	Template("template_list_group",3,$Params=array(
								));
															
								$Corps .= 	$Corps_temp_2;
								
								$Corps .= 	Template("template_list_group",4,$Params=array(
								));	
								
								$Corps_temp_1 = '';		
								$Corps_temp_2 = '';		
								$i=0;				
																				
							} // 3
						
						} // foreach
						
						if($i==1) {
							
							$Corps .= 	Template("template_list_group",3,$Params=array(
							));	
							
							$Corps .= 	$Corps_temp_1."<td></td><td></td><td></td>";
							
							$Corps .= 	Template("template_list_group",4,$Params=array(
							));			
							
							$Corps .= 	Template("template_list_group",3,$Params=array(
							));
														
							$Corps .= 	$Corps_temp_2."<td></td><td></td><td></td>";
							
							$Corps .= 	Template("template_list_group",4,$Params=array(
							));	
						}

						if($i==2) {
							
							$Corps .= 	Template("template_list_group",3,$Params=array(
							));	
							
							$Corps .= 	$Corps_temp_1."<td></td><td></td>";
							
							$Corps .= 	Template("template_list_group",4,$Params=array(
							));			
							
							$Corps .= 	Template("template_list_group",3,$Params=array(
							));
														
							$Corps .= 	$Corps_temp_2."<td></td><td></td>";
							
							$Corps .= 	Template("template_list_group",4,$Params=array(
							));	
						}

						if($i==3) {
							
							$Corps .= 	Template("template_list_group",3,$Params=array(
							));	
							
							$Corps .= 	$Corps_temp_1."<td></td>";
							
							$Corps .= 	Template("template_list_group",4,$Params=array(
							));			
							
							$Corps .= 	Template("template_list_group",3,$Params=array(
							));
														
							$Corps .= 	$Corps_temp_2."<td></td>";
							
							$Corps .= 	Template("template_list_group",4,$Params=array(
							));	
						}
						
							
						$Corps .= 	Template("template_list_group",2,$Params=array(
						));
					} // if
						
				} // if							
													

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 115: // 
			
			$Corps 		= file_get_contents("template_smartphone.php");

			break;
		
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		
		default: // affichage des pages stockées en base
		
			
			if($p == 1) { // news pour la page d'accueil
				$Corps 		= file_get_contents("template_home.php");
				
			}
		
			//$Corps 	.= file_get_contents("pages/p_".str_pad($p,4,"0",STR_PAD_LEFT)."_".SITE_LANG.".php");
			//$Corps 	.= file_get_contents("pages/p_".str_pad($p,4,"0",STR_PAD_LEFT)."_en.php");
	
	} // switch


	//======================================================================================================== 
	// Display
	//======================================================================================================== 

			
	$Sortie .= 	Template("template",1,$Params=array(
		"VALUE_SiteTitle"			=> $SiteTitle,
		"VALUE_CountGTIN"			=> $CountGTIN,
		"VALUE_SiteLang"			=> SITE_LANG,
		"VALUE_MsgLangIndispo"		=> $MsgLangIndispo
	));
	

	$Sortie .= 	$Corps;
	
	$Sortie .= 	Template("template",2,$Params=array(
	));

	$Sortie 		= str_replace("<DOSSIER_IMG>",DOSSIER_IMG,$Sortie);

	echo $Sortie;
?>