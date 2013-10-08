<h1>Navigate with GLN - Product list</h1>

The POD database is public. Go to "Projects & Download" to download it.

<br/><br/>

<div id="result-gtin">
 	<h2>GLN</h2>	
    <table border="0">
        <tr>
            <td width="150px">
                <? if (file_exists($VALUE_GLN_IMG)) { ?> <img style="margin: 0px; border:#CCCCCC solid 1px" src="<?=$VALUE_GLN_IMG?>" /> <? } else { ?> <img style="margin: 0px; border:#CCCCCC solid 1px" src="images/coming-soon.jpg" /> <? } ?>
            </td>
            <td width="450px">
               			
    			<h4><?=$VALUE_GLN_NM?></h4>
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

<!--COUPER_ICI-->

 	<h2>BRANDS</h2>	

<!--COUPER_ICI-->
    <table>
	<!--COUPER_ICI-->
	<tr>
		<td width="150px">
			<? if (file_exists($VALUE_BRAND_IMG)) { ?> <img style="margin: 0px; border:#CCCCCC solid 1px" src="<?=$VALUE_BRAND_IMG?>" /> <? } else { ?> <img style="margin: 0px; border:#CCCCCC solid 1px" src="images/coming-soon.jpg" /> <? } ?>
		</td>
		<td width="450px">
			<h4><?=$VALUE_BRAND_NM?></h4>
			<? if ($VALUE_BRAND_NM != '') { ?> <b>Brand name</b> : <?=$VALUE_BRAND_NM?> <? } else { ?> The brand will be assigned soon... <? } ?><br/>
            <? if ($VALUE_BRAND_TYPE_NM != '') { ?> <b>Brand type</b> : <?=$VALUE_BRAND_TYPE_NM?> <? } else { ?> The brand type will be assigned soon... <? } ?>
            <br/><br/>
            <? if ($VALUE_BRAND_LINK != '') { ?> <b>Website</b> : <a href="http://<?=$VALUE_BRAND_LINK?>" target="_blank" rel="nofollow"><?=$VALUE_BRAND_LINK?></a> <? } ?>
		</td> 
	</tr>
    <!--COUPER_ICI-->   
    </table>

<!--COUPER_ICI-->
 	<h2>PRODUCTS</h2>	
<!--COUPER_ICI-->
    <table>
	<!--COUPER_ICI-->
        <tr>
            <td width="150px">
                <? if (file_exists($VALUE_GTIN_IMG)) { ?> <img style="margin: 0px; border:#CCCCCC solid 1px" src="<?=$VALUE_GTIN_IMG?>" /> <? } else { ?> <img style="margin: 0px; border:#CCCCCC solid 1px" src="images/coming-soon.jpg" /> <? } ?>
            </td>
            <td width="450px">
                <h4><?=$VALUE_BRAND_NM?> <? if ($VALUE_PRODUCT_LINE != '') echo " - ".$VALUE_PRODUCT_LINE; ?> - <?=$VALUE_GTIN_NM?></h4>
                <b>GTIN Code</b> : <span style="font-family:'Courier New', Courier, monospace;"><?=$VALUE_GTIN_CD?></span><br/>
                <? if($VALUE_GCP_CD != "") {?> <b>GCP Code</b> &nbsp;: <span style="font-family:'Courier New', Courier, monospace;"> <?=str_pad($VALUE_GCP_CD,13,"*",STR_PAD_RIGHT)?> </span><br/><? } ?>
                <br/>
                <? if($VALUE_GTIN_NM != "") {?> <b>Commercial name</b> : <?=$VALUE_GTIN_NM?> <br/><? } ?>
                <? if($VALUE_BRAND_NM != "") {?> <b>Brand</b> : <?=$VALUE_BRAND_NM?> <br/><? } ?>
                <? if($VALUE_PRODUCT_LINE != "") {?> <b>Product line</b> : <?=$VALUE_PRODUCT_LINE?> <br/><? } ?>           
                <? if ($VALUE_M_G != 0) {
					if($VALUE_M_G >= 1000) {
						echo "<b>Weight</b> : ".$VALUE_PKG_UNIT."x ".($VALUE_M_G/1000)."kg<br/>"; 
					} else {
						echo "<b>Weight</b> : ".$VALUE_PKG_UNIT."x ".$VALUE_M_G."g<br/>"; 
					}
				}  ?>
                <? if ($VALUE_M_OZ != 0) { echo "<b>Weight</b> : ".$VALUE_PKG_UNIT."x ".$VALUE_M_OZ."oz<br/>"; }  ?>
                <? if ($VALUE_M_ML != 0) {
					if($VALUE_M_ML >= 1000) {
						echo "<b>Volume</b> : ".$VALUE_PKG_UNIT."x ".($VALUE_M_ML/1000)."l<br/>"; 
					} else {
						echo "<b>Volume</b> : ".$VALUE_PKG_UNIT."x ".$VALUE_M_ML."ml<br/>"; 
					}
				}  ?>
                <? if ($VALUE_M_FLOZ != 0) { echo "<b>Volume</b> : ".$VALUE_PKG_UNIT."x ".$$VALUE_M_FLOZ."oz<br/>"; }  ?>
                <? if ($VALUE_M_ABV != 0) { echo "<b>Alcohol</b> : ".$VALUE_M_ABV." % vol.<br/>"; } ?>	
                <? if ($VALUE_M_ABW != 0) { echo "<b>Alcohol</b> : ".$VALUE_M_ABW." % vol.<br/>"; } ?>	
            </td>
    
        </tr>
    <!--COUPER_ICI-->   
    </table>
<!--COUPER_ICI-->
</div>







