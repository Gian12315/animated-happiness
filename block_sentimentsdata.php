<?php
require_once("vendor/autoload.php");
require_once("connection.php");


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

        $conn = getConnection();

        echo "Eso tilin";
        
        $output = '
  <script src="https://unpkg.com/htmx.org@1.9.10"></script>
  <h3>Resultados de los sentimientos</h3>
  <span class="htmx-indicator">
    Buscando...
  </span>
  </h3>

  <input class="form-control" type="search"
         name="search" placeholder="Busca..."
         hx-post="/moodle/blocks/sentimentsdata/api.php"
         hx-trigger="input changed delay:500ms, search"
         hx-target="#sentiments-data"
         hx-indicator=".htmx-indicator">

  <table class="table">
  <thead>
  <tr>
  <th> Username </th>
  <th> Sentiment </th>
  <th> Page </th>
  <th> Timestamp </th>
  </tr>
  </thead>
  <tbody id="sentiments-data">
  </tbody>
  </table>
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
