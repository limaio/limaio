<script type="text/javascript">
    function drawVisualization() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable([

<?php print $data; ?>

        ]);
      
        // Create and draw the visualization.
        new google.visualization.LineChart(document.getElementById('visualization')).
            draw(data, {curveType: "function",
            width: 500, height: 400,pointSize: 5,
            vAxis: {maxValue: 10}}
    );
    }
      

    google.setOnLoadCallback(drawVisualization);
</script>

<div id="visualization" style="width: 500px; height: 400px;"></div>
