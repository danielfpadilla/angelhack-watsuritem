<?php 
require(APPPATH."/libraries/REST_Controller.php");
 
class Api extends REST_Controller {
    /**
     * Customer Login
     * Description
     */
    public function customer_get()
    {
    }
    /**
     * Register Customer
     * Description
     */
    public function customer_post()
    {
        $this->load->model("Customer_Model");
        
        $customer = new $this->Customer_Model;
        
        $customer->instantiate($this->post());
        $id = $order->register();
        
        $this->response(array("status" => "success", "id" => $id));
    }
    /**
     * Get Order
     * Description
     */
    public function order_get()
    {
        $this->load->model("Order_Model");
        
        if( array_key_exists("id", $this->get()) )
        {
            $order = $this->Order_Model->get_by_id($this->get("id"));
        
            $this->response(array("status" => "success", "order" => $order));
        }
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
    /**
     * Get Orders
     * Description
     */
    public function orders_get()
    {
        $this->load->model("Order_Model");
        
        $orders = $this->Order_Model->get($this->get());
    
        $this->response(array("status" => "success", "orders" => $orders));
    }
}