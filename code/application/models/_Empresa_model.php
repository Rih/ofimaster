<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empresa_model extends CI_Model {
	public $table;

	function __construct()
	{
		parent::__construct();
		$this->load->model('Generic_model');
		$table = json_decode(_TABLE, true);
	}
	

	function get_empresa_by_idusertype($idusertype, $usertype)
	{
		$querystr = "";
		$table = json_decode(_TABLE, true);

		$match_ofertas = $table["match_ofertas"]["name"];
		$transportista = $table["transportista"]["name"];
		$generadorcarga = $table["generadorcarga"]["name"];
		$account = $table["account"]["name"];
		$empresa = $table["empresa"]["name"];

		if ($usertype == TRANSPORTISTA){
			$querystr = "SELECT E.* FROM $empresa E 
			INNER JOIN $account ACC ON  E.idaccount = ACC.id 
			INNER JOIN $generadorcarga GC ON GC.idaccount = ACC.id
			WHERE GC.idgeneradorcarga = $idusertype";
		}else if($userype == GENERADORCARGA ){
			$querystr = "SELECT E.* FROM $empresa E 
			INNER JOIN $account ACC ON  E.idaccount = ACC.id 
			INNER JOIN $transportista T ON T.idaccount = ACC.id
			WHERE T.idtransportista = $idusertype";
		}
		return $this->Generic_model->doQuery($querystr);	
	}

	// obtener todos los datos de un chofer agregado
	function empresa_update_by_id($id,$data)
	{ 
		$table = json_decode(_TABLE, true);
	 	if ($id != 0) {		
			$this->db->where('idaccount_fk', $id);
			$value = $this->db->update($table["empresa"]["name"], $data);	
			return true;		
		}else{
			return false;
		}
	}


	public function fetch_tabla_empresa($id,$limit, $start) 
	{
		$table = json_decode(_TABLE, true);
		$this->db->limit($limit, $start);
		$query = $this->db->get_where($table["empresa"]["name"],array('idaccount_fk' => $id)); //add where comprado = 1 !
		return $this->Generic_model->doQueryObject($query);
	}


	function fetch_tabla_empresa_by_match($modalidad,$idoferta )
	{
		$querystr = "";
		$table = json_decode(_TABLE, true);

		$match_ofertas = $table["match_ofertas"]["name"];
		$ofertatransportista = $table["ofertatransportista"]["name"];
		$transportista = $table["transportista"]["name"];

		$ofertacarga = $table["ofertacarga"]["name"];
		$generadorcarga = $table["generadorcarga"]["name"];
		$account = $table["account"]["name"];
		$empresa = $table["empresa"]["name"];

		if($modalidad == GENERADORCARGA ){ //ve datos de su contraparte
			$querystr ="SELECT E.* FROM `match_ofertas` MO
				JOIN `ofertatransportista` OT 
					ON MO.idofertatransportista = OT.idofertatransportista AND OT.estado_oferta = '2'
				JOIN `transportista` T 
					ON T.idtransportista = OT.idtransportista_fk 
				JOIN `account` ACC 
					ON ACC.id = T.idaccount
				JOIN `empresa` E 
					ON E.idaccount = ACC.id
				WHERE (MO.estado_solicitud_GC = '2' OR MO.estado_oferta_GC = '2') AND MO.idofertacarga = '$idoferta' ";
		}else if($modalidad == TRANSPORTISTA ){ //ve datos de su contraparte
			$querystr ="SELECT E.* FROM `match_ofertas` MO
				JOIN `ofertacarga` OC 
					ON MO.idofertacarga = OC.idofertacarga AND OC.estado_oferta = '2'
				JOIN `generadorcarga` GC 
					ON GC.idgeneradorcarga = OC.idgeneradorcarga_fk 
				JOIN `account` ACC 
					ON ACC.id = GC.idaccount
				JOIN `empresa` E 
					ON E.idaccount = ACC.id
				WHERE (MO.estado_solicitud = '2' OR MO.estado_oferta = '2') AND MO.idofertatransportista = '$idoferta' ";
		}	
		return $this->Generic_model->doQuery($querystr);
	}
	///////////////////////////// END CRUD FOR EMPRESA TABLE //////////////////////////////////////////////////

	///////////////////////////// CRUD FOR SUCURSAL TABLE //////////////////////////////////////////////////
	// obtener todos los datos de un chofer agregado
	function sucursales_get_all_by_id($id, $idAcc)
	{ 

		$table = json_decode(_TABLE, true);
		$sucursal = $table["sucursal"]["name"];
		$empresa = $table["empresa"]["name"];
	 	if($id != 0){
	 		$query = $this->db->query("SELECT suc.* FROM $sucursal suc
	 								JOIN $empresa emp
	 								ON emp.idempresa = suc.idempresa_fk
	 		                       WHERE emp.idaccount = $idAcc
	 		                       AND suc.idsucursal = $id");	
	 	}else{ // 0 lista todos los camiones
	 		$query = $this->db->query("SELECT suc.* FROM $sucursal suc
	 								JOIN $empresa emp
	 								ON emp.idempresa = suc.idempresa_fk
	 		                       WHERE emp.idaccount = $idAcc");	
	 	}
	 	return $this->Generic_model->doQueryObject($query);
	}

	// obtener todos los datos de un chofer agregado
	function sucursal_update_by_id($id,$data)
	{ 
		$table = json_decode(_TABLE, true);
	 	if ($id != 0) {		
			$this->db->where('idsucursal', $id);
			$value = $this->db->update($table["sucursal"]["name"], $data);	
			return true;		
		}else{
			return false;
		}
	}


	public function fetch_tabla_sucursal($id,$limit, $start) 
	{
		$table = json_decode(_TABLE, true);
		$this->db->limit($limit, $start);
		$query = $this->db->get_where($table["sucursal"]["name"],array('idsucursal' => $id)); //add where comprado = 1 !
		return $this->Generic_model->doQueryObject($query);
	}

///////////////////////////// END CRUD FOR SUCURSAL TABLE //////////////////////////////////////////////////


}