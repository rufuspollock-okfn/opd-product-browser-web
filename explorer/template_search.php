<h1>Search by GTIN-13 code</h1>

<!--COUPER_ICI-->

<b>This GTIN-13 code is not correct</b> !
<br/><br/>
The GTIN-13 code is the code just below the barcode. if the code is composed of only 12 digits, add a zero in front of the code to get the GTIN-13 number.
<div align="center">
<img style="margin: 20px;" src="<DOSSIER_IMG>GTIN_under_barcode.jpg" />
</div>


<!--COUPER_ICI-->
The POD database is public. Go to "Projects & Download" to download it.
<br/><br/>
<div id="result-gtin">

<table border="0">
	<tr>
		<td width="150px">
        	
			<img style="margin: 0px; border:#CCCCCC solid 1px" src="<?=$VALUE_IMG_GTIN?>" />
		</td>
		<td width="450px">
			<h4>GTIN data</h4>
			<b>GTIN Code</b> : <span style="font-family:'Courier New', Courier, monospace;"><?=$VALUE_GTIN_CD?></span><br/>
			<? if($VALUE_GCP_CD != "") {?> <b>GCP Code</b> &nbsp;: <span style="font-family:'Courier New', Courier, monospace;"> <?=str_pad($VALUE_GCP_CD,13,"*",STR_PAD_RIGHT)?> </span><br/><? } ?>
			<br/>
			<? if($VALUE_GTIN_NM != "") {?> <b>Commercial name</b> : <?=$VALUE_GTIN_NM?> <br/><? } ?>
            <? if($VALUE_PRODUCT_LINE != "") {?> <b>Product Line</b> : <?=$VALUE_PRODUCT_LINE?> <br/><? } ?>
            <? if($VALUE_REF_CD != "") {?> <b>Ref.</b> : <?=$VALUE_REF_CD?> <br/><? } ?>
            <br/>
			<? 
			if (($VALUE_M_G != 0) ||($VALUE_M_OZ != 0)) {
				echo "<b>Weight</b> : ";
			}  
			if ($VALUE_M_G != 0) {  
                if($VALUE_M_G >= 1000) {
                    echo $VALUE_PKG_UNIT." x ".($VALUE_M_G/1000)." kg"; 
                } else {
                    echo $VALUE_PKG_UNIT." x ".$VALUE_M_G." g"; 
                }
				if($VALUE_M_OZ != 0) { echo " / "; } else  { echo "<br/>"; }
            }  
            if ($VALUE_M_OZ != 0) { echo $VALUE_PKG_UNIT." x ".$VALUE_M_OZ." oz<br/>"; }  
			?>
			<? 
			if (($VALUE_M_ML != 0)||($VALUE_M_FLOZ != 0)) {
                echo "<b>Volume</b> : ";
            }           
			if ($VALUE_M_ML != 0) {
				if($VALUE_M_ML >= 1000) {
					echo $VALUE_PKG_UNIT." x ".($VALUE_M_ML/1000)." l"; 
				} else {
					echo $VALUE_PKG_UNIT." x ".$VALUE_M_ML." ml"; 
				}
				if ($VALUE_M_FLOZ != 0) { echo " / "; } else  { echo "<br/>"; }
            }  
            if ($VALUE_M_FLOZ != 0) { echo $VALUE_PKG_UNIT."x ".$VALUE_M_FLOZ." floz<br/>"; }  
			?>
			<? if ($VALUE_M_ABV != 0) { echo "<b>Alcohol</b> : ".$VALUE_M_ABV." % vol.<br/>"; } ?>	
            <? if ($VALUE_M_ABW != 0) { echo "<b>Alcohol</b> : ".$VALUE_M_ABW." % vol.<br/>"; } ?>	
		</td>

	</tr>
	<tr>

		<td>
			<img style="margin: 0px; border:#CCCCCC solid 1px" src="<?=$VALUE_IMG_BRAND?>" />
		</td>
		<td>
			<h4>Brand Data</h4>
			<? if ($VALUE_BRAND_NM != '') { ?> <b>Brand name</b> : <a href="product-brand-list-<?=str_pad($VALUE_BRAND_CD,8,"0",STR_PAD_LEFT)?>.html" ><?=$VALUE_BRAND_NM?></a> <? } else { ?> The brand will be assigned soon... <? } ?><br/>
            <? if ($VALUE_BRAND_TYPE_NM != '') { ?> <b>Brand type</b> : <?=$VALUE_BRAND_TYPE_NM?> <? } else { ?> The brand type will be assigned soon... <? } ?>
            <br/><br/>
            <? if ($VALUE_GROUP_NM != '') { ?> <b>Group</b> : <a href="product-group-list-<?=str_pad($VALUE_GROUP_CD,6,"0",STR_PAD_LEFT)?>.html" ><?=$VALUE_GROUP_NM?></a> <? } ?> 
            <br/><br/>
            <? if ($VALUE_BRAND_LINK != '') { ?> <b>Website</b> : <a href="http://<?=$VALUE_BRAND_LINK?>" target="_blank" rel="nofollow"><?=$VALUE_BRAND_LINK?></a> <? } ?>
            
		</td> 
	</tr>


	<tr>
    
		<td>
			<img style="margin: 0px; border:#CCCCCC solid 1px" src="<?=$VALUE_IMG_GPC?>" />
            
		</td>
		<td>
			<h4>GPC Classification</h4>
            
            <style>
			#tab-gpc td {
			padding:0px;	
			}
			</style>
            
            <div id="tab-gpc">
            <table border="0" cellspacing="0px" cellpadding="0px">
            <tr>
                <td width="70px;"><b>Segment</b> :</td>
                <td><? if ($VALUE_GPC_S_CD != '') { ?> <?=$VALUE_GPC_S_CD?> - <?=$VALUE_GPC_S_NM?> <? } else { ?>  soon... <? } ?></td>
            </tr>
            <tr>
            	<td><b>Family</b> :</td>
            	<td><? if ($VALUE_GPC_F_CD != '') { ?> <?=$VALUE_GPC_F_CD?> - <?=$VALUE_GPC_F_NM?> <? } else { ?>  soon... <? } ?></td>
            </tr>
            <tr>
            	<td><b>Class</b> :</td>
            	<td><? if ($VALUE_GPC_C_CD != '') { ?> <?=$VALUE_GPC_C_CD?> - <?=$VALUE_GPC_C_NM?> <? } else { ?>  soon... <? } ?></td>
            </tr>   
            <tr>
            	<td><b>Brick</b> :</td>
            	<td><? if ($VALUE_GPC_B_CD != '') { ?> <?=$VALUE_GPC_B_CD?> - <?=$VALUE_GPC_B_NM?> <? } else { ?>  soon... <? } ?></td>
            </tr>  
            </table>   
            </div>  
           
            
		</td>

	</tr>


<!--COUPER_ICI-->

<style>
#label {
	padding:0px;
	margin:	0px;
}

#label td {
	padding:0px;
	margin:	0px;
}

.border-label-1 {
	border-bottom: #666 solid 1px;
}

.border-label-2 {
	border-bottom: #666 solid 5px;
}

.border-label-3 {
	border-bottom: #666 solid 10px;
}

</style>

	<tr>
		<td>
			<img style="margin: 0px; border:#CCCCCC solid 1px" src="<DOSSIER_IMG>nutrition.jpg" />
		</td>
		<td>
			<h4>Nutrition Facts - U.S. Food and Drug Administration</h4>	
			<div class="label">            

            <b>Manufacturer sourcing</b> : <a href = "<?=$VALUE_SOURCE?>" target="_blank" rel="nofollow">Access to the source if information</b></a><br/>
            <b>Synchronization date</b> : <?=$VALUE_SYNC_DT?>					
						
                        <hr/>
                        
                        <table id="label" width="100%" ><tr><td style="font-size:30px"><b>Nutrition Facts</b></td></tr></table>
                        <table id="label" width="100%"  ><tr><td style="font-size:12px">Serving Size <?=$VALUE_SERV_SIZE?></td></tr></table>
                        <table id="label" width="100%" class="border-label-3" ><tr><td style="font-size:12px">Servings per Container about <?=$VALUE_SERV_CT?></td></tr></table>
                        
                        <!--
                        <table id="label" width="100%" class="border-label-3" ><tr><td style="font-size:30px"><b>Nutrition Facts</b></td></tr></table>
                        -->
                        
                        <table id="label" width="100%" class="border-label-1" style="font-size:11px"><tr><td><b>Amont Per Serving</b></td></tr></table>
						<table id="label" width="100%" class="border-label-2"><tr><td><b>Calories</b> : <?=$VALUE_CAL?></td><td align="right">Calories from fat : <?=$VALUE_CAL_FROM_FAT?></td></tr></table>
                        <table id="label" width="100%"><tr><td align="right" style="font-size:11px">% Daily Value*</td></tr></table>
                        <table id="label" width="100%"><tr><td><b>Total Fat</b>  <?=$VALUE_TOT_FAT_G?>g</td><td align="right"><?=$VALUE_TOT_FAT_DV?>%</td></tr></table>
                        <table id="label" width="100%"><tr><td>&nbsp;&nbsp;&nbsp; Saturated Fat <?=$VALUE_SAT_FAT_G?>g</td><td align="right"><?=$VALUE_SAT_FAT_DV?>%</td></tr></table>
						<table id="label" width="100%" class="border-label-1"><tr ><td >&nbsp;&nbsp;&nbsp; Trans Fat <?=$VALUE_TRANS_FAT_G?>g</td><td align="right">-</td></tr></table>
						<table id="label" width="100%" class="border-label-1"><tr ><td ><b>Cholosterol</b> <?=$VALUE_CHOL_MG?>mg</td><td align="right"><?=$VALUE_CHOL_DV?>%</td></tr></table>
                        <table id="label" width="100%" class="border-label-1"><tr ><td ><b>Sodium</b> <?=$VALUE_SOD_MG?>mg</td><td align="right"><?=$VALUE_SOD_DV?>%</td></tr></table>
						<table id="label" width="100%" class="border-label-1"><tr ><td ><b>Total Carbohydrate</b> <?=$VALUE_TOT_CARB_G?>g</td><td align="right"><?=$VALUE_TOT_CARB_DV?>%</td></tr></table>
                        <table id="label" width="100%" class="border-label-1"><tr ><td >&nbsp;&nbsp;&nbsp; Dietary Fiber <?=$VALUE_DIET_FIBER_G?>g</td><td align="right"><?=$VALUE_DIET_FIBER_DV?>%</td></tr></table>
						<table id="label" width="100%" class="border-label-1"><tr ><td >&nbsp;&nbsp;&nbsp; Sugars <?=$VALUE_SUGARS_G?>g</td><td align="right">-</td></tr></table>
                        <table id="label" width="100%" class="border-label-3"><tr ><td ><b>Protein</b> <?=$VALUE_PROTEIN_G?>g</td><td align="right">-</td></tr></table>
                        
                        <table id="label" width="100%" class="border-label-1"><tr ><td >Vitamin A </td><td align="right"><?=$VALUE_VITAMIN_A?>%</td></tr></table>
                        <table id="label" width="100%" class="border-label-1"><tr ><td >Vitamin C </td><td align="right"><?=$VALUE_VITAMIN_C?>%</td></tr></table>
                        <table id="label" width="100%" class="border-label-1"><tr ><td >Calcium </td><td align="right"><?=$VALUE_CALCIUM?>%</td></tr></table>
                        <table id="label" width="100%" class="border-label-1"><tr ><td >Iron </td><td align="right"><?=$VALUE_IRON?>%</td></tr></table>
                        
                        <table id="label" width="100%"><tr><td style="font-size:11px">* Percent Daily Values (DV) are based on a 2,000 calorie diet. </td></tr></table>
                      	<hr/>
						<B>INGREDIENTS</B> <?=$VALUE_INGREDIENTS?>
                        
             </div>
							




			
							
			
		</td>

	</tr>
<!--COUPER_ICI-->
	<tr>
		<td>
			<img style="margin: 0px; border:#CCCCCC solid 1px" src="<DOSSIER_IMG>gln.jpg" />
		</td>
		<td>
			<h4>GLN Data (Supply Chain)</h4>				

			<? if($VALUE_GLN_RETURN_CODE == 0 ) {  ?>
            
            	<? if($VALUE_GLN_CD == "") { ?>
                
                	GLN data will be assigned soon...
                
                <? } else { ?>
			
                    <b>GLN Code</b> : <span style="font-family:'Courier New', Courier, monospace;"><?=$VALUE_GLN_CD?></span><br/>
                    <b>GLN Name</b> : <?=$VALUE_GLN_NM?><br/>
                    <? if($VALUE_GLN_ADDR_02 != "") echo $VALUE_GLN_ADDR_02."<br/>"; ?>
                    <? if($VALUE_GLN_ADDR_03 != "") echo $VALUE_GLN_ADDR_03."<br/>"; ?>
                    <? if($VALUE_GLN_ADDR_04 != "") echo $VALUE_GLN_ADDR_04."<br/>"; ?>
                    <? if($VALUE_GLN_ADDR_POSTALCODE != "") echo $VALUE_GLN_ADDR_POSTALCODE; ?>
                    <? if($VALUE_GLN_ADDR_CITY != "") echo $VALUE_GLN_ADDR_CITY."<br/>"; ?>
                    <? if (file_exists(DOSSIER_IMG_COUNTRY.strtolower($VALUE_GLN_COUNTRY_ISO_CD).".png")) { ?> <img align="center" src="<?=DOSSIER_IMG_COUNTRY.strtolower($VALUE_GLN_COUNTRY_ISO_CD)?>.png" /> <? } ?> 
                    <?=$VALUE_GLN_COUNTRY_ISO_CD?><br/> 
                    
                <? } ?>

			<? } else {  ?>	

			<?
				$Erreurs = array(
					'0' => "No error",
					'1' => " Missing or invalid parameters",
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
			?>

				 GEPIR doesn't contain data for this GTIN<br/> -> Return Code <?=$VALUE_GLN_RETURN_CODE?> ( <?=$Erreurs[$VALUE_GLN_RETURN_CODE]?> )
			
			<? }  ?>					
			
		</td>

	</tr> 
</table>
</div>





