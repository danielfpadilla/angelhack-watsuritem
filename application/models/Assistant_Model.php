<?php
require_once(APPPATH . "/third_party/clusterpoint/cps_simple.php");

class Assistant extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Clusterpoint");
    }
    
    public function get()
    {
        
    }
}
