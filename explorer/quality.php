<?
	require("secret/connexion.php");	
	
	if(isset($_POST['s'])) 			$s			= (int)trim($_POST['s']);	 else  $s = 3;
	if(!is_int($s))  exit;
	
	switch ($s) {
		case 1:

			// Graphe 1 - GCP - GEPIR Return code
			//-----------------------

			$GRAPHE_Separateur = '';

			$Erreurs = array(
				'0' => "No error",
				'1' => "  Missing or invalid parameters",
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
			
			$SQL = "SELECT count(*) as NB FROM gs1_gcp";
			$DataSet = mysql_query($SQL);	
			$Record = mysql_fetch_array($DataSet);
			$NbTotal = $Record["NB"];
				
			$SQL = "SELECT return_code, count(*) as NB FROM gs1_gcp group by return_code";
			$DataSet = mysql_query($SQL);	
			$Number = mysql_num_rows($DataSet);
			$i = 1;
			While ($Record = mysql_fetch_array($DataSet)) {	
			
				$ReturnCode	 	= $Record["return_code"];
				if($ReturnCode == '') $ReturnCode = "unassigned";
				$Nb 			= $Record["NB"]; 
				
				if($i < $Number) {
					
					$VALUE_PIE 		.= $GRAPHE_Separateur."['".$ReturnCode." - ".$Erreurs[$ReturnCode]."<br/> (".number_format($Nb, 0, '.', ' ').")', ".number_format(100*($Nb/$NbTotal), 0, '.', ' ')."]"; 
					$List[$ReturnCode]["cd"]	 = $ReturnCode;
					$List[$ReturnCode]["nm"]	 = $Erreurs[$ReturnCode];
					$PERC = $PERC + number_format(100*($Nb/$NbTotal), 0, '.', ' ');
					$GRAPHE_Separateur 	= ",";
					
				} else {
					
					$VALUE_PIE 		.= $GRAPHE_Separateur."['".$ReturnCode." - ".$Erreurs[$ReturnCode]."<br/> (".number_format($Nb, 0, '.', ' ').")', ".(100 - $PERC)."]"; 
					$List[$ReturnCode]["cd"]	 = $ReturnCode;
					$List[$ReturnCode]["nm"]	 = $Erreurs[$ReturnCode];
					$GRAPHE_Separateur 	= ",";					
				}
				
				$i ++;				
			} // while
			
			$titre = "<b>GCP</b> - GEPIR Return code (".number_format($NbTotal, 0, '', ' ')." codes)";

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
			
			$titre = "<b>GTIN</b> - GPC Segment (".number_format($NbTotal, 0, '', ' ')." codes)";		

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
			
			$titre = "<b>GTIN</b> - Brand (".number_format($NbTotal, 0, '', ' ')." codes)";						
		break;
		default:
		   echo "Valeur non autorisée";
	} // switch
