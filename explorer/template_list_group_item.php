<h1>Browse by Groups - Brand list</h1>

The POD database is public. Go to "Projects & Download" to download it.

<br/><br/>

<div id="result-gtin">

            <table border="0" cellspacing="0px" cellpadding="0px">
            <tr>
                <td width="150px"><img style="margin: 0px; border:#CCCCCC solid 1px" src="<?=$VALUE_GROUP_IMG?>" title="<?=$VALUE_GROUP_NM?>" alt="<?=$VALUE_GROUP_NM?>" onerror="this.src='images/coming-soon.jpg';"  /></td>
                <td width="450px">
                	<h4>Group</h4>
					<b>Group name</b> : <?=$VALUE_GROUP_NM?><br/><br/>
                    <b>Website</b> : <a href="http://<?=$VALUE_GROUP_LINK?>" target="_blank" rel="nofollow"><?=$VALUE_GROUP_LINK?></a><br/>  
                    <br/>
                    <img src="images/35px-Wikipedia-logo.png" /> <a href="http://en.wikipedia.org/wiki/<?=$VALUE_GROUP_WIKI_EN?>" target="_blank" rel="nofollow">See the article on Wikipedia</a><br/> 
                </td>
            </tr>
            </table>   
            <br/><br/>

    <table>
	<!--COUPER_ICI-->
        <tr>
            <td width="150px">
              
                	<a href="product-brand-list-<?=str_pad($VALUE_BRAND_CD,8,"0",STR_PAD_LEFT)?>.html" > 
                    <img style="margin: 0px; border:#CCCCCC solid 1px" src="<?=$VALUE_BRAND_IMG?>" alt="<?=$VALUE_BRAND_NM?>" title="<?=$VALUE_BRAND_NM?>" onerror="this.src='images/coming-soon.jpg';"  />
                    </a>
            </td>
            <td width="450px">
                <h4><?=$VALUE_BRAND_NM?></h4>
                
                <? if($VALUE_BRAND_NM != "") {?> <b>Brand name</b> : <?=$VALUE_BRAND_NM?> <br/><? } ?>
                <br/><br/>
                >> <a href="product-brand-list-<?=str_pad($VALUE_BRAND_CD,8,"0",STR_PAD_LEFT)?>.html" > Voir la liste des produits </a>
                
            </td>
    
        </tr>
    <!--COUPER_ICI-->   
    </table>
</div>







