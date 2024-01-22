<?php
require_once("api.php");


class block_sentimentsdata extends block_base {
    public function init() {
        $this->title = get_string('sentimentsdata', 'block_sentimentsdata');
    }

    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass;
        $output = "";
        
        $contenido = getDataRows();
                
        $output = '
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
  
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="https://code.jscharting.com/latest/jscharting.js"></script> 
<script src="https://code.jscharting.com/latest/modules/types.js"></script> 

  <h3>Resultados de los sentimientos</h3>
<div id="chartDiv" style="max-width: 500px; height:
300px;" ></div>

  <table class="table" id="myTable">
  <thead>
  <tr>
  <th> Username </th>
  <th> Sentiment </th>
  <th> Page </th>
  <th> Timestamp </th>
  </tr>
  </thead>
  <tbody>' . $contenido . '
  </tbody>
  </table>

<script>
$(document).ready(function() {
    var table = $("#myTable").DataTable();


    function updateTable() {
    var data = table.rows({search: "applied"}).data();
    var sentiments_count = {};

    for (var i = 0; i < data.length; i++) {
    var ele = data[i];
    if (sentiments_count[ele[1]]) {
        sentiments_count[ele[1]] += 1;
    } else {
        sentiments_count[ele[1]] = 1;
    }
    };

    var pointss = [];

    for (const [key, value] of Object.entries(sentiments_count)) {
      pointss.push({name: key, y: value});
    }

return pointss;
    }

let chart = new JSC.Chart("chartDiv", {
   type: "pie",
   series: [
      {points:updateTable()}
   ]
});

table.on( "search.dt", function () {
chart = new JSC.Chart("chartDiv", {
   type: "pie",
   series: [
      {points:updateTable()}
   ]
 });
});
});
</script>
';

        
	
	    $this->content->text = $output;
	
        $this->content->footer = "";

        return $this->content;
    }

    public function specialization() {
        if (isset($this->config)) {
            if (empty($this->config->title)) {
                $this->title = get_string('defaulttitle', 'block_sentimentsdata');            
            } else {
                $this->title = $this->config->title;
            }
        }
    }

    public function instance_allow_multiple() {
      return true;
    }

// public function applicable_formats() {
//   return array('site-index' => true);
// }
}
