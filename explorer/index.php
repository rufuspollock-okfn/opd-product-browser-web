<?


	if($_SERVER['HTTP_HOST'] == "localhost") {
		define('URL_BASE',						"D:/Programmes/wamp/www/github/products/explorer/");	
		define('SITE_BASE',						"http://localhost/github/products/explorer/");	
		
	} else {
		
		if($_SERVER['HTTP_HOST'] == "pod.okserver.org") {
			define('URL_BASE',						"");
			//define('SITE_BASE',					"http://pod.okserver.org/");
			define('SITE_BASE',						"http://www.product-open-data.com/");
		} else {
			define('URL_BASE',						"");
			define('SITE_BASE',						"http://www.product-open-data.com/");				
		}
	}
	
	define('EXTENSION',							".html");

	define('DOSSIER_RESSOURCES',				URL_BASE."ressources/");

	define('DOSSIER_DOCS',						"docs/");	
	

	if($_SERVER['HTTP_HOST'] == "localhost") {
		//define('DOSSIER_IMG',					"images/");
		define('DOSSIER_IMG',					"http://product.okfn.org.s3.amazonaws.com/images/");
	
	} else {
		//define('DOSSIER_IMG',					"http://www.product-open-data.com/images/");
		define('DOSSIER_IMG',					"http://product.okfn.org.s3.amazonaws.com/images/");	

	}
	
	define('DOSSIER_IMG_LANG',					"images/lang/");
	define('DOSSIER_IMG_COUNTRY',				"images/country/");

	//======================================================================================================== 
	// Variables
	//======================================================================================================== 

	// GET----------------------------------------------------------------------
	$p = ((isset($_GET['p']))  && ($_GET['p']>0) ) ? $_GET['p'] : 0; //&& (ctype_digit($_GET['']))
	$m = ((isset($_GET['m']))  && ($_GET['m']>0) ) ? $_GET['m'] : 0; //&& (ctype_digit($_GET['']))
	$n = ((isset($_GET['n']))  && ($_GET['n']>0) ) ? $_GET['n'] : 0; //&& (ctype_digit($_GET['']))
	//$s = ((isset($_GET['s']))  && ($_GET['s']>0) ) ? $_GET['s'] : 0; //&& (ctype_digit($_GET['']))
	
	$Language = (isset($_GET['l'])) ?  $_GET['l'] : "en";
	
	//echo "p: ".$_GET['p']." - s: ".$_GET['s']." - m: ".$_GET['m'];
	
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
		$NbGTIN = "920698";
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
	
				$BSIN 						= $Record_BRAND["BSIN"];
				$BRAND_NM					= $Record_BRAND["BRAND_NM"];
				$OWNER_CD					= $Record_BRAND["OWNER_CD"];
				$BRAND_TYPE_CD			    = $Record_BRAND["BRAND_TYPE_CD"];
				$BRAND_LINK					= trim($Record_BRAND["BRAND_LINK"]);

				if($OWNER_CD != "") {
					$SQL = "SELECT * FROM BRAND_OWNER where OWNER_CD = ".$OWNER_CD;
					$DataSet_OWNER = mysql_query($SQL);
					$Record_OWNER = @mysql_fetch_array($DataSet_OWNER);
			
					$OWNER_NM					= $Record_OWNER["OWNER_NM"];
				
				}
				
				if($BRAND_TYPE_CD != '') {
					$SQL = "SELECT * FROM brand_type where brand_type_cd = ".$BRAND_TYPE_CD;
					$DataSet_BRAND = mysql_query($SQL);
					$Record_BRAND = @mysql_fetch_array($DataSet_BRAND);
		
					$BRAND_TYPE_NM					= trim($Record_BRAND["BRAND_TYPE_NM"]);
				}
	
	
				// GCP length between 6 and 12 digits
				$DataSet_GLN = mysql_query("SELECT * FROM gs1_gcp WHERE gcp_cd in (left('".$gtin."',6), left('".$gtin."',7),left('".$gtin."',8),left('".$gtin."',9),left('".$gtin."',10),left('".$gtin."',11),left('".$gtin."',12))");
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
				
				
				$IMG_GTIN 	= DOSSIER_IMG."gtin/gtin-".substr($gtin,0,3)."/".$gtin.".jpg"; 
				$IMG_BRAND 	= DOSSIER_IMG."brand/".$BSIN.".jpg"; 
				$IMG_GPC 	= "images/gpc/".$GPC_S_CD.".jpg"; 
			
				
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
					
					"VALUE_OWNER_CD"				=> $OWNER_CD,
					"VALUE_OWNER_NM"				=> $OWNER_NM,
					
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
					
					"VALUE_BSIN"					=> $BSIN,
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
				$POT_MG 					= $Record_NUS["POT_MG"];
				$POT_DV 					= $Record_NUS["POT_DV"];
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
						"VALUE_POT_MG"				=> $POT_MG,
						"VALUE_POT_DV"				=> $POT_DV,
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
					
					"VALUE_GCP_CD"					=> $GCP_CD,
	
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
			
			
			

			if($m == 0) {

				$Corps .= 	Template("template_quality",1,$Params=array(
				));	
			
			} else {
				switch ($m) {
					case 1:
	
	
			
						// Graphe 1 - GCP - GEPIR Return code
						//-----------------------
			
						$GRAPHE_Separateur = '';
			
						$Erreurs = array();
						
						$SQL = "SELECT * FROM gs1_gcp_rc where return_code not in (0,2,101)";
						$DataSet = mysql_query($SQL);	
						While ($Record = mysql_fetch_array($DataSet)) {	
							$Erreurs[$Record["RETURN_CODE"]] = $Record["RETURN_NAME"];	
						}
						
									
						$SQL = "SELECT count(*) as NB FROM gs1_gcp where return_code not in (0,2,10)";
						$DataSet = mysql_query($SQL);	
						$Record = mysql_fetch_array($DataSet);
						$NbTotal = $Record["NB"];
						
							
						$SQL = "SELECT return_code, count(*) as NB FROM gs1_gcp where return_code not in (0,2,10,101) group by return_code";
						$DataSet = mysql_query($SQL);	
						$Number = mysql_num_rows($DataSet);
						
						$i = 1;
						While ($Record = mysql_fetch_array($DataSet)) {	
						
							$ReturnCode	 	= $Record["return_code"];
							if($ReturnCode == '') $ReturnCode = "unassigned";
							$Nb 			= $Record["NB"]; 
							
							if($i < $Number) {
								
								$VALUE_PIE 		.= $GRAPHE_Separateur."[' Code ".$ReturnCode."<br/>(".number_format($Nb, 0, '.', ' ').")', ".number_format(100*($Nb/$NbTotal), 0, '.', ' ')."]"; 
								$PERC = $PERC + number_format(100*($Nb/$NbTotal), 0, '.', ' ');
								$GRAPHE_Separateur 	= ",";
								
							} else {
								
								$VALUE_PIE 		.= $GRAPHE_Separateur."[' Code ".$ReturnCode."<br/>(".number_format($Nb, 0, '.', ' ').")', ".(100 - $PERC)."]"; 
								$GRAPHE_Separateur 	= ",";					
							}
							
							$i ++;				
						} // while
						
						$h1 = "<b>GCP</b> - GEPIR Return code";
						$titre = "<b>GCP</b> - GEPIR Return code (".number_format($NbTotal, 0, '', ' ')." codes)";
	
	
						$Corps .= 	Template("template_quality",2,$Params=array(
							"VALUE_H1"					=> $h1,
							"VALUE_TITRE"				=> $titre,
							"VALUE_PIE"					=> $VALUE_PIE,
							
						));	
			
						$Corps .= 	Template("template_quality",3,$Params=array(
						));	
		
						foreach($Erreurs as $cle=>$valeur) {
							$Corps .= 	Template("template_quality",4,$Params=array(
								"VALUE_CD"					=> $cle,
								"VALUE_NM"					=> $valeur
							));	
						}
		
						$Corps .= 	Template("template_quality",5,$Params=array(
						));	
					   

					
					break;
					case 2:
					
						// Graphe 2 - GTIN - GPC Segment
						//-----------------------
							
						$GRAPHE_Separateur = '';
			
						$Segments = array(
							'10000000' => "Pet Care/Food",
							'47000000' => "Cleaning/Hygiene Products",
							'50000000' => "Food/Beverage/Tobacco",
							'51000000' => "Healthcare",
							'53000000' => "Beauty/Personal Care/Hygiene",
							'54000000' => "Baby Care",
							'58000000' => "Cross Segment",
							'60000000' => "Textual/Printed/Reference Materials",
							'61000000' => "Music",
							'62000000' => "Stationery/Office Machinery/Occasion Supplies",
							'63000000' => "Footwear",
							'64000000' => "Personal Accessories",	
							'65000000' => "Computing",	
							'66000000' => "Communications",	
							'67000000' => "Clothing",		 
							'68000000' => "Audio Visual/Photography",	
							'70000000' => "Arts/Crafts/Needlework",
							'71000000' => "Sports Equipment",	 
							'72000000' => "Home Appliances",
							'73000000' => "Kitchen Merchandise",	
							'74000000' => "Camping",	
							'75000000' => "Household/Office Furniture/Furnishings",	 
							'77000000' => "Automotive",	
							'78000000' => "Electrical Supplies",	
							'79000000' => "Plumbing/Heating/Ventilation/Air Conditioning",	
							'80000000' => "Tools/Equipment - Hand",		 
							'81000000' => "Lawn/Garden Supplies",	
							'82000000' => "Tools/Equipment - Power",		 
							'83000000' => "Building Products",	
							'84000000' => "Tool Storage/Workshop Aids",
							'85000000' => "Safety/Protection - DIY",	
							'86000000' => "Toys/Games",
							'87000000' => "Fuels",	 
							'88000000' => "Lubricants",		 
							'89000000' => "Live Animals",	
							'91000000' => "Safety/Security/Surveillance",		 
							'92000000' => "Storage/Haulage Containers"
						);
						
						$SQL = "SELECT count(*) as NB FROM gtin";
						$DataSet = mysql_query($SQL);	
						$Record = mysql_fetch_array($DataSet);
						$NbTotal = $Record["NB"];
							
						$SQL = "SELECT gpc_s_cd, count(*) as NB FROM gtin group by gpc_s_cd";
						$DataSet = mysql_query($SQL);	
						$Number = mysql_num_rows($DataSet);
						$i = 1;
						While ($Record = mysql_fetch_array($DataSet)) {	
						
							$gpc_s_cd	 		= $Record["gpc_s_cd"];
							if($gpc_s_cd == '') $gpc_s_cd = "unassigned";
							$Nb 			= $Record["NB"]; 
							
							if($i < $Number) {
							
								$VALUE_PIE 		.= $GRAPHE_Separateur."['".$gpc_s_cd." <br/> (".number_format($Nb, 0, '.', ' ').")', ".number_format(100*($Nb/$NbTotal), 0, '.', ' ')."]"; 
								$List[$gpc_s_cd]["cd"]		 = $gpc_s_cd;
								$List[$gpc_s_cd]["nm"]		 = $Segments[$gpc_s_cd];
								$PERC = $PERC + number_format(100*($Nb/$NbTotal), 0, '.', ' ');
								$GRAPHE_Separateur 	= ",";
								
							} else {
								
								$VALUE_PIE 		.= $GRAPHE_Separateur."['".$gpc_s_cd." <br/> (".number_format($Nb, 0, '.', ' ').")', ".(100 - $PERC)."]"; 
								$List[$gpc_s_cd]["cd"]		 = $gpc_s_cd;
								$List[$gpc_s_cd]["nm"]		 = $Segments[$gpc_s_cd];
								$GRAPHE_Separateur 	= ",";					
							}
							
							$i ++;
							
						} // while
						
						$h1 = "<b>GTIN</b> - GPC Segment";
						$titre = "<b>GTIN</b> - GPC Segment (".number_format($NbTotal, 0, '', ' ')." codes)";	
						
						$Corps .= 	Template("template_quality",2,$Params=array(
							"VALUE_H1"					=> $h1,
							"VALUE_TITRE"				=> $titre,
							"VALUE_PIE"					=> $VALUE_PIE,
							
						));	
			
						if(isset($List)) { 
						
							$Corps .= 	Template("template_quality",3,$Params=array(
							));	
			
							foreach($List as $element) {
								$Corps .= 	Template("template_quality",4,$Params=array(
									"VALUE_CD"					=> $element["cd"],
									"VALUE_NM"					=> $element["nm"]
								));	
							}
			
							$Corps .= 	Template("template_quality",5,$Params=array(
							));	
					   
						} 
					
		
			
					break;
					case 3:
					
	
					
						// Graphe 3 - GTIN - Brand
						//-----------------------
						$SQL = "SELECT count(*) as NB FROM gtin";
						$DataSet = mysql_query($SQL);	
						$Record = mysql_fetch_array($DataSet);
						$NbTotal = $Record["NB"];	
						
						$SQL = "SELECT count(*) as NB FROM gtin where brand_cd > 0 and brand_cd in (select brand_cd from brand where brand_type_cd = 1 and brand_nm not like '0_%') ";
						$DataSet = mysql_query($SQL);	
						$Record = mysql_fetch_array($DataSet);
						$NbBrandType_1 = $Record["NB"];
						
						$PERC_1 = number_format(100*($NbBrandType_1/$NbTotal), 0, '.', ' ');
						$VALUE_PIE .= "['Manufacturer-brand<br/> (".number_format($NbBrandType_1, 0, '.', ' ').")', ".$PERC_1."]"; 
						$VALUE_PIE .= ","; 
						
						$SQL = "SELECT count(*) as NB FROM gtin where brand_cd > 0 and brand_cd in (select brand_cd from brand where brand_type_cd = 2) ";
						$DataSet = mysql_query($SQL);	
						$Record = mysql_fetch_array($DataSet);
						$NbBrandType_2 = $Record["NB"];
			
						$PERC_2 = number_format(100*($NbBrandType_2/$NbTotal), 0, '.', ' ');
						$VALUE_PIE .= "['Retailer-brand <br/>(".number_format($NbBrandType_2, 0, '.', ' ').")', ".$PERC_2."]"; 
						$VALUE_PIE .= ","; 
						
						$SQL = "SELECT count(*) as NB FROM gtin where brand_cd > 0 and brand_cd in (select brand_cd from brand where brand_type_cd = 3) ";
						$DataSet = mysql_query($SQL);	
						$Record = mysql_fetch_array($DataSet);
						$NbBrandType_3 = $Record["NB"];
			
						$PERC_3 = number_format(100*($NbBrandType_3/$NbTotal), 0, '.', ' ');			
						$VALUE_PIE .= "['Validity to check  <br/> (".number_format($NbBrandType_3, 0, '.', ' ').")', ".$PERC_3."]"; 
						$VALUE_PIE .= ","; 
						
						$NbUnAssigned = $NbTotal - $NbBrandType_1 - $NbBrandType_2 - $NbBrandType_3;
						$PERC_UnAssigned = 100 - $PERC_1 - $PERC_2 - $PERC_3;  
						$VALUE_PIE .= "['Brand unassigned <br/>(".number_format($NbUnAssigned, 0, '.', ' ').")', ".$PERC_UnAssigned."]"; 
						
						$h1 = "<b>GTIN</b> - Brand";
						$titre = "<b>GTIN</b> - Brand (".number_format($NbTotal, 0, '', ' ')." codes)";	
						
						$Corps .= 	Template("template_quality",2,$Params=array(
							"VALUE_H1"					=> $h1,
							"VALUE_TITRE"				=> $titre,
							"VALUE_PIE"					=> $VALUE_PIE,
							
						));	
			
						if(isset($List)) { 
						
							$Corps .= 	Template("template_quality",3,$Params=array(
							));	
			
							foreach($List as $element) {
								$Corps .= 	Template("template_quality",4,$Params=array(
									"VALUE_CD"					=> $element["cd"],
									"VALUE_NM"					=> $element["nm"]
								));	
							}
			
							$Corps .= 	Template("template_quality",5,$Params=array(
							));	
					   
						} 
					
	
											
					break;
					case 4:
	
						$Corps .= 	'<h1>GCP - Length per prefix</h1>';
						$Corps .= 	'<a href="data-quality/"><< Return to the Data Quality menu</a><br /><br />';
						$Corps .= 	'<table>';
						$Corps .= 	'<tr>';
						$Corps .= 		'<td style="padding:5px"><b>Prefix</b></td>';
						$Corps .= 		'<td style="padding:5px"><b>Length</b></td>';
						$Corps .= 		'<td style="padding:5px;width:60px;"><b>Number of GCP  with a GEPIR Return Code = 0</b></td>';
						$Corps .= 		'<td style="padding:5px;width:60px;"><b>Number of GCP</b></td>';
						$Corps .= 		'<td style="padding:5px;width:60px;""><b>%</b></td>';
						$Corps .= 		'<td style="padding:5px;width:200px;"><b>GS1 Member Organization</b></td>';
						$Corps .= 		'<td style="padding:5px;width:60px;""><b>Number of barcode that can be assigned (per GCP)</b></td>';
						$Corps .= 	'</tr>';
					
						$SQL = "SELECT substring(A.gcp_cd,1,3) as prefix, length(A.GCP_CD) as length, count(A.GCP_CD) as nb, count(distinct (case when A.return_code = 0 > 0 then A.GCP_CD end)) as nb2, B.prefix_nm, B.country_iso_cd as country FROM `gs1_gcp` A, gs1_prefix B where substring(A.gcp_cd,1,3) = B.prefix_cd and B.country_iso_cd <>'' group by substring(A.gcp_cd,1,3), length(A.gcp_cd)";
						$DataSet = mysql_query($SQL);	
						While ($Record = mysql_fetch_array($DataSet)) {	
						
							$prefix 		= $Record["prefix"];	
							$length 		= $Record["length"];
							$nb_num 		= $Record["nb"];
							$nb_rc_0 		= $Record["nb2"];
							$prefix_nm 		= $Record["prefix_nm"];
							$country 		= $Record["country"];
							
							$SQL = "SELECT gcp_nb from gs1_gcp_nb where prefix_cd = '".$prefix."' and gcp_length = ".$length;
							$DataSet2 = mysql_query($SQL);	
							$Record2 = mysql_fetch_array($DataSet2);
							
							$gcp_nb 		= $Record2["gcp_nb"];
							
							$nb_max_product = pow(10,12 - $length);
							$perc_num 		= $nb_rc_0 / $nb_num * 100;
							
							$perc			= number_format($perc_num, 2, '.', ' ');
							$nb 			= number_format($nb_num, 0, '.', ' ');
							$nb_rc_0  		= number_format($nb_rc_0 , 0, '.', ' ');
							$nb_max_product = number_format($nb_max_product , 0, '.', ' ');
							
							$Corps .= 	'<tr>';
							$Corps .= 		'<td style="padding:2px" align="right">'.$prefix.'</td>';
							$Corps .= 		'<td style="padding:2px" align="right">'.$length.'</td>';
							$Corps .= 		'<td style="padding:2px" align="right">'.$nb_rc_0.'</td>';
							
							if($gcp_nb == $nb_num) { // if all gcp have been checked, green background
								$Corps .= 		'<td style="padding:2px;background-color:rgb(190, 247, 190);" align="right">'.$nb.'</td>';
							} else {
								if($length > 7) {
									$Corps .= 		'<td style="padding:2px;background-color:rgb(213, 211, 211);" align="right">'.$nb.'</td>';
								} else {
									$Corps .= 		'<td style="padding:2px" align="right">'.$nb.'</td>';
								}
							}
							
							if($perc_num > 2) {
								$Corps .= 		'<td style="padding:2px" align="right">'.$perc.' %</td>';
							} else {
								$Corps .= 		'<td style="padding:2px;color:red;" align="right">'.$perc.' %</td>';
							}
							
							$Corps .= 		'<td style="padding:2px" >&nbsp;&nbsp;&nbsp;<img align="center" src="'.DOSSIER_IMG_COUNTRY.strtolower($country).'.png" /> '.$prefix_nm.'</td>';
							$Corps .= 		'<td style="padding:2px" align="right">'.$nb_max_product.'</td>';
							$Corps .= 	'</tr>';
							
						}
						
						$Corps .= 	"</table>";
						
					break;		
					default:
					   echo "Valeur non autorisée";
				} // switch


			} //if

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
		case 106: // display html files
			
			$Corps 		= file_get_contents("template_pss-history.php");

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 109: // display tweets
			
			$Corps 		= file_get_contents("template_tweets.php");

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 110: // display Open GEPIR Stats

			$SQL = "select distinct gln_cd from gs1_gcp";
			$DataSet 		= mysql_query($SQL);
			$VALUE_NB_GLN  	= number_format(mysql_num_rows($DataSet), 0, '.', ' ');		
			
			
			$SQL = "select * from gs1_gcp";
			$DataSet 	= mysql_query($SQL);
			$VALUE_NB_GCP	= number_format(mysql_num_rows($DataSet), 0, '.', ' ');		

			$Erreurs = array(
				'0' => 	" No error",
				'1' => 	" Missing or invalid parameters",
				'2' => " Prefix never allocated",
				'3' => " No exact match on GLN",
				'5' => " Unknown country code",
				'8' => " No catalogue exists",
				'9' => " Company information withheld",
				'10' => " Prefix no longer subscribed",
				'11' => " Country not on the GEPIR network",
				'13' => " Illegal Number",
				'14' => " Daily request limit exceeded",
				'99' => " Server error	"	
				);

			
			$Corps .= 	Template("template_open_gepir",1,$Params=array(
						"VALUE_NB_GLN"					=> $VALUE_NB_GLN ,
						"VALUE_NB_GCP"					=> $VALUE_NB_GCP				
			));	

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 111: // 
			
			$Corps 		= file_get_contents("template_navigate.php");

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 112: //  Browse by brand
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------	
		
			if($m > 0) {
	
				
				if(!file_exists("cache/product-brand-".$m.".html")) {
					$Corps = "<br/>Content not available";
				} else {
					$Corps = file_get_contents("cache/product-brand-".$m.".html");
				} // if
			
			} else {
				
				if($n > 0) {
					if(!file_exists("cache/product-brand-list-".$n.".html")) {
						$Corps = "<br/>Content not available";
					} else {
						$Corps .= 	Template("template_list_brand_header",1,$Params=array(
							"VALUE_N"	=> $n
						));	
					
						$Corps .= 	file_get_contents("cache/product-brand-list-".$n.".html");
					} // if
						
				} // if							
													
			} // if

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 113: // 
			
			$Corps 		= file_get_contents("template_supporters.php");

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		// Browse by owners
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------		
		case 114: 

			if($n > 0) {
	
				if(!file_exists("cache/product-owner-".$n.".html")) {
					$Corps = "<br/>Content not available";
				} else {	
					$Corps = file_get_contents("cache/product-owner-".$n.".html");
				} // if
			
			} else {
					
				if(!file_exists("cache/product-owner-list.html")) {
					$Corps = "<br/>Content not available";
				} else {
					$Corps = file_get_contents("cache/product-owner-list.html");
				} // if
						
			} // if																

			break;
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 115: // 
			
			$Corps 		= file_get_contents("template_smartphone.php");

			break;
			
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------
		case 116: // 
			
			$Corps 		= file_get_contents("template_nutrition_us.php");

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