<script type="text/javascript">
    function drawVisualization() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable([

<?php print $data; ?>

        ]);
      
        // Create and draw the visualization.
        new google.visualization.LineChart(document.getElementById('visualization')).
            draw(data, {curveType: "function",
            width: 800, height: 700,pointSize: 5,
            vAxis: {maxValue: 30}}
    );
    }
      

    google.setOnLoadCallback(drawVisualization);
</script>

<div id="visualization" style="width: 500px; height: 400px;"></div>
