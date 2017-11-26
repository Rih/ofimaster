<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {

	function __construct()
    {

        parent::__construct();
        $this->load->database();
        $this->load->model('Crud_model');
        $this->load->model('Generic_model');
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


	function account_opening_email($account_type = '' , $email = '')
	{
		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;

		$email_msg		=	"Welcome to ".$system_name."<br />";
		$email_msg		.=	"Your account type : ".$account_type."<br />";
		$email_msg		.=	"Your login password : ".$this->db->get_where($account_type , array('email' => $email))->row()->password."<br />";
		$email_msg		.=	"Login Here : ".base_url()."<br />";

		$email_sub		=	"Account opening email";
		$email_to		=	$email;

		$this->do_email($email_msg , $email_sub , $email_to);
	}

	function sendUserCreationToAdmin($to_email,$email_sub,$tipo_cuenta,$mail_admin){ //CREACION DE CUENTAS
		$usr = $tipo_cuenta;

		if($tipo_cuenta== ADMIN ){
			$tipo_cuenta = ADMIN_NAME;
		}
		$email_msg = "<h1> Creación de cuenta ".$tipo_cuenta. " ha sido creada con éxito. </h1>";
		$email_msg .= "<h3> El usuario creado es: <strong>".$to_email. "</strong>";
		$email_msg		.=	"Para mayor detalle ingrese a: ".base_url()."<br />";
		$email_sub = $email_sub;
		return $this->do_email($email_msg,$email_sub,$mail_admin);
	}


	function sendCredentials($to_email,$email_sub,$tipo_cuenta, $paswd){ //CREACION DE CUENTAS
		$usr = $tipo_cuenta;

		if($tipo_cuenta== ADMIN ){
			$tipo_cuenta = ADMIN_NAME;
		}
		$email_msg = "<h1> Enhorabuena, su cuenta de tipo ".$tipo_cuenta. " ha sido creada/recuperada con Exito. </h1>";
		$email_msg .= "<h3> Su usuario para ingresar es: <strong>".$to_email. "</strong>";
		$email_msg .= "Su contrasena para ingresar es: <strong>".$paswd. "</strong> </h3> ";
		$email_msg .= "Mantenga este correo como respaldo para futuras eventualidades.";
		$email_msg .= "Puedes ingresar desde: <a href='". base_url()."?".$usr."/dashboard"."'>Aqui</a>";
		$email_sub = $email_sub;
		return $this->do_email($email_msg,$email_sub,$to_email);
	}

	function sendRecoveryCredentials($to_email,$url){ //RECUPERACION DE CUENTA


		$email_msg = "Proceso de recuperacion de Cuenta, para completar el proceso ingrese a este enlace: ";
		$email_msg .= "<a href='".$url."'>Aqui</a>";
		$email_sub = "Recuperacion de Cuenta";
		return $this->do_email($email_msg,$email_sub,$to_email);
	}


	/***custom email sender****/
	function do_email($msg=NULL, $sub=NULL, $to=NULL, $from=NULL)
	{
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$config = array();
        $config['useragent']	= "CodeIgniter";
        $config['mailpath']		= "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']		= "pop3";   //smtp o pop3

        //$config['smtp_host']	= "ssl://smtp.googlemail.com";
        //$config['smtp_host']	= "mx1.hostinger.com.ar";
        /*$config['validation']	= TRUE;
        $config['smtp_timeout']	=  30;
        $config['smtp_port']	= "25"; //"25" o "465"
        */
        //$config['smtp_user']	= "no-reply@riharkapp.esy.es";
        //$config['smtp_user']	= "no-reply@rodrihgo.xyz";
        //$config['smtp_pass']	= "8107meYjQf";
        $config['smtp_host']	= "ssl://smtp.googlemail.com";
        $config['validation']	= TRUE;
        $config['smtp_timeout']	=  30;
        $config['smtp_port']	= "465"; //"25"
        $config['smtp_user']	= "rifacodemakers2015@gmail.com";
        $config['smtp_pass']	= "pliqse123098";



         //rodrigo.ediaz.f@gmail.com
        $config['mailtype']		= "html";
        $config['charset']		= "utf-8";
        $config['newline']		= "\r\n";
        $config['wordwrap']		= TRUE;
        //SYSTEM EMAIL
		//user rifacodemakers2015@gmail.com
		//password: pliqse123098
        $this->load->library('email');

        $this->email->initialize($config);

		$system_name	=	SYSTEM_NAME;
		if($from == NULL)
			$from		=	EMAIL_SYSTEM;

		//$this->email->from($from, $system_name);
		$this->email->from($from, $system_name);
		$this->email->to($to);
		$this->email->subject($sub);

		$msg	=	$msg."<br /><br /><br /><br /><br /><br /><br /><hr /><center><a href=\"http://www.ofimaster.cl/\">&copy; ".date("Y")." ofimaster.cl</a></center>";
		$this->email->message($msg);

		//$this->email->send();
		//if(@$this->email->send()){
		if(@$this->email->send()){
    		//$this->email_status = true;
    		//echo $this->email->print_debugger();
    		return true;
		}else{
		    //$this->email_status= false;
		    //echo $this->email->print_debugger();
		    return false;
		 }



	}
}
