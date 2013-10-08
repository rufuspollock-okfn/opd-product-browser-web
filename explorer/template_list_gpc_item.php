<h1>Navigate with GPC - Product list</h1>

The POD database is public. Go to "Projects & Download" to download it.

<br/><br/>

<div id="result-gtin">

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
</div>







