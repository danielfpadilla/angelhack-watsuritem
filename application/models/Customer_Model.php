<?php
require_once(APPPATH . "/third_party/clusterpoint/cps_simple.php");

// FB API HERE
class Customer_Model extends CI_Model {
    $username = NULL;
    
    $password = NULL;
    /**
     * Login
     * 
     */
    public function login($username = NULL, $password = NULL, $using = NULL)
    {
        switch($using)
        {
            case "fb":
                //  
                break;
        }
    }
}
