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
     * 
     */
    public function order_get()
    {
        
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
            
            $order->instantiate($this->put());
            $order->id = $this->get("id");
        
            $order->update();
        }
    }
    /**
     * Delete Order
     * Description
     */
    public function order_delete()
    {
        if( array_key_exists("id", $this->get()) )
        {
            $this->load->modal("Order_Model");
            
            $order = new $this->Order_Model;
            
            $order->id = $this->get("id");
            $order->delete();
        }
    }
}
?>
