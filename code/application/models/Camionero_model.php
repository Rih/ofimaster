<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Camionero_model extends CI_Model {
	public $table;
	function __construct()
		{
				parent::__construct();
				$this->load->model('Generic_model');
				$table = json_decode(_TABLE,true);
		}
	

	///////////////////////////// CRUD FOR CHOFER TABLE //////////////////////////////////////////////////
	//insertar by id transportista!
	function chofer_insert($data)
	{ 
		$table = json_decode(_TABLE,true);	
		$value = $this->db->insert($table["chofer"]["name"], $data);
		return $value;
	}

	//editar by id transportista!
	function chofer_update_by_id($id = 0, $data)
	{ 
		$table = json_decode(_TABLE,true);
		if ($id != 0) {		
			$this->db->where('idchofer', $id);
			$value = $this->db->update($table["chofer"]["name"], $data);	
			return true;		
		}else{
			return false;
		}
	}


	function chofer_delete_by_id($id = 0)
	{
		$table = json_decode(_TABLE,true);
		if ($id != 0) {		
			$tbl = $table["chofer"]["name"];
			$this->db->delete($tbl,array('idchofer' => $id));
			return true;		
		}else{
			return false;
		}
	}


	public function fetch_tabla_chofer($idUserType,$limit, $start) 
	{
		$table = json_decode(_TABLE, true);	
		$this->db->limit($limit, $start);
		$query = $this->db->get_where($table["chofer"]["name"],
									  array("idtransportista_fk" => $idUserType)); 
		//$query = $this->db->query("SELECT * FROM chofer WHERE 1 LIMIT 2, 2"); //add where comprado = 1 !
		return $this->Generic_model->doQueryObject($query);
	}

	 // obtener todos los datos de un chofer agregado
	function chofer_get_all_by_id($id, $idUserType = '')
	{ 
	 	$table = json_decode(_TABLE,true);
	 	if ($idUserType == ''){
	 		$query = $this->db->get_where($table["chofer"]["name"], 
	 									  array("idchofer" => $id));	
	 	}else{
	 		$query = $this->db->get_where($table["chofer"]["name"], 
	 									   array("idchofer" => $id,
	 									         "idtransportista_fk" => $idUserType));	
	 	}

	 	return $this->Generic_model->doQueryObject($query);
	}

	// obtener todos los datos de un chofer agregado
	 function get_num_choferes_by_id($idUserType)
	{ 
	 	$table = json_decode(_TABLE,true);
	 	$query = $this->db->get_where($table["chofer"]["name"], 
	 								  array("idtransportista_fk" => $idUserType));	
		return 	$query->num_rows();
	}
	///////////////////////////// END CRUD FOR CHOFER TABLE //////////////////////////////////////////////////

	//insertar by id transportista!
	function equipo_insert($data)
	{ 
		$table = json_decode(_TABLE,true);	
		$value = $this->db->insert($table["camion"]["name"],$data);
		return $value;
	}

	//editar by id transportista!
	function equipo_update_by_id($id = 0, $data)
	{ 
		$table = json_decode(_TABLE,true);
		if ($id != 0) {		
			$this->db->where('idcamion', $id);
			$value = $this->db->update($table["camion"]["name"], $data);	
			return true;
		}else{
			return false;
		}
	}


	function equipo_delete_by_id($id = 0)
	{
		$table = json_decode(_TABLE,true);
		if ($id != 0) {		
			$tbl = $table["camion"]["name"];
			$this->db->delete($tbl,array('idcamion' => $id));
			return true;		
		}else{
			return false;
		}
	}


	function fetch_tabla_equipo($idUserType,$limit, $start) 
	{
		//$this->db->limit($limit, $start);
		$table = json_decode(_TABLE,true);
		$camion = $table["camion"]["name"];
		$chofer = $table["chofer"]["name"];
		$query = $this->db->query("SELECT eq.*,ch.nombre as nombre_chofer, ch.apellido as apellido_chofer 
								   FROM $camion eq, $chofer ch 
	 		                       WHERE idchofer_fk = ch.idchofer 
	 		                       AND ch.idtransportista_fk = $idUserType LIMIT $start, $limit"); //add where comprado = 1 !
		return $this->Generic_model->doQueryObject($query);
	}


	function get_tipo_equipo() 
	{
		//$this->db->limit($limit, $start);
		$table = json_decode(_TABLE,true);
		$camion = $table["camion"]["name"];
		$query = $this->db->query("SELECT DISTINCT tipo FROM $camion");	
		return $this->Generic_model->doQueryObject($query);
	}


	function get_tipo_carga() 
	{
		//$this->db->limit($limit, $start);
		$table = json_decode(_TABLE,true);
		$carga = $table["carga"]["name"];
		$query = $this->db->query("SELECT DISTINCT tipo FROM $carga");	
		return $this->Generic_model->doQueryObject($query);
	}


	function equipo_get_all_by_id($id, $idUserType) // obtener todos los datos de un chofer agregado
	{ 
		$table = json_decode(_TABLE,true);
		$camion = $table["camion"]["name"];		$EQ = $table["camion"]["alias"];
		$chofer = $table["chofer"]["name"];		$CH = $table["chofer"]["alias"];
	 	if($id != 0){
	 		$query = $this->db->query("SELECT * FROM $camion $EQ, $chofer $CH 
	 		                       WHERE $EQ.idcamion = $id 
	 		                       AND $EQ.idchofer_fk = $CH.idchofer 
	 		                       AND $CH.idtransportista_fk = $idUserType");	
	 	}else{ // 0 lista todos los camiones
	 		$query = $this->db->query("SELECT $EQ.*, $CH.* FROM $camion $EQ, $chofer $CH 
	 		                       WHERE $EQ.idchofer_fk = $CH.idchofer 
	 		                       AND $CH.idtransportista_fk = $idUserType");	
	 	}
	 	return $this->Generic_model->doQueryObject($query);
	}


	function get_num_equipos_by_id($idUserType) // obtener todos los datos de un chofer agregado
	{ 
		$table = json_decode(_TABLE,true);
		$camion = $table["camion"]["name"];
		$chofer = $table["chofer"]["name"];
	 	$query = $this->db->query("SELECT eq.* FROM $camion eq, $chofer ch 
	 		                       WHERE idchofer_fk = ch.idchofer 
	 		                       AND ch.idtransportista_fk = $idUserType");	
		return $query->num_rows();		
	}

///////////////////////////// END CRUD FOR CAMION TABLE //////////////////////////////////////////////////

}