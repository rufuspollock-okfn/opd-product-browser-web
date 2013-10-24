<img style="float: right; margin-left: 30px;" title="Data Quality" src="images/DataQuality.png" alt="Data Quality" />
    
    <h1>Database Quality</h1>

	<ul>
    <li>GCP - <a href="data-quality-1.html">GEPIR Return code</a></li>
   <!-- <li>GCP - <a href="data-quality-4.html">Length per prefix</a></li>-->
    <li>GTIN - <a href="data-quality-2.html">GPC Segment</a></li>
    <li>GTIN - <a href="data-quality-3.html">Brand</a></li>
    </ul>

<!--COUPER_ICI-->  
    <h1><?=$VALUE_H1?></h1>
    <a href="data-quality/"><< Return to the Data Quality menu</a><br /><br />

   	

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
