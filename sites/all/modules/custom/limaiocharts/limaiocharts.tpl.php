<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load('visualization', '1', {packages: ['corechart']});
</script>
<script type="text/javascript">
    function drawVisualization() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable([
            //tx.tid,n.nid,from_undate.field_date_value,
            //temp.field_temperature_value,
            //hum.field_humidity_value,noise.field_noise_value, uv.field_uv_value,dust.field_dust_value
            ['Fecha', 'Temperatura','Humedad','Ruido','UV','Polvo'],

<?php while ($value = $data->fetch()): ?>                
    <?php print "['" . $value->fecha . "'," . $value->temp . "," . $value->humedad . "," . $value->ruido . "," . $value->radiacion . "," . $value->polvo . "],"; ?>
<?php endwhile; ?>          
                        
        ]);
      
        // Create and draw the visualization.
        new google.visualization.LineChart(document.getElementById('visualization')).
            draw(data, {curveType: "function",
            width: 500, height: 400,
            vAxis: {maxValue: 10}}
    );
    }
      

    google.setOnLoadCallback(drawVisualization);
</script>

<div id="visualization" style="width: 500px; height: 400px;"></div>
