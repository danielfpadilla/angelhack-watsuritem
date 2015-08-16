<?php
error_reporting(0);

class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
    }
    /**
     * Index
     * Description
     */
    public function index()
    {
        $assistant = $this->session->userdata("assistant");
        
        if($assistant == NULL)
            redirect("/assistant/login");
        
        $assistant = json_decode($assistant);
        
        $this->load->model("Order_Model");
        
        $this->load->view("dashboard/index", array(
            "orders" => array(
                "pending" => $this->Order_Model->get(array("status" => "PENDING")),
                "serving" => $this->Order_Model->get(array("status" => "SERVING")),
                "done" => $this->Order_Model->get(array("status" => "DONE"))
            ),
            "assistant" => $assistant
        ));
    }
    /**
     * Order
     * Description
     *
     * @param string $id The order ID.
     */
    public function order($id = NULL)
    {
        $assistant = $this->session->userdata("assistant");
        
        if($assistant == NULL)
            redirect("/assistant/login");
            
        $assistant = json_decode($assistant);
        
        $this->load->model("Order_Model");
        
        $this->load->view("dashboard/index", array(
            "orders" => array(
                "pending" => $this->Order_Model->get(array("status" => "PENDING")),
                "serving" => $this->Order_Model->get(array("status" => "SERVING"))
            ),
            "order" => $this->Order_Model->get_by_id($id),
            "method" => "order",
            "assistant" => $assistant
        ));
    }
}
