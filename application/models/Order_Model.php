<?php
class Order_Model extends CI_Model {
    public $title = NULL;
    
    public $date = "";
    
    public $items = array();
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
        
        return $id;
    }
    /**
     * Update
     * Description
     */
    public function update()
    {
        if($this->id)
        {
            $this->clusterpoint->connect();
            $document = get_object_vars($this);
            
            unset($document["id"]);
            
            $this->clusterpoint->api->updateSingle($this->id, $document);
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
