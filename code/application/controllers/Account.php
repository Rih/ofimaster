<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account extends CI_Controller
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
    
    /***default function, redirects to login page if no admin logged in yet***/
    public function index()
    {
                     
    }
    
    function generateRandomString($length = 8) {
      $characters = 'ABCDE01FGHIJ23KLMNO45PQRST67UVWXYZ89';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }

    function create(){
        
        $page_data['page_title'] = 'Create Account';

        $config = array(
            array(
                'field' => 'patternlen',
                'label' => 'Patternlen',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'pattern',
                'label' => 'Pattern',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|xss_clean|valid_email|callback__validate_creation'
            ),
            array(
                'field' => 'npassword',
                'label' => 'nPassword',
                'rules' => 'required|xss_clean'
            )
        );
        
        $this->form_validation->set_rules($config);
        $this->form_validation->set_message('_validate_creation',  ' Creación fallida!');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">
                                <button type="button" class="close" data-dismiss="alert">×</button>', '</div>');
        
        
        if ($this->form_validation->run() == FALSE) {
            //$this->load->view('login');
            
            $this->load->view('signup',$page_data);
        } else {
            if ($this->session->userdata('admin_login') == 1)
                redirect(base_url() . '?Admin/dashboard', 'refresh');
            if ($this->session->userdata('user_login') == 1)
                redirect(base_url() . '?User/dashboard', 'refresh');
           
        }
    }
    /***validate login****/
    function _validate_creation($str)
    {
        $email = $this->input->post('email');
        $query = $this->db->get_where('account',array('Muser' => $email));        
        $usertype = 'user';
        
        
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('flash_message', 'Correo ya utilizado');
            redirect(base_url() . '?Account/create', 'refresh');
            return FALSE;
        }else{        
            if ( $usertype == 'user') {
                $this->session->set_userdata('user_login', '1');
                $this->session->set_userdata('login_type', $usertype);
                $this->session->set_userdata('email', $email);
            }          
            return TRUE;
        }

    }

/***CREATE A NEW ACCOUNT TO REQUESTED EMAIL****/
      function create_account()
    {
        
        $email  = $this->input->post('email');
        $query  =   $this->db->get_where('account' , array('Muser' => $email));
        $page_data['page_title'] = 'Create Account';
        if($query->num_rows() > 0 || strlen($email) == 0){
            $this->session->set_flashdata('flash_message', 'Account creation failed, invalid email or this account already exists!');
            //redirect(base_url() . '?Account/create', 'refresh');    
            $page_data['flash_message'] = 'Account creation failed, invalid email or this account already exists!';
            $this->load->view('signup',$page_data);

        }else{            
            
            $lengthsalt = 10;            
            $newsalt   =   $this->generateRandomString($lengthsalt);
            $length = $this->input->post('npassword');
            //$password = $this->Email_model->generateRandomString($length);
            $password = '12345678';
            /*for ($i=1;$i<=$length;$i++){
                $password .= strval($i);
            }*/
            $newpass = sha1($password.$newsalt);
            $thepattern = $this->input->post('pattern');
            $patternlen = $this->input->post('patternlen');
            $pattern = strval($patternlen)."|".strval($thepattern);
            $data = array(
                'Muser' => $email,
                'Mpassword' => $newpass,
                'Mpattern' => $pattern,
                'salt' => $newsalt
                );
            $result = $this->Email_model->create_account_email($data,$password,$thepattern,$patternlen); //SEND EMAIL ACCOUNT OPENING EMAIL
            if ($result === true) {
                $this->session->set_flashdata('flash_message', 'Account successfully created, credentials sent to your email.');
                $page_data['flash_message'] = 'Account successfully created, credentials sent to your email.';
                $this->load->view('signin',$page_data);
            } else if ($result === false) {
                $this->session->set_flashdata('flash_message', 'Creation account failed!!');
                $page_data['flash_message'] = 'Creation account failed!!';
                $this->load->view('signup',$page_data);
            }       
            //redirect(base_url() . '?login', 'refresh');            
        }
       
    }    
   /***RESET AND SEND PASSWORD TO REQUESTED EMAIL****/
   function recover_preview()
    {
        $page_data['page_title'] = 'Recover Account';
        $config = array(            
             array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|xss_clean|valid_email|callback__validate_recovery_preview'
            )
        );
        
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == TRUE) {
            //$this->load->view('login');
            $page_data['flash_message'] = "email send";            
            $this->load->view('recover_preview',$page_data);
        }else{
            $this->load->view('recover_preview',$page_data);    
        }
        
    }

    function _validate_recovery_preview($str)
    {
        $page_data['page_title'] = 'Recover Account';
        $email = $this->input->post('email');
        $query = $this->db->get_where('account',array('Muser' => $email));        
        $usertype = 'user';       
        
        if ($query->num_rows() == 0) {
            $this->session->set_flashdata('flash_message', 'Invalid account');
            redirect(base_url() . '?Account/recover', 'refresh');
            return FALSE;
        }else{
        
            if ( $usertype== 'user') {
                $result = $this->Email_model->credentials_request_email($email);
                if($result == TRUE){
                    //$this->session->set_userdata('user_login', '1');
                    //$this->session->set_userdata('login_type', $usertype);
                    //$this->session->set_userdata('email', $email);    
                }else{ return FALSE; }

                

            }
          
            return TRUE;
        }
    }


    function recover($option="deny",$iduser, $validation)
    {
        $page_data['page_title'] = 'Recover Account';
        $query = $this->db->get_where('account',array('id' => $iduser,'validation' => $validation));
        if($query->num_rows()==0){
            $this->load->view('four_zero_four',$page_data);
        }else{
            
            if($option == "deny"){
                $this->db->where('id',$iduser);
                $this->db->update('account',array('date_validation'=> NULL, 'validation' => 'None'));
                $this->load->view('recover_deny',$page_data);

            }else if($option=="auth" ){

                 $config = array(
                array(
                    'field' => 'patternlen',
                    'label' => 'Patternlen',
                    'rules' => 'required|xss_clean'
                ),
                array(
                    'field' => 'pattern',
                    'label' => 'Pattern',
                    'rules' => 'required|xss_clean'
                ),
                 array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'required|xss_clean|valid_email|callback__validate_recovery'
                ),
                array(
                    'field' => 'npassword',
                    'label' => 'nPassword',
                    'rules' => 'required|xss_clean'
                )
            );
            
                $this->form_validation->set_rules($config);
                $page_data['validation'] = $validation;
                $this->load->view('recover',$page_data);
            }
        }
        
       
    }

/***validate login****/
    function _validate_recovery($str)
    {
        $page_data['page_title'] = 'Recover Account';
        $email = $this->input->post('email');
        $query = $this->db->get_where('account',array('Muser' => $email));        
        $usertype = 'user';       
        
        if ($query->num_rows() == 0) {
            $this->session->set_flashdata('flash_message', 'Invalid account');
            redirect(base_url() . '?Account/recover', 'refresh');
            return FALSE;
        }else{
        
            /*if ( $usertype== 'user') {
                $this->session->set_userdata('user_login', '1');
                $this->session->set_userdata('login_type', $usertype);
                $this->session->set_userdata('email', $email);
            }*/
          
            return TRUE;
        }

    }
    
    
    
    
/***RESET AND SEND PASSWORD TO REQUESTED EMAIL****/
    function recover_password($validation)
    {
        $page_data['page_title'] = 'Recover Account';
        $page_data['validation'] = '';

        $email  = $this->input->post('email');
        $npassword = $this->input->post('npassword');
        $thepattern = $this->input->post('pattern');
        $patternlen = $this->input->post('patternlen');                
        
        $query = $this->db->get_where('account', array('Muser' => $email));
        if ($query->num_rows() > 0 && strlen($email) > 0){
                $result = $this->Email_model->password_reset_email($email,$npassword,$thepattern,$patternlen); //SEND EMAIL ACCOUNT OPENING EMAIL
            if ($result == true) {
                //Reset validations fields..
                $iduser = $this->Crud_model->account_get_id_by_Muser($email);
                $this->db->where('id',$iduser);
                $this->db->update('account',array('date_validation'=> NULL, 'validation' => 'None'));
                
                $this->session->set_flashdata('flash_message', 'Credentials sent.');
                $page_data['flash_message'] = 'Credentials sent to your registered email';
                $this->load->view('recover',$page_data);
            }else{
                $this->session->set_flashdata('flash_message', 'Sending mail issues.');
                $page_data['flash_message'] = 'There are issues to send your credentials to your mail, try again later.';
                $this->load->view('recover',$page_data);
            }           
        }else{
            $this->session->set_flashdata('flash_message', 'Invalid or not found email.');
            $page_data['flash_message'] = 'Invalid or not found email.';            
            $this->load->view('recover',$page_data);
        }
        
        //redirect(base_url(), 'refresh');
    }

    
    
    /***DEFAULT NOT FOUND PAGE*****/
    function four_zero_four()
    {
        $this->load->view('four_zero_four');
    }

    /*******LOGOUT FUNCTION *******/
    function logout()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url().'?Login' , 'refresh');
    }
    
}
