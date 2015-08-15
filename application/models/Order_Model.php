<?php
require_once(APPPATH . "/third_party/clusterpoint/cps_simple.php");

class Order_Model extends CI_Model {
    public $title = NULL;
    
    public $date = "";
    
    public $items = array();
    /**
     * Register
     * Description
     */
    public function register()
    {
        $this->load->config("clusterpoint");
        
        $cps_conn = new CPS_Connection(
            new CPS_LoadBalancer($this->config->item("connection_strings")),
            $this->config->item("database"),
            "USERNAME",
            "PASSWORD",
            $this->config->item("document_root_xpath"),
            $this->config->item("document_id_xpath"),
            array("account" => $this->config->item("account"))
        );
        
        $cps_conn->setHMACKeys($this->config->item("user_key"), $this->config->item("sign_key"));
        
        $cps_simple = new CPS_Simple($cps_conn);
        $cps_simple->insertSingle(uniqid(), get_object_vars($this));
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
