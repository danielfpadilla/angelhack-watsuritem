<?php 
require(APPPATH."/libraries/REST_Controller.php");
 
class Api extends REST_Controller {
    /**
     * Customer Login
     * Description
     */
    public function customer_login_get()
    {
        print_r($this->get());
    }
    /**
     * Create Order
     * Description
     */
    public function order_post()
    {
        $this->load->model("Order_Model");
        
        $order = new $this->Order_Model;
        
        $order->instantiate($this->post());
        $order->register();
    
        $this->response(array("error" => ""));
    }
    
    public function order_put()
    {
        
    }
    
    
}
?>
