<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model');
        $this->load->model('Email_model');
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

        $usr = $this->session->userdata('user_login');
        $adm = $this->session->userdata('admin_login');

        if ($usr == 1 || $adm == 1){
            $usertype = $this->session->userdata('login_type');
            redirect(base_url() . '?'.$usertype.'/dashboard', 'refresh');
            //$this->load->view('GeneradorCarga/startpage');
        }


        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|xss_clean|valid_email'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|xss_clean|callback__validate_login'
            )
        );

        $this->form_validation->set_rules($config);
        //$this->form_validation->set_message('_validate_login', ' Login failed!');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">
                                <button type="button" class="close" data-dismiss="alert">×</button>', '</div>');




        if ($this->form_validation->run() == FALSE) {
            $page_data['flash_message'] = $this->session->flashdata('flash_message');
            $page_data['page_title'] = 'Login Account';
            $this->load->view('signin',$page_data);
        } else {
            $usr = $this->session->userdata('user_login');
            $adm = $this->session->userdata('admin_login');
            if ($usr == 1 || $adm == 1){
                $usertype = $this->session->userdata('login_type');
                redirect(base_url() . '?'.$usertype.'/dashboard', 'refresh');
            }

                //$this->load->view('startpage');

        }

    }
     function recuperar($option='none',$idacc = 0,$token = '')
    {
        $page_data["page_name"]="recuperar";
        $page_data["page_title"]="Recuperacion de contraseña";
        $page_data["token"]=$token;
        $page_data["idacc"]=$idacc;
        if(intval($idacc) > 0 && $token != ''){
                 if($option == 'none'){ //segunda etapa, nueva contrasenia
                        $page_data["token_stage"] = TRUE;
                 	$this->load->view("recover",$page_data);
                 }
                 if($option == 'reset'){ //tercera etapa consolidar contrasenia y envio de correo
                     $query_last_rec = $this->db->select('*')->get_where('account', array('idaccount' => $idacc, 'token' => $token));
        	     if ($query_last_rec->num_rows() > 0) {
        	 	    $pass = $this->input->post('password');
                    $len = 10;
	                $salt = $this->Crud_model->generateRandomString($len);
	                $thepassword = sha1($pass . $salt);
	                $this->Account_model->account_update_field_by_id($idacc,'password',$thepassword);
	                $this->Account_model->account_update_field_by_id($idacc,'salt',$salt);
	                //envio de correo con nueva contrasenia
                    $to_email = $query_last_rec->first_row()->username;
                    $usertype = $query_last_rec->first_row()->usertype;
                    $tipo_cuenta = ($usertype=="0")?ADMIN:EMPRESA;
                    $email_sub = "Ultima etapa Recuperación de Cuenta";
                    $result = $this->Email_model->sendCredentials($to_email,$email_sub,$tipo_cuenta,$pass);

                    if($result == TRUE){ $page_data["info"] = "Envio de mail exitoso."; }
                    else{ $page_data["info"] = "Fallo al envío de mail, intente nuevamente."; }

        	     }else{
        	        $page_data["info"]="Fallo al recuperar";
        	        $this->load->view("recover",$page_data);
        	     }

	             $this->Account_model->account_update_field_by_id($idacc,'token','');
                 }

	        $this->load->view("signin",$page_data);
        }
        else{ //primera etapa envio de correo
	     if($option == 'send'){
	        $email = $this->input->post('username');
        	$query_prev = $this->db->select('*')->get_where('account', array('username' => $email  ));

	        if ($query_prev->num_rows() == 0) {
	        	$page_data["info"] = "Cuenta no existe";

	            	return;
	        } else{
	                 $idacc = $query_prev->first_row()->idaccount;
                     $mail = $query_prev->first_row()->username;
		         $len = 15;
		         $token = $this->Crud_model->generateRandomToken($len);
		         $this->Account_model->account_update_field_by_id($idacc,'token',$token);

		         $data = array("idaccount" => $iduser);
		         //send mail
		         $url = base_url()."?Login/recuperar/none/".$idacc."/".$token;
                 $result = $this->Email_model->sendRecoveryCredentials($mail,$url);
                 if($result == TRUE){ $page_data["info"] = "Envio de mail exitoso."; }
                 else{ $page_data["info"] = "Fallo al envío de mail, intente nuevamente."; }

	        	$this->load->view("recover",$page_data);
	        }

	     }else{
    	       $page_data["email_stage"] = TRUE;
	           $this->load->view("recover",$page_data);
	     }

	 }

         //return TRUE;

    }
     function registrar($option="none")
    {
        $page_data["page_title"] = "Crear Cuenta";
        if($option == "add"){
        	$email = $this->input->post('username'); // == contact_mail
            $contact_mail = $email;
	        $password = $this->input->post('password');
	        $password_rep = $this->input->post('password_again');
            $name_legal_rep = $this->input->post('name_legal_rep');
            $rut_legal_rep = $this->input->post('rut_legal_rep');
            $business_name = $this->input->post('business_name');
            $rut = $this->input->post('rut');
            $company_name = $this->input->post('company_name');
            $line_of_business = $this->input->post('line_of_business');
            $contact_phone = $this->input->post('contact_phone');
            $city_state = $this->input->post('city_state');
            $position = $this->input->post('position');
            $type = '1';

	        //USEFUL TO CHOOSE FILE OF VIEWS

	        if($password != $password_rep || $password == ''){
	        	$page_data["info"] = "Password no coinciden";

	                $this->load->view("signup",$page_data);
	        	return;
	        }

	        $query_prev = $this->db->select('*')->get_where('account', array('username' => $email  ));

	        if ($query_prev->num_rows() > 0) {
	        	$page_data["info"] = "Cuenta ya existe";
	        	$this->load->view("signup",$page_data);
	            	return;
	        }
	         $len = 10;
	         $salt = $this->Crud_model->generateRandomString($len);
	         $thepassword = sha1($password . $salt);



	         $this->Account_model->account_insert($email,$thepassword,$salt,$type);
	         $iduser = $this->db->insert_id();

	         $data = array("idaccount" => $iduser);
	         if (strval($type) == '1') { // 1 = EMPRESA
	            $userid = $iduser;

                /*
            $contact_mail = $email;
            $password = $this->input->post('password');
            $password_rep = $this->input->post('password_again');
            $name_legal_rep = $this->input->post('name_legal_rep');
            $rut_legal_rep = $this->input->post('rut_legal_rep');
            $business_name = $this->input->post('business_name');
            $rut = $this->input->post('rut');
            $company_name = $this->input->post('company_name');
            $line_of_business = $this->input->post('line_of_business');
                */
                $data = array(
                            "business_name" => $business_name,
                            "RUT" => $rut,
                            "company_name" => $company_name,
                            "line_of_business" => $line_of_business,
                            "contact_mail" => $contact_mail,
                            "contact_phone" => $contact_phone,
                            "city_state" => $city_state,
                            "position" => $position,

                            "name_legal_rep" => $name_legal_rep,
                            "RUT_legal_rep" => $rut_legal_rep,
                            "business_name" => $business_name,
                            "idaccount_fk" => $iduser
                        );

	            $this->Crud_model->table_insert("company",$data);
	            $usertype = EMPRESA;
	            $this->session->set_userdata('user_login', '0');
	            $this->session->set_userdata('userid', $userid);
	            $this->session->set_userdata('login_type', $usertype);
	            $this->session->set_userdata('email',$email);
                $email_sub = "Creación de Cuenta";
                //envio de mail a admin
            		$admins = $this->Account_model->account_get_all_by_type(0);
            		foreach ($admins as $key => $value) {
                  $email_admin = $value["username"];
            			$result = $this->Email_model->sendUserCreationToAdmin($email,$email_sub,$usertype, $email_admin);
            		}

              
                $result = $this->Email_model->sendCredentials($email,$email_sub,$usertype,$password);
                if($result == TRUE){ $page_data["info"] = "Envio de mail exitoso."; }
                else{ $page_data["info"] = "Fallo al envío de mail, intente nuevamente."; }
	            redirect(base_url()."?Login",'refresh');
	        }



        }else
	       $this->load->view("signup",$page_data);

         //return TRUE;

    }
    /***validate login****/
    function _validate_login($str)
    {
        $email = $this->input->post('email');
        //USEFUL TO CHOOSE FILE OF VIEWS
        $usertype = '';

        $query_prev = $this->db->select('*')->get_where('account', array('username' => $email  ));

        if ($query_prev->num_rows() > 0) {
            $salt = $query_prev->row()->salt;
            $password = sha1($this->input->post('password') . $salt);
            //print_r('mypwd::::'.$password);
            $query = $this->db->select('*')->get_where('account',
                array('username' => $email, 'password' => $password));
            $type='';
            $datarow = $query->row();
            $type = strval($datarow->usertype);

            $usertype = ($type == 0 ) ? ADMIN : EMPRESA;

            $habilitado = $datarow->enabled;
            //print_r($type);
            //echo 'PASS FROM TABLE: '.$pass;
           if ($query->num_rows() > 0) {
                $userid = $this->Account_model->account_get_id_by_Muser($email);

                if (strval($type) == '0') { // 0 = admin
                    $usertype = ADMIN;
                    $this->session->set_userdata('admin_login', '1');
                    $this->session->set_userdata('userid', $userid);
                    $this->session->set_userdata('login_type', $usertype);
                    $this->session->set_userdata('enabled', 'None');
                    $this->session->set_userdata('email',$email);
                }
                if (strval($type) == '1') { // 1 = EMPRESA
                    $usertype = EMPRESA;
                    $this->session->set_userdata('user_login', '1');
                    $this->session->set_userdata('userid', $userid);
                    $this->session->set_userdata('login_type', $usertype);
                    $this->session->set_userdata('enabled', $habilitado);
                    $this->session->set_userdata('email',$email);
                }


                return TRUE;
            }else{
                $this->session->set_flashdata('flash_message', 'Patrón Usuario y/o contraseña incorrecto(s)');
                //redirect(base_url(). '?login' , 'refresh');
                $page_data['flash_message'] = "Patrón, Usuario y/o contraseña incorrecto(s)";
                $this->load->view('signin', $page_data);
                return FALSE;
            }


        } else {

            $this->session->set_flashdata('flash_message', 'Usuario y/o contraseña invalida(s)');
            //redirect(base_url(). '?login' , 'refresh');
            $page_data['flash_message'] = "Usuario y/o contraseña invalido";
            $this->load->view('signin', $page_data);
            return FALSE;
        }
    }


    /*******LOGOUT FUNCTION *******/
    function logout()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url() . '?Login', 'refresh');
    }

    /***DEFAULT NOT FOUND PAGE*****/
    function four_zero_four()
    {
        $this->load->view('four_zero_four');
    }

}
