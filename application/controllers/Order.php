<?php
//error_reporting(0);
class Order extends CI_Controller {
    /**
     * Class Constructor
     * Description
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Order_Model");
    }
    /**
     * Serve
     * Description
     */
    public function serve()
    {
        if("serve" == $this->input->post("action"))
        {
            $document = $this->input->post("order");
            
            $document["status"] = "SERVING";
            
            $this->Order_Model->partial_replace($document);
        
            redirect("/dashboard");
        }
    }
    /**
     * Complete
     * Description
     */
    public function complete()
    {
        echo "a";
        if("complete" == $this->input->post("action"))
        {
            $document = $this->input->post("order");
            
            $document["status"] = "DONE";
            $this->Order_Model->partial_replace($document);
        
            redirect("/dashboard");
        }
    }
    /**
     * View
     * Description
     *
     * @param string $id The order ID.
     */
    public function view($id = NULL)
    {
        $assistant = json_decode($this->session->userdata("assistant"));
        
        $this->load->view("dashboard/index", array(
            "orders" => array(
                "pending" => $this->Order_Model->get(array("status" => "PENDING")),
                "serving" => $this->Order_Model->get(array("status" => "SERVING")),
                "done" => $this->Order_Model->get(array("status" => "DONE"))
            ),
            "order" => $this->Order_Model->get_by_id($id),
            "leaf" => "view",
            "assistant" => $assistant
        ));
    }
    /**
     * View
     * Description
     *
     * @param string $id The order ID.
     */
    public function details($id = NULL)
    {
        $assistant = json_decode($this->session->userdata("assistant"));
        
        $this->load->view("dashboard/index", array(
            "orders" => array(
                "pending" => $this->Order_Model->get(array("status" => "PENDING")),
                "serving" => $this->Order_Model->get(array("status" => "SERVING")),
                "done" => $this->Order_Model->get(array("status" => "DONE"))
            ),
            "order" => $this->Order_Model->get_by_id($id),
            "leaf" => "details",
            "assistant" => $assistant
        ));
    }
    /**
     * Finalize
     * Description
     */
    public function finalize($id = NULL)
    {
        $assistant = json_decode($this->session->userdata("assistant"));
        
        $this->load->view("dashboard/index", array(
            "orders" => array(
                "pending" => $this->Order_Model->get(array("status" => "PENDING")),
                "serving" => $this->Order_Model->get(array("status" => "SERVING")),
                "done" => $this->Order_Model->get(array("status" => "DONE"))
            ),
            "order" => $this->Order_Model->get_by_id($id),
            "leaf" => "finalize",
            "assistant" => $assistant
        ));
    }
}