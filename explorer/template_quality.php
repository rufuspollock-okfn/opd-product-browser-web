
    
    <h1>POD Database Quality</h1>

	<form name="formulaire" enctype="multipart/form-data" method="post" action="data-quality/" >	
		<select name="s">
        	<option value="1" <? if( $VALUE_S == 1) echo "selected"; ?> > GCP - GEPIR Return code</option>
            <option value="2" <? if( $VALUE_S == 2) echo "selected"; ?> > GTIN - GPC Segment</option>
            <option value="3" <? if( $VALUE_S == 3) echo "selected"; ?> > GTIN - Brand</option>
        </select>
		<input type="button" class="search-bouton"  onclick="submit()" value=">" /> 	
	</form>
    <br/>
    Data provded by icecat.fr are out of scope.
    <hr/>
   	

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
	<script type="text/javascript">
    $(function () {
        var chart;
        $(document).ready(function() {
            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'container',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: '<?=$VALUE_TITRE?>'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                    percentageDecimals: 0
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: '#000000',
                            formatter: function() {
                                return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                            }
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: [
                        <?=$VALUE_PIE?>
                    ]
                }]
            });
        });
        
    });
	</script>

	<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>


<!--COUPER_ICI-->    
            <table>
            <!--COUPER_ICI-->
                <tr>  
                    <td><?=$VALUE_CD?></td>
                    <td><?=$VALUE_NM?></td>
                </tr>
            <!--COUPER_ICI-->
            </table>
