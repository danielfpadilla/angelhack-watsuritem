<?php
class Order_Model extends CI_Model {
    public $customer_id = NULL;
    
    public $title = NULL;
    
    public $date = "";
    
    public $items = array();
    /**
     * Class Constructor
     * Description
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->library("Clusterpoint");
    }
    /**
     * Get
     * Description
     */
    public function get($arguments = array())
    {
        $this->clusterpoint->connect();
        
        try
        {
            $documents = (array_key_exists("get", $arguments)) ? $arguments["get"] : 20;
            $offset = (array_key_exists("starting", $arguments)) ? $arguments["starting"] : 0;
            $ordering = (array_key_exists("order", $arguments)) ? $arguments["order"] : "descending";
            $ordering = $this->clusterpoint->ordering("date", "en", $ordering);
            
            $query = "*";
            if(array_key_exists("customer", $arguments))
                $query = $this->clusterpoint->term($arguments["customer"], "//customer/id");
            
            $documents = $this->clusterpoint->api->search($query, $offset, $documents, array(), $ordering);
            
            return $documents;
        }
        catch(CPS_Exception $e)
        {
            throw $e;
        }
    }
    /**
     * Get By ID
     * Description
     *
     * @param string $id The order ID.
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
     * Get By Customer
     * Description
     */
    public function get_by_customer($customer_id = NULL, $documents = 20, $starting = 0, $ordering = "descending")
    {
        $this->clusterpoint->connect();
        
        try
        {
            $query = $this->clusterpoint->term("55cf3825baa38", "//document/customer/id");
            $documents = $this->clusterpoint->api->search($query, $starting, $documents, array(), $ordering);
            
            return $documents;
        }
        catch(CPS_Exception $e)
        {
            throw $e;
        }
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
     * Delete
     * Description
     */
    public function delete()
    {
        if($this->id)
        {
            $this->clusterpoint->connect();
            $this->clusterpoint->api->delete($this->id);
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
