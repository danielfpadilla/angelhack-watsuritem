<?php
require_once(APPPATH . "/third_party/clusterpoint/cps_simple.php");

// FB API HERE
class Customer_Model extends CI_Model {
    $user = NULL;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Clusterpoint");
    }
    /**
     * Register
     * Description
     */
    public function register()
    {
        $this->clusterpoint->connect();
        
        $id = uniqid();
        
        try
        {
            $document = get_object_vars($this);
            $this->clusterpoint->api->insertSingle($id, $document);
        }
        catch(CPS_Exception $e)
        {
            throw $e;
        }
    }
    /**
     * Instantiate
     * Description
     */
    public function instantiate($row = array())
    {
        foreach($row AS $attribute => $content)
        {
            if(property_exists($this, $attribute))
                $this->$attribute = $content;
        }
    }
}
