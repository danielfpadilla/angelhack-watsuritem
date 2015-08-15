<?php 
require(APPPATH."/libraries/REST_Controller.php");
 
class Api extends REST_Controller {
    /**
     * Customer Login
     * Description
     */
    public function customer_login_get()
    {
        $this->response($this->get());
    }
    /**
     * Create Order
     * Description
     */
    public function order_post()
    {
        $this->load->model("Order_Model");
        
        $order = new $this->Order_Model;
        
        $order->instantiate(array(
    "title" => "Hello Angelhack", 
    "date" => "2015-08-15",  
    "items" => array(
            array(
                    "quantity" => 1,
                     "description" => "Redbull"
            ),  
            array(
                    "quantity" => 1, 
                    "description" => "pizza"
            )
    )
));
        $id = $order->register();
    
        $this->response(array("status" => "success", "id" => $id));
    }
    /**
     * Update Order
     * Description
     */
    public function order_put()
    {  
        if( array_key_exists("id", $this->get()) )
        {
            $this->load->model("Order_Model");
            $order = new $this->Order_Model;
            
            $order->instantiate(array(
    "title" => "Hello Angelhack Davao 2015", 
    "date" => "2015-08-15",  
    "items" => array(
            array(
                    "quantity" => 1,
                     "description" => "Redbull++"
            ),  
            array(
                    "quantity" => 1, 
                    "description" => "Pizza Much"
            )
    )
));
        $order->id = $this->get("id");
        
        $order->update();
        }
        
        
        
    }
}
?>
