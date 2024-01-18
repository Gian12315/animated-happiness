<?php
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
	
	$this->content->text = getData();
	
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
