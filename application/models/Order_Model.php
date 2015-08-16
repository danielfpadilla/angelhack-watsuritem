<?php
class Order_Model extends CI_Model {
    public $status = "PENDING";
    
    public $title = NULL;
    
    public $date = "";
    
    public $items = array();
    
    public $archive = 0;
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
            $order = (array_key_exists("order", $arguments)) ? $arguments["order"] : "descending";
            $tag = (array_key_exists("tag", $arguments)) ? $arguments["tag"] : "date";
            $ordering = $this->clusterpoint->ordering($tag, "en", $order);
            
            $query = $this->clusterpoint->term("0", "//archive");
            
            if(array_key_exists("customer", $arguments))
                $query = $this->clusterpoint->term($arguments["customer"], "//customer/id");
            else if(array_key_exists("assistant", $arguments))
                $query = $this->clusterpoint->term($arguments["assistant"], "//assistant/id");
            
            if(array_key_exists("status", $arguments))
                $query .= $this->clusterpoint->term($arguments["status"], "//status");
            
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
     * Register
     * Description
     */
    public function register()
    {
        $this->clusterpoint->connect();
        
        $id = uniqid();
        
        try
        {
            $this->date = time();
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
            
            $this->clusterpoint->api->updateSingle($this->id, $document);
        }
    }
    /**
     * Partial Update
     * Description
     */
    public function partial_replace($document = array())
    {
        if(array_key_exists("id", $document))
        {
            $this->clusterpoint->connect();
            $this->clusterpoint->api->partialReplaceSingle($document["id"], $document);
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
            $document = array("archive" => 1);
            
            $this->clusterpoint->api->partialReplaceSingle($this->id, $document);
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
