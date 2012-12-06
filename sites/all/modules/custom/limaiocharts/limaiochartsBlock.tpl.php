<script type="text/javascript">
    function <?php print $name ?>() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable([

<?php print $data; ?>
                        
        ]);
      
        // Create and draw the visualization.
        new google.visualization.LineChart(document.getElementById('<?php print $name ?>')).
            draw(data, {curveType: "function",
            width: 250, height: 200,pointSize: 5,
            vAxis: {maxValue: 36}}
    );
    }
      
    google.setOnLoadCallback(<?php print $name ?>);
    
    
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

<div id="<?php print $name ?>" style="width: 300px; height: 200px;"></div>
