<?
	//======================================================================================================== 
	// Require
	//======================================================================================================== 

	require("secret/connexion.php");
	require("fonctions.php");

	define('DOSSIER_IMG',	"http://product.okfn.org.s3.amazonaws.com/images/");	
	define('DOSSIER_IMG2',	"http://www.product-open-data.com/images/");	

	$GepirReturnCode = array(
		'0' => "No error",
		'1' => " Missing or invalid parameters",
		'2' => " Prefix never allocated",
		'3' => " No exact match on GLN",
		'4' => "Too many hits, max. 20 entries are displayed",
		'5' => " Unknown country code",
		'7' => " Request timed out",
		'8' => " No catalogue exists",
		'9' => " Company information withheld",
		'10' => " Prefix no longer subscribed",
		'11' => " Country not on the GEPIR network",
		'13' => " Illegal Number",
		'14' => " Daily request limit exceeded",
		'99' => " Server error	"	
	);
	
	//======================================================================================================== 
	// Processing
	//======================================================================================================== 



	// GET----------------------------------------------------------------------
	$gtin = ((isset($_GET['p']))  && ($_GET['p']>0) ) ? $_GET['p'] : 0; //&& (ctype_digit($_GET['']))
	$data = array();
	
	if ((check_gtin($gtin) == 0 ) || ($gtin == 0)){ 
		// the gtin-13 is not valid
		$Rest_code = 2;

	} else {
		
		$SQL = "select * from gtin where gtin_cd = '".$gtin."'";
		$DataSet 	= mysql_query($SQL);
		$Record 	= mysql_fetch_array($DataSet);		
		
		if(mysql_num_rows($DataSet) == 0) {

			$Rest_code = 1;

		} else {

			
			$Rest_code = 0;

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
			
			if ($GTIN_M_G != 0) {  
				
				if($GTIN_M_G >= 1000) {
					$WEIGHT =  $GTIN_PKG_UNIT." x ".($GTIN_M_G/1000)." kg"; 
				} else {
					$WEIGHT =  $GTIN_PKG_UNIT." x ".$GTIN_M_G." g"; 
				}
				
				if($GTIN_M_OZ != 0) { 
					$WEIGHT .=  " / "; 
				}
			} 
			
			if($GTIN_M_OZ != 0) { 
				$WEIGHT .=  $GTIN_PKG_UNIT." x ".$GTIN_M_OZ." oz"; 
			}
		
			if ($GTIN_M_ML != 0) {
				
				if($GTIN_M_ML >= 1000) {
					$VOLUME .=  $GTIN_PKG_UNIT." x ".($GTIN_M_ML/1000)." l"; 
				} else {
					$VOLUME .=  $GTIN_PKG_UNIT." x ".$GTIN_M_ML." ml"; 
				}
				
				if ($GTIN_M_FLOZ != 0) { 
					$VOLUME .=  " / "; 
				} 
			}  
			
			if ($GTIN_M_FLOZ != 0) { 
				$VOLUME .=  $GTIN_PKG_UNIT." x ".$GTIN_M_FLOZ." floz"; 
			}  
		
			
			if ($GTIN_M_ABV != 0) { $ALCOHOL = $GTIN_M_ABV." % vol."; } 	
			if ($GTIN_M_ABW != 0) { $ALCOHOL = $GTIN_M_ABW." % vol."; } 	
			
			
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
			
			
			$IMG_GTIN 			= DOSSIER_IMG."gtin/gtin-".substr($gtin,0,3)."/".$gtin.".jpg"; 
			$IMG_BRAND 			= DOSSIER_IMG."brand/".str_pad($BRAND_CD,8,"0",STR_PAD_LEFT).".jpg"; 
			$IMG_GPC 			= DOSSIER_IMG2."gpc/".$GPC_S_CD.".jpg"; 
			$IMG_COMING_SOON 	= DOSSIER_IMG2."coming-soon.jpg"; 
			
		
			
			
			$data['gtin'] = array(	 		
				"code"					=> $gtin,
				"name"					=> $GTIN_NM,
				"product-line"			=> $PRODUCT_LINE,
				"weight"				=> $WEIGHT, 
				"volume"				=> $VOLUME,
				"alcool"				=> $ALCOHOL,
				"img"					=> $IMG_GTIN,
				//"img-default"			=> $IMG_COMING_SOON
			);		
			
			$data['brand'] = array(	 		
				"code"					=> $BRAND_CD,
				"name"					=> $BRAND_NM,
				"type"					=> $BRAND_TYPE_NM,
				"link"					=> $BRAND_LINK,	
				"img"					=> $IMG_BRAND,
				//"img-default"			=> $IMG_COMING_SOON
			);	
		
			$data['group'] = array(	 
				"code"				=> $GROUP_CD,
				"name"				=> $GROUP_NM
			);
		
			$data['gcp'] = array(	 
				"code"				=> $GCP_CD
			);		
			
			$data['gpc'] = array(	
				"img"			=> $IMG_GPC, 
				"img-default"	=> $IMG_COMING_SOON,
				"segment" 		=> array (
									"code" 	=> $GPC_S_CD,
									"nom"	=> $GPC_S_NM
								
								),
				"family" 		=> array (
									"code" 	=> $GPC_F_CD,
									"nom"	=> $GPC_F_NM
								),
				"class" 		=> array (
									"code" 	=> $GPC_C_CD,
									"nom"	=> $GPC_C_NM
								),
				"brick" 		=> array (
									"code" 	=> $GPC_B_CD,
									"nom"	=> $GPC_B_NM
								)
		
			);
			
			$data['gepir'] = array(	 
				"return-code"			=> array (
											"code" 			=> $GLN_RETURN_CODE,
											"name"			=> $GepirReturnCode[$GLN_RETURN_CODE]
											),
				"source"				=> "GEPIR",
				"gln"					=> array (
											"code" 			=> $GLN_CD,
											"name"			=> $GLN_NM,
											"address-1"		=> $GLN_ADDR_02,
											"address-2"		=> $GLN_ADDR_03,
											"address-3"		=> $GLN_ADDR_04,
											"cp"			=> $GLN_ADDR_POSTALCODE,
											"city"			=> $GLN_ADDR_CITY,
											"country"		=> $GLN_COUNTRY_ISO_CD
											)
			);
			
		
			
			// trace of the GTIN 
			
			$SQL	 				= "select count(*) as NB from search_rest where GTIN_CD = '".$gtin."'";
			$DataSet_Search_01 		= mysql_query($SQL);
			$Record_Search_01		= mysql_fetch_array($DataSet_Search_01);
			if($Record_Search_01["NB"] == 0 ) {
				$SQL	 				= "insert into search_rest (GTIN_CD,SEARCH_NB) values ('".$gtin."',1)";
				mysql_query($SQL);				
			} else {
				$SQL	 				= "update search_rest set SEARCH_NB = SEARCH_NB + 1 where GTIN_CD = '".$gtin."'";
				mysql_query($SQL);			
			}
			
		} // if			
	
	} // if

	$data['code'] = $Rest_code;		

	echo json_encode($data);


?>