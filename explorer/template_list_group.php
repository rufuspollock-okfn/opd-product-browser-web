<img style="float: right; margin-left: 30px;" title="PSS product simple syndication" src="<DOSSIER_IMG>navigate_02.png" alt="pss product simple syndication" />
<h1>Navigate with Groups</h1>

The POD database is public. Go to "Projects & Download" to download it.<br/>
<br/><br/>

<div id="result-gtin">
<table>
<!--COUPER_ICI-->
</table>
<!--COUPER_ICI-->
	<tr>
    <!--COUPER_ICI-->
    </tr>
<!--COUPER_ICI-->
    	<td>
        <a href="product-group-list-<?=str_pad($VALUE_GROUP_CD,6,"0",STR_PAD_LEFT)?><?=EXTENSION?>">
			<? if (file_exists($VALUE_IMG)) { ?> 
                <img src="<DOSSIER_IMG>group/<?=str_pad($VALUE_GROUP_CD,6,"0",STR_PAD_LEFT)?>.jpg" border="0" width="125px" title="Group - <?=$VALUE_GROUP_NM?>" alt="Group - <?=$VALUE_GROUP_NM?>" /> 
            <? } else { ?> 
                <img style="margin: 0px; border:#CCCCCC solid 1px" src="<DOSSIER_IMG>coming-soon.jpg" border="0" width="125px" /> 
            <? } ?>
        </a>
        </td> 
<!--COUPER_ICI-->
    	<td>
        	<b><?=$VALUE_GROUP_NM?></b>
        </td>






