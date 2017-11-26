<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Generic_model');
		$table = json_decode(_TABLE,true);
	}


///////////////////////////// CRUD FOR ACCOUNT TABLE //////////////////////////////////////////////////


	function account_insert($muser, $mpassword, $salt, $type)
	{
		$table = json_decode(_TABLE,true);
		$data = array(
			'username' =>$muser,
			'password' =>$mpassword,
			'salt' =>$salt,
			'enabled' => 1,
			'usertype' => $type
			);
		$value = $this->db->insert($table["account"]["name"],$data);
		return $value;
	}


	function account_delete_by_id($table = 'account',$iduser=0)
	{

		if ($iduser != 0) {
			$tables = array('account');
			if(in_array($table,$tables)){
				$this->db->delete($table,array('idaccount' => $iduser));
				return true;
			}
			else{ return false; }

		}else{
			return false;
		}
	}


	function account_update_field_by_id($id,$namefield,$field)
	{
		$table = json_decode(_TABLE,true);
		$data = array( $namefield => $field );
		$this->db->where('idaccount', $id);
		$value = $this->db->update($table["account"]["name"], $data);
		return $value;
	}


	function account_update_by_id($id, $newpassword= '',$newpattern = '', $newsalt= '')
	{
		$table = json_decode(_TABLE,true);
		if ($newpassword != ''){
			$data = array( 'password' => $newpassword );
			$this->db->where('idaccount', $id);
			$this->db->update($table["account"]["name"], $data);
		}

		if ($newsalt != ''){
			$data = array( 'salt' => $newsalt );
			$this->db->where('idaccount', $id);
			$this->db->update($table["account"]["name"], $data);
		}
		return true;
	}


	function account_get_id_by_Muser($mail = '',$logged = false)
	{
		$table = json_decode(_TABLE,true);
		if ($logged == true) {
			$mail = $this->session->userdata('email');
		}
		if($mail != ''){
			return $this->db->select('idaccount')->get_where($table["account"]["name"], array( 'username'=> $mail))->row()->idaccount;
		}else{
			return false;
		}
	}


	function account_get_all_by_Muser($mail = '',$logged = false)
	{
		$table = json_decode(_TABLE,true);
		if ($logged == true) {
			$mail = $this->session->userdata('email');
		}
		if($mail != ''){
			return $this->db->get_where($table["account"]["name"], array( 'username'=> $mail))->row();
		}else{
			return false;
		}
	}


	function account_get_all_by_iduser($iduser = '',$logged = false)
	{
		$table = json_decode(_TABLE,true);
		if ($logged == true) {
			$iduser = $this->session->userdata('userid');
		}
		if($iduser != ''){
			return $this->db->get_where($table["account"]["name"], array( 'idaccount'=> $iduser))->row_array();
		}else{
			return false;
		}
	}

	function account_get_all_by_type($type,$logged = false)
	{
		$table = json_decode(_TABLE,true);
		if ($logged == true) {
			$iduser = $this->session->userdata('userid');
		}
		return $this->db->get_where($table["account"]["name"], array( 'usertype'=> $type))->result_array();

	}
	//Type = Transportista, GeneradorCarga
	function account_get_id_by_type($idusr = 0,$type)
	{
		$table = json_decode(_TABLE,true);

		return $idusr; //admin

	}
////////////------------------------------END-----------------------------------------------///////////




}
