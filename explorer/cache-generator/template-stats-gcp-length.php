 <h1>GCP - Length per prefix</h1>
 
 This listing is an analysis of GS1 GCP (first digits of the barcode which indicates the owner). You can downlaod the GCP rules <a href="docs/pod_gs1_gcp_rules.xlsx">in Excel format</a> and download Open GEPIR just <a href="download/">here</a>.
 <br/><br/>
 Green: all GCP have been scanned<br/>
 Gray: too many GCP
 <br/><br/>   
 
    <a href="data-quality/"><< Return to the Data Quality menu</a><br /><br />
    <table>
        <tr>
            <td style="padding:5px"><b>Prefix</b></td>
            <td style="padding:5px"><b>GCP <br />Length</b></td>
            <td style="padding:5px;width:60px;"><b>Number of GCP  with a GEPIR Return Code = 0</b></td>
            <td style="padding:5px;width:60px;"><b>Number of GCP</b></td>
            <td style="padding:5px;width:60px;""><b>%</b></td>
            <td style="padding:5px;width:200px;"><b>GS1 Member Organization</b></td>
            <td style="padding:5px;width:60px;""><b>Number of barcode that can be assigned (per GCP)</b></td>
        </tr>
 <!--COUPER_ICI-->       
        <tr>
			<td style="padding:2px;" align="right"><?=$VALUE_PREFIX?></td>
			<td style="padding:2px;" align="right"><?=$VALUE_LENGTH?></td>
			<td style="padding:2px;" align="right"><?=$VALUE_NB_RC_0?></td>
			<td style="padding:2px;<?=$VALUE_STYLE_NB?>" align="right"><?=$VALUE_NB?></td>
			<td style="padding:2px;<?=$VALUE_STYLE_PERC?>" align="right"><?=$VALUE_PERC?> %</td>
			<td style="padding:2px;" ><img align="center" style="margin-bottom:7px;margin-right:5px;margin-left:10px;" src="<?=$VALUE_IMG_COUNTRY?>.png" /> <?=$VALUE_PREFIX_NM?></td>
			<td style="padding:2px;" align="right"><?=$VALUE_NB_MAX_PRODUCT?></td>
		</tr>
 <!--COUPER_ICI-->   
	</table>






