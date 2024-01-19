<?php
require_once("vendor/autoload.php");
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
        // $this->content->text = "The content of our SimpleHTML block!<b>Hello</b>";

        $output = "";
        
        $contenido = getHTML();
                
        $output = '
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
  
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

  <h3>Resultados de los sentimientos</h3>
  <span class="htmx-indicator">
    Buscando...
  </span>
  </h3>

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

    var data = table.rows().data();

});
</script>
';

        
	
	    $this->content->text = $output;
	
        $this->content->footer = "Footer here...";

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
