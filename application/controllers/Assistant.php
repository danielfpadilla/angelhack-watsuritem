<?php
error_reporting(0);

class Assistant extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        
        $this->load->library('form_validation');
    }
    
    public function login()
    {
        $this->form_validation->set_rules('code', 'Code', 'required|callback_authenticate_code');
        
        if($this->form_validation->run() === FALSE)
        {
            $this->load->view("assistant/login");
        }
        else
        {
            redirect("/dashboard/index");
        }
    }
    
    public function logout()
    {
        $this->session->unset_userdata("assistant");
        redirect("/dashboard/index");
    }
    /**
     * Authenticate Code
     * Description
     */
    public function authenticate_code($code = NULL)
    {
        $this->load->model("Assistant_Model");
        
        $assistant = $this->Assistant_Model->get_by_code($code);
        
        if($assistant)
        {
            $this->session->set_userdata( array("assistant" => json_encode($assistant)) );
            return TRUE;
        }
        
        $this->form_validation->set_message("authenticate_code", "{field} is incorrect.");
        
        return FALSE;
    }
}
