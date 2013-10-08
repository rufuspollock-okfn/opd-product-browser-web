<h1>Navigate with GPC - Product list by brand</h1>

The POD database is public. Go to "Projects & Download" to download it.

<br/><br/>

<div id="result-gtin">

            <table border="0" cellspacing="0px" cellpadding="0px">
            <tr>
                <td width="150px"><img style="margin: 0px; border:#CCCCCC solid 1px" src="<?=$VALUE_BRAND_IMG?>" title="<?=$VALUE_BRAND_NM?>" alt="<?=$VALUE_BRAND_NM?>" /></td>
                <td width="450px">
                	<h4>Brand</h4>
					<b>Brand name</b> : <?=$VALUE_BRAND_NM?><br/>
                    <b>Brand type</b> : <?=$VALUE_BRAND_TYPE_NM?><br/><br/> 
                    <? if($VALUE_GROUP_NM != "") { ?>
                    <b>Group</b> : <a  href="product-group-list-<?=str_pad($VALUE_GROUP_CD,6,"0",STR_PAD_LEFT)?>.html" ><?=$VALUE_GROUP_NM?></a><br/><br/> 
                    <? } ?>
                    <b>Website</b> : <a href="http://<?=$VALUE_BRAND_LINK?>" target="_blank" rel="nofollow"><?=$VALUE_BRAND_LINK?></a><br/>  
                </td>
            </tr>
            </table>
            <br/><br/>

    <table>
	<!--COUPER_ICI-->
        <tr>
            <td width="150px">
            
                <?
                if($VALUE_NUTRI_FLAG == 1) {
				?>
                	<form name="formulaire" enctype="multipart/form-data" method="post" action="search/" >
                    	<input name="gtin" type="hidden" value="<?=$VALUE_GTIN_CD?>" />  
                        
                <?
					}
				?>                
            
					<? if (file_exists($VALUE_GTIN_IMG)) { ?> 
                        <img style="margin: 0px; border:#CCCCCC solid 1px" src="<?=$VALUE_GTIN_IMG?>" alt="<?=$VALUE_BRAND_NM?> - <? if ($VALUE_PRODUCT_LINE != '') echo $VALUE_PRODUCT_LINE." - "; ?><?=$VALUE_GTIN_NM?> <?=$VALUE_GTIN_CD?> <?=$VALUE_UPC_CD?>" title="<?=$VALUE_BRAND_NM?> - <? if ($VALUE_PRODUCT_LINE != '') echo $VALUE_PRODUCT_LINE." - "; ?><?=$VALUE_GTIN_NM?> <?=$VALUE_GTIN_CD?> <?=$VALUE_UPC_CD?> " />
                    <? } else { ?> 
                        <img style="margin: 0px; border:#CCCCCC solid 1px" src="<DOSSIER_IMG>coming-soon.jpg" /> 
                    <? } ?>
                </td>
                <td width="450px">
                    <img style="float: right; margin-left: 20px;width:50px;" src="<?=$VALUE_GPC_S_IMG?>" alt="<?=$VALUE_GPC_S_NM?>" /> 
                    <h4><? if ($VALUE_PRODUCT_LINE != '') echo "<b>".$VALUE_PRODUCT_LINE."</b> - "; ?><?=$VALUE_GTIN_NM?></h4>
                    
                     <? if($VALUE_REG_C != "") {?> <b>Registration</b> : <img style="margin-bottom:-1px;" src="<DOSSIER_IMG>country/<?=strtolower($VALUE_REG_C)?>.png" /> <?=$VALUE_REG_N?> <br/><? } ?>  
                    <b>GTIN Code </b> : <span style="font-family:'Courier New', Courier, monospace;"><?=$VALUE_GTIN_CD?> <?=$VALUE_UPC_CD?> </span>  <br/>
                    <? if($VALUE_GCP_CD != "") {?> <b>GCP Code</b> &nbsp;: <span style="font-family:'Courier New', Courier, monospace;"> <?=str_pad($VALUE_GCP_CD,13,"*",STR_PAD_RIGHT)?> </span>

                   		<br/>  
                    <? } ?>
                    <br/>
                    <? if($VALUE_GTIN_NM != "") {?> <b>Commercial name</b> : <?=$VALUE_GTIN_NM?> <br/><? } ?>
                    <? if($VALUE_PRODUCT_LINE != "") {?> <b>Product line</b> : <?=$VALUE_PRODUCT_LINE?> <br/><? } ?> 

 						<?
                        if($VALUE_NUTRI_FLAG == 1) {
                        ?>
                           <div style="float:right;"><input type="button" class="search-bouton" onclick="submit()" value="Access to Nutrition Facts" style="font-size:12px;width:160px;margin:0px;cursor: pointer; cursor: hand; "/> </div>
            
                        <?
                            }
                        ?>   
                      
                    <? if (($VALUE_M_G != 0) ||($VALUE_M_OZ != 0)) {
                        echo "<b>Weight</b> : ";
                    }  ?>                       
                    <? if ($VALUE_M_G != 0) {
                        if($VALUE_M_G >= 1000) {
                            echo $VALUE_PKG_UNIT." x ".($VALUE_M_G/1000)." kg"; 
                        } else {
                            echo $VALUE_PKG_UNIT." x ".$VALUE_M_G." g"; 
                        }
                        if ($VALUE_M_OZ != 0) { echo " / "; } else  { echo "<br/>"; }
                    }  ?>
                    <? if ($VALUE_M_OZ != 0) { echo $VALUE_PKG_UNIT." x ".$VALUE_M_OZ." oz<br/>"; }  ?>
                    <? if (($VALUE_M_ML != 0)||($VALUE_M_FLOZ != 0)) {
                        echo "<b>Volume</b> : ";
                    }  ?>
                    <? if ($VALUE_M_ML != 0) {
                        if($VALUE_M_ML >= 1000) {
                            echo $VALUE_PKG_UNIT." x ".($VALUE_M_ML/1000)." l"; 
                        } else {
                            echo $VALUE_PKG_UNIT." x ".$VALUE_M_ML." ml"; 
                        }
                        if ($VALUE_M_FLOZ != 0) { echo " / "; } else  { echo "<br/>"; }
                    }  ?>
                    <? if ($VALUE_M_FLOZ != 0) { echo $VALUE_PKG_UNIT." x ".$VALUE_M_FLOZ." floz<br/>"; }  ?>
                    <? if ($VALUE_M_ABV != 0) { echo "<b>Alcohol</b> : ".$VALUE_M_ABV." % vol.<br/>"; } ?>	
                    <? if ($VALUE_M_ABW != 0) { echo "<b>Alcohol</b> : ".$VALUE_M_ABW." % vol.<br/>"; } ?>	
                    

                     
                    
                    
                <?
                if($VALUE_NUTRI_FLAG == 1) {
				?>
                	</form>
                        
                <?
					}
				?>   
            </td>
    
        </tr>
    <!--COUPER_ICI-->   
    </table>
</div>







