<?php
require_once(APPPATH . "/third_party/clusterpoint/cps_simple.php");

// FB API HERE
class Customer_Model extends CI_Model {
    public $id = NULL;
    
    public $name = NULL;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Clusterpoint");
    }
    /**
     * Get By ID
     * Description
     *
     * @param string $id The customer ID.
     */
    public function get_by_id($id = NULL)
    {
        $this->clusterpoint->connect();
        try
        {
            $document = $this->clusterpoint->api->retrieveSingle($id);
        }
        catch(CPS_Exception $e)
        {
            throw $e;
        }
        
        return $document;
    }
    /**
     * Register
     * Description
     */
    public function register()
    {
        $this->clusterpoint->connect();
        
        try
        {
            $document = get_object_vars($this);
            $this->clusterpoint->api->insertSingle($this->id, $document);
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
