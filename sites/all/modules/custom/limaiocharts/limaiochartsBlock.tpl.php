<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load('visualization', '1', {packages: ['corechart']});
</script>
<script type="text/javascript">
    function drawVisualization() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable([

<?php print $data; ?>
                        
        ]);
      
        // Create and draw the visualization.
        new google.visualization.LineChart(document.getElementById('visualization')).
            draw(data, {curveType: "function",
            width: 500, height: 400,pointSize: 5}
    );
    }
      
    google.setOnLoadCallback(drawVisualization);
    
    
//      var dataView = new google.visualization.DataView(dataTable);
//      dataView.setColumns([{calc: function(data, row) { return data.getFormattedValue(row, 0); }, type:'string'}, 1]);
//
//      var chart = new google.visualization.LineChart(document.getElementById('containerID'));
//      var options = {
//        width: 400, height: 240,
//        legend: 'none',
//        pointSize: 5
//      };
//      chart.draw(dataView, options);
    
</script>

<div id="visualization" style="width: 500px; height: 400px;"></div>
