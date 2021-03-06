<?php
require_once(APPPATH . "/third_party/clusterpoint/cps_simple.php");

class Assistant_Model extends CI_Model {
    public $id = NULL;
    
    public $name = array();
    
    public $access = array();
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Clusterpoint");
    }
    /**
     * Get By Code
     * Description
     *
     * @return object The assistant.
     */
    public function get_by_code($code = NULL)
    {
        $this->clusterpoint->connect();
        
        try
        {
            $query = $this->clusterpoint->term($code, "//access/code");
            $documents = $this->clusterpoint->api->search($query, 0, 1, array(), "descending");
        
            return (count($documents)) ? array_shift($documents) : NULL;
        }
        catch(CPS_Exception $e)
        {
            throw $e;
        }
    }
}
