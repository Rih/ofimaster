<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Recover extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model');
        $this->load->database();
        /*cash control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        
        
        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|xss_clean|valid_email'
            )
        );        
        $this->form_validation->set_rules($config);
        $this->load->view('recover');
                
    }
    
   
    
    /***DEFAULT NOT FOUND PAGE*****/
    function four_zero_four()
    {
        $this->load->view('four_zero_four');
    }
    

	/***RESET AND SEND PASSWORD TO REQUESTED EMAIL****/
	function recover_password()
	{
		
		$email  = $this->input->post('email');
		$result = $this->Email_model->password_reset_email($email); //SEND EMAIL ACCOUNT OPENING EMAIL
		if ($result == true) {
			$this->session->set_flashdata('flash_message', get_phrase('password_sent'));
		} else if ($result == false) {
			$this->session->set_flashdata('flash_message', get_phrase('account_not_found'));
		}		
		redirect(base_url(), 'refresh');		
	}

    
    
    /*******LOGOUT FUNCTION *******/
    function logout()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url() . 'index.php?Login', 'refresh');
    }
    
}
