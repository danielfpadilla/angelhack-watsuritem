<?php 
require(APPPATH . "/libraries/REST_Controller.php");

error_reporting(0);

class Api extends REST_Controller {
    /**
     * Get Assistant
     * Description
     */
    public function assistant_get()
    {
        $this->load->model("Assistant_Model");
        
        if( array_key_exists("code", $this->get()) )
        {
            $assistant = $this->Assistant_Model->get_by_code($this->get("code"));
            
            $this->response(array("status" => "success", "assistant" => $assistant));
        }
    }
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
        
            if( array_key_exists("assistant", $this->put()) )
                $this->assistant = $this->put("assistant");
        
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
    
    public function unique_get()
    {
        echo uniqid();
    }
}