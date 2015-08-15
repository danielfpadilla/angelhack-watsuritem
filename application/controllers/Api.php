<?php 
require(APPPATH."/libraries/REST_Controller.php");
 
class Api extends REST_Controller {
    public function order_post()
    {
        $this->load->model("Order_Model");
        $order = new $this->Order_Model;
        
        $order->instantiate(
            array(
                "title" => "The Title",
                "date" => "2015-08-15",
                "items" => array(
                    array(
                        "quantity" => 1,
                        "description" => "Ketchup"
                    ),
                    array(
                        "quantity" => 5,
                        "description" => "Flour"
                    )
                )
            )
        );
        
        $order->register();
    }
}
?>
