<?php
require_once(APPPATH . "/third_party/clusterpoint/cps_simple.php");

class Clusterpoint {
    protected $ci = NULL;
    
    protected $connection = NULL;
    
    public $api = NULL;
    
    public function __construct()
    {
        $this->ci =& get_instance();
    }
    
    public function connect()
    {
        if($this->connection == NULL)
        {
            $this->ci->load->config("clusterpoint");
            
            $this->connection = new CPS_Connection(
                new CPS_LoadBalancer($this->ci->config->item("connection_strings")),
                $this->ci->config->item("database"),
                "USERNAME",
                "PASSWORD",
                $this->ci->config->item("document_root_xpath"),
                $this->ci->config->item("document_id_xpath"),
                array(
                    "account" => $this->ci->config->item("account")
                )
            );
            
            $this->connection->setHMACKeys($this->ci->config->item("user_key"), $this->ci->config->item("sign_key"));
        
            $this->api = new CPS_Simple($this->connection);
        }
    }
    
    public function ordering($tag = NULL, $lang = "en", $order = NULL)
    {
        return CPS_StringOrdering($tag, $lang, $order);
    }
    
    public function term($term = NULL, $xpath = NULL, $escape = TRUE)
    {
        return CPS_Term($term, $xpath, $escape);
    }
}
