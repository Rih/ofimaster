<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model {
	
	function __construct()
		{
				parent::__construct();
		}
	

	 public function fillPageDataCounters($usertype,$idUserType,$page_data,$page_name,$page_title){

        
        if($usertype == "Transportista"){
        	$page_data['page_name']  = $page_name;
	        $page_data['page_title'] = $page_title;  
	        $idAcc = $this->session->userdata('userid');     
	        $page_data['num_choferes'] = $this->Crud_model->get_num_choferes_by_id($idUserType);    
	        $page_data['num_equipos'] = $this->Crud_model->get_num_equipos_by_id($idUserType);    
	        $page_data['num_ofertas'] = $this->Crud_model->get_num_ofertatransportista_by_id($idUserType);
	        $page_data['modal_title_add'] = 'Agregar '.$page_name;
	        $page_data['modal_title_upd'] = 'Modificar '.$page_name;
            $page_data['modal_title_text_add'] = 'Para agregar por favor rellene los campos solicitados.';
            $page_data['modal_title_text_upd'] = 'Para modificar por favor rellene los campos solicitados.';
            if ($page_name == "misofertas"){
            	     $page_data['modal_title_upd'] = 'Modificar Mi Oferta';
            }
	        if ( in_array($page_name, array("missolicitudes_recibidas","missolicitudes_enviadas","historial","buscarcarga")) ){
	        	$page_data['modal_title_add'] = 'Detalle de la oferta';
		        $page_data['modal_title_upd'] = 'Detalle de la oferta';
	            $page_data['modal_title_text_add'] = 'Información de toda la oferta.';
	            $page_data['modal_title_text_upd'] = 'Información de toda la oferta.';
	        }
           
	        $page_data['num_solicitudes_enviadas'] = $this->Crud_model->get_num_match_ofertatransportista_by_id($idUserType,'','enviadas');
	        $page_data['num_solicitudes_recibidas'] = $this->Crud_model->get_num_match_ofertatransportista_by_id($idUserType,'','recibidas');
	        $page_data['num_historial'] = $this->Crud_model->get_num_match_ofertatransportista_by_id($idUserType,'','both');
	            
        }
        else if($usertype == "GeneradorCarga"){
        	$page_data['page_name']  = $page_name;
	        $page_data['page_title'] = $page_title;  
	        $idAcc = $this->session->userdata('userid');     
	        $page_data['num_ofertas'] = $this->Crud_model->get_num_ofertacarga_by_id($idUserType);  
	        $page_data['modal_title_add'] = 'Agregar '.$page_name;
            $page_data['modal_title_upd'] = 'Modificar '.$page_name;
            $page_data['modal_title_text_add'] = 'Para agregar por favor rellene los campos solicitados.';
            $page_data['modal_title_text_upd'] = 'Para modificar por favor rellene los campos solicitados.';  
             if ($page_name == "misofertas"){
            	     $page_data['modal_title_upd'] = 'Modificar Mi Oferta';
            }
	        if ( in_array($page_name, array("missolicitudes_recibidas","missolicitudes_enviadas","historial","buscarcamion")) ){
	        	$page_data['modal_title_add'] = 'Detalle de la oferta';
		        $page_data['modal_title_upd'] = 'Detalle de la oferta';
	            $page_data['modal_title_text_add'] = 'Información de toda la oferta.';
	            $page_data['modal_title_text_upd'] = 'Información de toda la oferta.';
	        }
                   
            $page_data['num_solicitudes_enviadas'] = $this->Crud_model->get_num_match_ofertacarga_by_id($idUserType,'','enviadas');
            $page_data['num_solicitudes_recibidas'] = $this->Crud_model->get_num_match_ofertacarga_by_id($idUserType,'','recibidas');
            $page_data['num_historial'] = $this->Crud_model->get_num_match_ofertacarga_by_id($idUserType,'','both');
            
        }else if($usertype == "Admin"){
        	$page_data['page_name']  = $page_name;
	        $page_data['page_title'] = $page_title;  
	        $idAcc = $this->session->userdata('userid');     
	        $page_data['num_choferes'] = $this->Admin_model->get_num_filas('chofer');    
            $page_data['num_equipos'] = $this->Admin_model->get_num_filas('camion');    
            $page_data['num_cargas'] = $this->Admin_model->get_num_filas('carga');
            $page_data['num_cuentas'] = $this->Admin_model->get_num_filas('account');
            $page_data['num_regiones'] = $this->Admin_model->get_num_filas('region');
            $page_data['num_ciudades'] = $this->Admin_model->get_num_filas('ciudad');
	            
        }
        return $page_data;
        
    }

    public function createPagination($url,$perpage,$urisegment,$total_rows,$dataName,$Alldata){
    	
    	$this->load->library("pagination");
		$config = array();
        $config["base_url"] = $url;
        $config["total_rows"] = $total_rows;
        $config["per_page"] = $perpage; //20 antes
        $config["uri_segment"] = $urisegment; 

        $config['first_link'] = '<i class="fa fa-fast-backward"></i>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = '<i class="fa fa-fast-forward"></i>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        
        $config['next_link'] = '<i class="fa fa-step-forward"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '<i class="fa fa-step-backward"></i>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

        $this->pagination->initialize($config); 
        $page = ($this->uri->segment($urisegment)) ? $this->uri->segment($urisegment) : 0;
        $limit = $config["per_page"];
        $start = $page;            
        

        $page_data['equipos'] = $this->Crud_model->fetch_tabla_equipo($idUserType,$limit,$start);

        $page_data["links"] = $this->pagination->create_links();

        return $page_data;
    }
	

	public function formateaFecha($input,$showYear = "si"){
		$resp = "";
		$meses = array("01"=> "Ene" ,"02" => "Feb" ,"03"=> "Mar" ,"04"=> "Abr" ,"05"=> "May" ,"06"=> "Jun" ,
						"07" => "Jul" ,"08"=> "Ago" ,"09"=> "Sep" ,"10"=> "Oct" ,"11"=> "Nov" ,"12"=> "Dic");
		
		//$meses = array(1 => "Ene" ,2 => "Feb" ,3 => "Mar" ,4 => "Abr" ,5 => "May" ,6 => "Jun" ,
		//				7 => "Jul" ,8 => "Ago" ,9 => "Sep" ,10 => "Oct" ,11 => "Nov" , 12 => "Dic");
		$input = str_replace("-","/",$input);
		$input_arr = explode("/",$input);		
		//print_r($meses[$input_arr[1]]);
		$day = intval($input_arr[2]);
		$resp = $day . " " . $meses[$input_arr[1]];
		$year = " de ".$input_arr[0];
		if($showYear== "si") $resp .= $year;
		return $resp;
	}
	public function generateRandomString($length = 10,$option = -1) {
			$signs = '!#$*{}+-_:.;,[]';
			$characters = array('ABCDE01FGHIJ23KLMNO45PQRST67UVWXYZ89'.$signs,
								$signs.'0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
								'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'.$signs,      
								$signs.'ABCDEFGHIJKLMNO01234PQRSTUVWXYZ56789',      
								'56789ABCDEFGHIJKLMNO01234PQRSTUVWXYZ'.$signs,								
								'abcde01fghij23klmno45pqrst67uvwxyzZ89'.$signs,
								$signs.'0123456789abcdefghijklmnopqrstuvwxyz',
								'abcdefghijklmnopqrstuvwxyz0123456789'.$signs,      
								$signs.'abcdefghijklmno01234pqrstuvwxyz56789',      
								'56789abcdefghijklmno01234pqrstuvwxyz'.$signs
								);
			

			$charactersLength = strlen($characters[0]);
			$charsetlength = count($characters);			
			$randomString = '';
			if($option > $charsetlength-1) $option = 0;
			$position0 = $option;
			for ($i = 0; $i < $length; $i++) {  					
					$position = rand(0, $charactersLength - 1);
					if($option === -1){
						$position0 = rand(0, $charsetlength - 1);
					}
					$randomString .= strval($characters[$position0][$position]);
					
			}
			return $randomString;
	}	
	public function generateRandomToken($length = 10) {
			$signs = '!#$*{}+-_:.;,[]';
			$characters = array('ABCDE01FGHIJ23KLMNO45PQRST67UVWXYZ89'
								);
			

			$charactersLength = strlen($characters[0]);
			$charsetlength = count($characters);			
			$randomString = ''; $option = 0;
			$position0 = $option;
			for ($i = 0; $i < $length; $i++) {  					
					$position = rand(0, $charactersLength - 1);
					if($option === -1){
						$position0 = rand(0, $charsetlength - 1);
					}
					$randomString .= strval($characters[$position0][$position]);
					
			}
			return $randomString;
	}	
	function createQuestions()	{
		$idoa = $this->session->userdata("idoa");
		$total = intval($this->oa_get_field_by_id($idoa,"total")->total);
		$num_tonos = 4;
		$questions = array();		
		$totalchr = count($this->chrSinTonos);
		$result = array();
		$i = 0;
		while($i < $total){
			$positionSilab = rand(0,$totalchr);
			if(!in_array($this->chrSinTonos[$positionSilab],$questions)){//avanzo solo si es silaba distinta
				$questions[] = $this->chrSinTonos[$positionSilab];
				$i++;
			}
		}
		//print_r($totalchr);
		//print_r($questions);
		$j = 1;
		foreach($questions as $q){
			$data = array("silab" => $q,
						  "correct_tone" => rand(1,$num_tonos),
						  "filled" => 1
					);
			$this->questions_update_fields_by_id_numberq($idoa,$j,$data);
			$j++;
		}

	}
///////////////////////////// GENERIC CRUD FOR TABLE //////////////////////////////////////////////////

	function delete_by_id($table = '',$id=0, $iduser){
		if ($id != 0) {
			$tables = array('oa','questions');
			if(in_array($table,$tables)){
				$this->db->delete($table,array('id' => $id));
				return true;
			}
			else{ return false; }
			
		}else{
			return false;
		}
		
	}

	public function get_distancia_ciudades($idciudad1, $idciudad2) {
		
		if(is_int($idciudad1) && is_int($idciudad2) ){
			$query = $this->db->get_where("calculo_distancia_ciudades",array("idciudad1" => $idciudad1, "idciudad2" => $idciudad2));
			if ($query->num_rows() > 0) {
					$dist = $query->first_row()->distancia;						
					return intval($dist);
			}
			
		}
		return -1;	
		
	 }

	public function fetch_tabla($tabla,$limit, $start) {
		$this->db->limit($limit, $start);
		$query = $this->db->get($tabla); //add where comprado = 1 !

		if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
						$data[] = $row;
				}
				return $data;
		}
		return false;
	 }
	 

	public function get_num_filas($tabla)
	{
		$total = 0;
		$total = $this->db->count_all($tabla);		
		return $total;
	}

	function get_field_by_id($table, $id = '',$fieldname = ''){
		if($fieldname != ''){
			if($table == "account"){
				$result = $this->db->select($fieldname)					
					->get_where($table,array("id" => $id))
					->row();
			}else if($table == "match_ofertas"){
				$result = $this->db->select($fieldname)					
					->get_where($table,array("idmatch" => $id))
					->row();
			}else{
				$result = $this->db->select($fieldname)					
					->get_where($table,array("id".$table => $id))
					->row();	
			}
			
			return $result;
		
		}else{
			return false;
		}
		
	}
	function table_update_by_id($table,$id,$fieldname,$value){
	$data = array($fieldname => $value);
	if($table == 'account'){
		$this->db->where('id', $id);
	}else if($table == 'match_ofertas'){
		$this->db->where('idmatch', $id);
	}else{
		$this->db->where('id'.$table, $id);
	}	
	$value = $this->db->update($table, $data);
	return $value;
	
	}
	
	function match_ofertas_update_estado_oferta( $idofertatransportista, $idofertacarga,$value){
	
	//VER
	$this->db->query("UPDATE match_ofertas
	SET estado_oferta = '$value'
	WHERE idofertatransportista = '$idofertatransportista' 
	      AND idofertacarga = '$idofertacarga'");
	//$this->db->query("COMMIT");
	
	return $value;
	
	}
	
	 function table_insert($tablename, $data)
	{
		
		$value = $this->db->insert($tablename,$data);
		return $value;
	}
///////////////////////////// GENERIC CRUD FOR TABLE //////////////////////////////////////////////////
////////////------------------------------END-----------------------------------------------///////////


///////////////////////////// CRUD FOR ACCOUNT TABLE //////////////////////////////////////////////////
      

	function account_insert($muser, $mpassword, $salt, $type){
		$data = array(
			'Muser' =>$muser,
			'Mpassword' =>$mpassword,
			'salt' =>$salt,
			'usertype' => $type
			);
		$value = $this->db->insert('account',$data);
		return $value;
	}

	function account_delete_by_id($table = 'account',$iduser=0){
		if ($iduser != 0) {
			$tables = array('account');
			if(in_array($table,$tables)){
				$this->db->delete($table,array('id' => $iduser));
				return true;
			}
			else{ return false; }
			
		}else{
			return false;
		}
		
	}
	function account_update_field_by_id($id,$namefield,$field){
		$data = array( $namefield => $field );
		$this->db->where('id', $id);
		$value = $this->db->update('account', $data);
		return $value;
	}

	function account_update_by_id($id, $newpassword= '',$newpattern = '', $newsalt= ''){
		if ($newpassword != ''){
			$data = array( 'Mpassword' => $newpassword );
			$this->db->where('id', $id);
			$this->db->update('account', $data);	
		} 
		if ($newpattern != ''){
			$data = array( 'Mpattern' => $newpattern );
			$this->db->where('id', $id);
			$this->db->update('account', $data);	
		} 
		if ($newsalt != ''){
			$data = array( 'salt' => $newsalt );
			$this->db->where('id', $id);
			$this->db->update('account', $data);	
		} 
		return true;
	}

	function account_get_id_by_Muser($mail = '',$logged = false){
		if ($logged == true) {
			$mail = $this->session->userdata('email');
		}
		if($mail != ''){			
			return $this->db->select('id')->get_where('account', array( 'Muser'=> $mail))->row()->id;
		}else{
			return false;
		}
		
	}
	function account_get_all_by_Muser($mail = '',$logged = false){
		if ($logged == true) {
			$mail = $this->session->userdata('email');
		}
		if($mail != ''){			
			return $this->db->get_where('account', array( 'Muser'=> $mail))->row();
		}else{
			return false;
		}
		
	}
	function account_get_all_by_iduser($iduser = '',$logged = false){
		if ($logged == true) {
			$iduser = $this->session->userdata('userid');
		}
		if($iduser != ''){			
			return $this->db->get_where('account', array( 'id'=> $iduser))->row_array();
		}else{
			return false;
		}
		
	}


	function account_get_id_by_type($idusr = '',$type){ //Type = Transportista, GeneradorCarga
		if ($type == "Transportista") {
			return $this->db->select('idtransportista')->get_where('transportista', array( 'idaccount'=> $idusr))->row()->idtransportista;
		}
		else if ($type == "GeneradorCarga") {
			return $this->db->select('idgeneradorcarga')->get_where('generadorcarga', array( 'idaccount'=> $idusr))->row()->idgeneradorcarga;
		}else{
			return false;
		}
		
	}
////////////------------------------------END-----------------------------------------------///////////




///////////////////////////// CRUD FOR REGIONS TABLE //////////////////////////////////////////////////

function regions_get_all(){

		
		$info = $this->db->get_where('regions',array('idOA' => $id));

		if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
						$data[] = $row;
				}
				return $data[0];
		}
		return false;

	}

///////////////////////////// END CRUD FOR REGIONS TABLE //////////////////////////////////////////////////

///////////////////////////// CRUD FOR CHOFER TABLE //////////////////////////////////////////////////

function chofer_insert($data){ //insertar by id transportista!
		
	$value = $this->db->insert('chofer',$data);
	return $value;
}
function chofer_update_by_id($id = 0, $data){ //editar by id transportista!
	if ($id != 0) {		
		$this->db->where('idchofer', $id);
		$value = $this->db->update('chofer', $data);	
		return true;		
	}else{
		return false;
	}
	
}

function chofer_delete_by_id($id = 0){
	if ($id != 0) {		
		$table = "chofer";
		$this->db->delete($table,array('idchofer' => $id));
		return true;		
	}else{
		return false;
	}
	
}
public function fetch_tabla_chofer($idUserType,$limit, $start) {
	
	$this->db->limit($limit, $start);
	$query = $this->db->get_where('chofer',array("idtransportista_fk" => $idUserType)); 
		//$query = $this->db->query("SELECT * FROM chofer WHERE 1 LIMIT 2, 2"); //add where comprado = 1 !
	//$this->db->limit($limit, $start);
	if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
					$data[] = $row;
			}
			return $data;
	}
	return false;
 }


 function chofer_get_all_by_id($id, $idUserType = ''){ // obtener todos los datos de un chofer agregado

 	if ($idUserType == ''){
 		$query = $this->db->get_where("chofer", array("idchofer" => $id));	
 	}else{
 		$query = $this->db->get_where("chofer", array("idchofer" => $id,
 									"idtransportista_fk" => $idUserType));	
 	}

 	
 	if ($query->num_rows() > 0) {
		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}
		return $data;		
	}
	return false;


 }

 function get_num_choferes_by_id($idUserType){ // obtener todos los datos de un chofer agregado

 	$query = $this->db->get_where("chofer", array("idtransportista_fk" => $idUserType));	
	return 	$query->num_rows();
 }
///////////////////////////// END CRUD FOR CHOFER TABLE //////////////////////////////////////////////////


///////////////////////////// CRUD FOR CHOFER TABLE //////////////////////////////////////////////////

function equipo_insert($data){ //insertar by id transportista!
		
	$value = $this->db->insert('camion',$data);
	return $value;
}
function equipo_update_by_id($id = 0, $data){ //editar by id transportista!
	if ($id != 0) {		
		$this->db->where('idcamion', $id);
		$value = $this->db->update('camion', $data);	
		return true;		
	}else{
		return false;
	}
	
}

function equipo_delete_by_id($id = 0){
	if ($id != 0) {		
		$table = "camion";
		$this->db->delete($table,array('idcamion' => $id));
		return true;		
	}else{
		return false;
	}
	
}
function fetch_tabla_equipo($idUserType,$limit, $start) {
	//$this->db->limit($limit, $start);
	$query = $this->db->query("SELECT eq.*,ch.nombre as nombre_chofer, ch.apellido as apellido_chofer 
							   FROM camion eq, chofer ch 
 		                       WHERE idchofer_fk = ch.idchofer 
 		                       AND ch.idtransportista_fk = $idUserType LIMIT $start, $limit"); //add where comprado = 1 !

	if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
					$data[] = $row;
			}
			return $data;
	}
	return false;
 }
function get_tipo_equipo() {
	//$this->db->limit($limit, $start);
	$query = $this->db->query("SELECT DISTINCT tipo FROM camion");	

	if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
					$data[] = $row;
			}
			return $data;
	}
	return false;
 }
 function get_tipo_carga() {
	//$this->db->limit($limit, $start);
	$query = $this->db->query("SELECT DISTINCT tipo FROM carga");	

	if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
					$data[] = $row;
			}
			return $data;
	}
	return false;
 }

 

 function equipo_get_all_by_id($id, $idUserType){ // obtener todos los datos de un chofer agregado

 	if($id != 0){
 		$query = $this->db->query("SELECT * FROM camion eq, chofer ch 
 		                       WHERE idcamion = $id 
 		                       AND idchofer_fk = ch.idchofer 
 		                       AND ch.idtransportista_fk = $idUserType");	
 	}else{ // 0 lista todos los camiones
 		$query = $this->db->query("SELECT eq.* FROM camion eq, chofer ch 
 		                       WHERE idchofer_fk = ch.idchofer 
 		                       AND ch.idtransportista_fk = $idUserType");	
 	}
 	
 	if ($query->num_rows() > 0) {
		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}
		return $data;		
	}
	return false;


 }

 function get_num_equipos_by_id($idUserType){ // obtener todos los datos de un chofer agregado

 	
 	$query = $this->db->query("SELECT eq.* FROM camion eq, chofer ch 
 		                       WHERE idchofer_fk = ch.idchofer 
 		                       AND ch.idtransportista_fk = $idUserType");	
 	
	return $query->num_rows();		

 }

///////////////////////////// END CRUD FOR CAMION TABLE //////////////////////////////////////////////////


///////////////////////////// CRUD FOR EMPRESA TABLE //////////////////////////////////////////////////

function get_lastPublicaciones($idUserType, $usertype, $idAcc, $status = '0'){
	$querystr = ""; $and_where = "";
	$inner_join = "";
	/** EJEMPLO A MODIFICAR

	SELECT OT.idofertatransportista, OT.patente,OT.ubicacion, OT.destino_preferente,
		OT.fecha_disponibilidad, OT.fecha_publicacion,OT.detalle,
		C1.nombre as nciudad_origen, C2.nombre as nciudad_destino,
		R1.nombre as nregion_origen, R2.nombre as nregion_destino,
		E.idempresa,E.fono, E.razon_social as nombre_empresa,
		OC.precio, OC.cantidad_carga, CH.nombre as nombre_chofer, CH.apellido as apellido_chofer, CH.RUT,
		MO.estado_oferta, MO.estado_solicitud, MO.estado_oferta_GC, MO.estado_solicitud_GC
		FROM empresa E 
		INNER JOIN account ACC ON  E.idaccount = ACC.id 
		INNER JOIN transportista T ON T.idaccount = ACC.id
		INNER JOIN ofertatransportista OT ON T.idtransportista = OT.idtransportista_fk
		INNER JOIN match_ofertas MO ON OT.idofertatransportista = MO.idofertatransportista
		AND (MO.estado_oferta IN (0,1,2) OR MO.estado_solicitud IN (0,1,2) )
		INNER JOIN ofertacarga OC ON OC.idofertacarga = MO.idofertacarga
		INNER JOIN camion CA ON CA.patente = OT.patente
		INNER JOIN chofer CH ON CH.idchofer = CA.idchofer_fk
		JOIN ciudad C1 ON C1.idciudad = OT.ubicacion
		JOIN ciudad C2 ON  C2.idciudad = OT.destino_preferente	
		JOIN region R1 ON R1.idregion = OT.region_ubicacion		
		JOIN region R2 ON R2.idregion = OT.region_destino
		WHERE ACC.id = '2' AND OT.idtransportista_fk = '1'
		AND (OT.estado_oferta = '2')
		order by OT.fecha_publicacion DESC
		LIMIT 0,5
	
	*/
	if($usertype == "Transportista"){
		/*$querystr = "SELECT OT.idofertatransportista, OT.patente,OT.ubicacion, OT.destino_preferente,
		OT.fecha_disponibilidad, OT.fecha_publicacion,OT.detalle,
		C1.nombre as nciudad_origen, C2.nombre as nciudad_destino,
		R1.nombre as nregion_origen, R2.nombre as nregion_destino,
		E.idempresa,E.fono, E.razon_social as nombre_empresa
		FROM empresa E 
		INNER JOIN account ACC ON  E.idaccount = ACC.id 
		INNER JOIN transportista T ON T.idaccount = ACC.id
		INNER JOIN ofertatransportista OT ON T.idtransportista = OT.idtransportista_fk		
		JOIN ciudad C1 ON C1.idciudad = OT.ubicacion
		JOIN ciudad C2 ON  C2.idciudad = OT.destino_preferente	
		JOIN region R1 ON R1.idregion = OT.region_ubicacion		
		JOIN region R2 ON R2.idregion = OT.region_destino
		WHERE ACC.id = '$idAcc' AND OT.idtransportista_fk = '$idUserType'
		AND (OT.estado_oferta = '$status')
		order by OT.fecha_publicacion DESC
		LIMIT 0,5
		"; */

		$querystr = "SELECT OT.idofertatransportista, OT.patente,OT.ubicacion, OT.destino_preferente,
		OT.fecha_disponibilidad, OT.fecha_publicacion,OT.detalle,
		C1.nombre as nciudad_origen, C2.nombre as nciudad_destino,
		R1.nombre as nregion_origen, R2.nombre as nregion_destino,		
		OC.precio, OC.cantidad_carga, CH.nombre as nombre_chofer, CH.apellido as apellido_chofer, CH.RUT,
		MO.estado_oferta, MO.estado_solicitud, MO.estado_oferta_GC, MO.estado_solicitud_GC,
		MO.descripcion_estado_oferta,MO.descripcion_estado_solicitud
		FROM ofertatransportista OT 		
		INNER JOIN match_ofertas MO ON OT.idofertatransportista = MO.idofertatransportista
		AND (MO.estado_oferta IN (2) OR MO.estado_solicitud IN (2) )
		LEFT JOIN ofertacarga OC ON MO.idofertacarga = OC.idofertacarga
		INNER JOIN camion CA ON CA.patente = OT.patente
		INNER JOIN chofer CH ON CH.idchofer = CA.idchofer_fk		
		JOIN ciudad C1 ON C1.idciudad = OT.ubicacion
		JOIN ciudad C2 ON  C2.idciudad = OT.destino_preferente	
		JOIN region R1 ON R1.idregion = OT.region_ubicacion		
		JOIN region R2 ON R2.idregion = OT.region_destino
		WHERE OT.idtransportista_fk = '$idUserType' 
		AND (OT.estado_oferta = '2')
		order by OT.fecha_publicacion DESC
		LIMIT 0,5";

		$inner_join = "  ";
		$and_where = " ";

	}else if($usertype == "GeneradorCarga"){
		$inner_join = " INNER JOIN generadorcarga T ON T.idaccount = ACC.id ";
		$and_where = " AND OC.idgeneradorcarga_fk = '".$idUserType."' ";

		/* $querystr = "SELECT OC.idofertacarga, OC.origen_ciudad, OC.destino_ciudad,
		OC.fecha_carga, OC.fecha_publicacion, OC.detalle,
		C1.nombre as nciudad_origen, C2.nombre as nciudad_destino,
		R1.nombre as nregion_origen, R2.nombre as nregion_destino,
		E.idempresa,E.fono, E.razon_social as nombre_empresa 
		FROM empresa E 
		INNER JOIN account ACC ON  E.idaccount = ACC.id 
		INNER JOIN generadorcarga GC ON GC.idaccount = ACC.id
		INNER JOIN ofertacarga OC ON GC.idgeneradorcarga = OC.idgeneradorcarga_fk
		JOIN ciudad C1 ON C1.idciudad = OC.origen_ciudad
		JOIN ciudad C2 ON  C2.idciudad = OC.destino_ciudad
		JOIN region R1 ON R1.idregion = OC.origen_region		
		JOIN region R2 ON R2.idregion = OC.destino_region
		WHERE ACC.id = '$idAcc' AND OC.idgeneradorcarga_fk = '$idUserType'
		AND (OC.estado_oferta = '$status')
		order by OC.fecha_publicacion DESC
		LIMIT 0,5";
		*/

		$querystr = "SELECT OC.idofertacarga, OT.patente,OT.ubicacion, OT.destino_preferente,
		OC.fecha_carga, OC.fecha_publicacion,OC.detalle,
		C1.nombre as nciudad_origen, C2.nombre as nciudad_destino,
		R1.nombre as nregion_origen, R2.nombre as nregion_destino,		
		OC.precio, OC.cantidad_carga, CH.nombre as nombre_chofer, CH.apellido as apellido_chofer, CH.RUT,
		MO.estado_oferta, MO.estado_solicitud, MO.estado_oferta_GC, MO.estado_solicitud_GC,
		MO.descripcion_estado_oferta_GC,MO.descripcion_estado_solicitud_GC
		FROM ofertacarga OC		
		INNER JOIN match_ofertas MO ON OC.idofertacarga = MO.idofertacarga
		AND (MO.estado_oferta_GC IN (2) OR MO.estado_solicitud_GC IN (2) )
		LEFT JOIN ofertatransportista OT ON  MO.idofertatransportista = OT.idofertatransportista
		INNER JOIN camion CA ON CA.patente = OT.patente
		INNER JOIN chofer CH ON CH.idchofer = CA.idchofer_fk
		JOIN ciudad C1 ON C1.idciudad = OC.origen_ciudad
		JOIN ciudad C2 ON  C2.idciudad = OC.destino_ciudad	
		JOIN region R1 ON R1.idregion = OC.origen_region		
		JOIN region R2 ON R2.idregion = OC.destino_region		
		WHERE OC.idgeneradorcarga_fk = '$idUserType' 
		AND (OC.estado_oferta = '2')
		order by OC.fecha_publicacion DESC
		LIMIT 0,5";
	}
	
	
	$query = $this->db->query($querystr);
	if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
					$data[] = $row;
			}
			return $data;
	}
	return false; 
}

function get_empresa_by_idusertype($idusertype, $usertype){
	if ($usertype == 'Transportista'){
		$querystr = "SELECT E.* FROM empresa E 
		INNER JOIN account ACC ON  E.idaccount = ACC.id 
		INNER JOIN generadorcarga GC ON GC.idaccount = ACC.id
		WHERE GC.idgeneradorcarga = $idusertype";
	}else if($userype == 'GeneradorCarga'){
		$querystr = "SELECT E.* FROM empresa E 
		INNER JOIN account ACC ON  E.idaccount = ACC.id 
		INNER JOIN transportista T ON T.idaccount = ACC.id
		WHERE T.idtransportista = $idusertype";
	}
	$query = $this->db->query($querystr);
	if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
					$data[] = $row;
			}
			return $data;
	}
	return false;

}
function empresa_update_by_id($id,$data){ // obtener todos los datos de un chofer agregado

 	if ($id != 0) {		
		$this->db->where('idaccount', $id);
		$value = $this->db->update('empresa', $data);	
		return true;		
	}else{
		return false;
	}

 }
 public function fetch_tabla_empresa($id,$limit, $start) {
	$this->db->limit($limit, $start);

	$query = $this->db->get_where('empresa',array('idaccount' => $id)); //add where comprado = 1 !

	if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
					$data[] = $row;
			}
			return $data;
	}
	return false;
 }

function fetch_tabla_empresa_by_match($modalidad,$idoferta ){
	$querystr = "";
	if($modalidad == "GeneradorCarga"){ //ve datos de su contraparte
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
	}else if($modalidad == "Transportista"){ //ve datos de su contraparte
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
	
	

	$query = $this->db->query($querystr);
	if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
					$data[] = $row;
			}
			return $data;
	}
	return false;


}
///////////////////////////// END CRUD FOR EMPRESA TABLE //////////////////////////////////////////////////

///////////////////////////// CRUD FOR SUCURSAL TABLE //////////////////////////////////////////////////

function sucursales_get_all_by_id($id, $idAcc){ // obtener todos los datos de un chofer agregado

 	if($id != 0){
 		$query = $this->db->query("SELECT suc.* FROM sucursal suc
 								JOIN empresa emp
 								ON emp.idempresa = suc.idempresa_fk
 		                       WHERE emp.idaccount = $idAcc
 		                       AND suc.idsucursal = $id");	
 	}else{ // 0 lista todos los camiones
 		$query = $this->db->query("SELECT suc.* FROM sucursal suc
 								JOIN empresa emp
 								ON emp.idempresa = suc.idempresa_fk
 		                       WHERE emp.idaccount = $idAcc");	
 	}
 	
 	if ($query->num_rows() > 0) {
		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}
		return $data;		
	}
	return false;


 }

function sucursal_update_by_id($id,$data){ // obtener todos los datos de un chofer agregado

 	if ($id != 0) {		
		$this->db->where('idsucursal', $id);
		$value = $this->db->update('sucursal', $data);	
		return true;		
	}else{
		return false;
	}

 }
 public function fetch_tabla_sucursal($id,$limit, $start) {
	$this->db->limit($limit, $start);

	$query = $this->db->get_where('sucursal',array('idsucursal' => $id)); //add where comprado = 1 !

	if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
					$data[] = $row;
			}
			return $data;
	}
	return false;
 }

///////////////////////////// END CRUD FOR SUCURSAL TABLE //////////////////////////////////////////////////

 function ofertatransportista_search($idUserType,$region_origen = "-1",$region_destino = "-1",$tipo_camion="-1"){


	$query = "SELECT 
          T.*,
          ifnull(count(MO.idofertacarga),0) AS solicitudes
        FROM 
	(SELECT 
		OT.idofertatransportista,OT.IDTRANSPORTISTA_FK, 
		OT.fecha_publicacion, OT.patente, OT.tipo_camion,
		OT.fecha_disponibilidad, OT.detalle, 
		OT.ubicacion, OT.destino_preferente AS destino,
		OT.direccion_ubicacion, OT.direccion_destino,
        C1.nombre AS nciudad_origen, C2.nombre AS nciudad_destino,
        R1.nombre AS nregion_origen, R2.nombre AS nregion_destino,
        OT.estado_oferta, OT.descripcion_estado
				FROM ofertatransportista OT 
				JOIN ciudad C1 ON C1.idciudad = OT.ubicacion
				JOIN ciudad C2 ON  C2.idciudad = OT.destino_preferente	
				JOIN region R1 ON R1.idregion = OT.region_ubicacion
				JOIN region R2 ON  R2.idregion = OT.region_destino			
			WHERE 
				(OT.region_ubicacion = $region_origen OR $region_origen = -1) 
				AND (OT.region_destino = $region_destino OR $region_destino = -1) 				
				AND (OT.tipo_camion = '$tipo_camion' OR '$tipo_camion' = '-1')
				AND (OT.estado_oferta = '0'
				)
			) T
		LEFT OUTER JOIN `match_ofertas` MO 
		ON T.idofertatransportista = MO.idofertatransportista AND MO.estado_oferta_GC = '0'		
		LEFT OUTER JOIN `ofertacarga` OC
		ON MO.idofertacarga = OC.idofertacarga AND MO.idofertacarga = '$idUserType'
	    GROUP BY 
	    T.idofertatransportista,T.IDTRANSPORTISTA_FK, 
		T.fecha_publicacion, T.patente, T.tipo_camion,
		T.fecha_disponibilidad, T.detalle, 
		T.ubicacion, T.destino,
		T.direccion_ubicacion, T.direccion_destino,        
        T.estado_oferta, T.descripcion_estado,
		T.nciudad_origen, T.nciudad_destino
		
			";
	$res = $this->db->query($query);
	if ($res->num_rows() > 0) {
			foreach ($res->result_array() as $row) {
					$data[] = $row;
			}
			return $data;
	}
	return false;

}


function ofertacarga_get_num(){
	$query = "SELECT OC.idofertacarga
			FROM ofertacarga OC, match_ofertas MO
			WHERE NOT OC.idofertacarga = MO.idofertacarga";
	$res = $this->db->query($query);
	return $res->num_rows();

}
function ofertatransportista_get_num(){
	$query = "SELECT OC.idofertatransportista
			FROM ofertatransportista OC, match_ofertas MO
			WHERE NOT OC.idofertatransportista = MO.idofertatransportista";
	$res = $this->db->query($query);
	return $res->num_rows();

}

function ofertacarga_search($idUserType, $region_origen = "-1",$region_destino = "-1",$tipo_carga="-1",$tipo_camion="-1", $eslicitacion="-1"){


	$query = "SELECT 
          T.*,
          ifnull(count(MO.idofertatransportista),0) AS solicitudes
        FROM 
		(SELECT 
		OC.idofertacarga, OC.idgeneradorcarga_fk, OC.fecha_carga, OC.precio, OC.tipo_carga, OC.cantidad_carga, 
		OC.fecha_publicacion, OC.tipo_camion, OC.distancia, OC.fecha_descarga,
		OC.detalle, 
		OC.esLicitacion, OC.cantidad_viajes,OC.descripcion_estado,
		OC.origen_direccion, OC.destino_direccion,
				C1.nombre AS nciudad_origen, C2.nombre AS nciudad_destino, 
				R1.nombre AS nregion_origen, R2.nombre AS nregion_destino
			FROM ofertacarga OC 
				JOIN ciudad C1 ON C1.idciudad = OC.origen_ciudad
				JOIN ciudad C2 ON  C2.idciudad = OC.destino_ciudad
				JOIN region R1 ON R1.idregion = OC.origen_region
				JOIN region R2 ON  R2.idregion = OC.destino_region
			WHERE 
				(OC.origen_region = $region_origen OR $region_origen = -1) 
				AND (OC.destino_region = $region_destino OR $region_destino = -1) 
				AND (OC.tipo_carga = '$tipo_carga' OR '$tipo_carga' = '-1')
				AND (OC.tipo_camion = '$tipo_camion' OR '$tipo_camion' = '-1')
				AND (OC.esLicitacion = '$eslicitacion' OR '$eslicitacion' = '-1') 
				AND (OC.estado_oferta = '0')
		) T
		LEFT OUTER JOIN `match_ofertas` MO 
		ON T.idofertacarga = MO.idofertacarga AND MO.estado_oferta = '0'
		LEFT OUTER JOIN `ofertatransportista` OT 
		ON MO.idofertatransportista = OT.idofertatransportista AND MO.idofertatransportista = '$idUserType'
	    GROUP BY 
	        T.idofertacarga, T.idgeneradorcarga_fk, T.fecha_carga, T.precio, T.tipo_carga, T.cantidad_carga, 
		T.nciudad_origen, T.nciudad_destino, 
		T.nregion_origen, T.nregion_destino,		
		T.fecha_publicacion, T.tipo_camion, T.distancia, T.fecha_descarga,
		T.detalle, 
		T.esLicitacion, T.cantidad_viajes,T.descripcion_estado,
		T.origen_direccion, T.destino_direccion
		"; //
	$res = $this->db->query($query);
	if ($res->num_rows() > 0) {
			foreach ($res->result_array() as $row) {
					$data[] = $row;
			}
			return $data;
	}
	return false;

}

function ofertacarga_insert_by_id($data){ //insertar by id transportista!
	

	$value = $this->db->insert('ofertacarga',$data);
	return $value;
}

function ofertatransportista_insert_by_id($data){ //insertar by id transportista!
	

	$value = $this->db->insert('ofertatransportista',$data);
	return $value;
}

function fetch_tabla_ofertacarga($idUserType,$limit, $start) {
	//$this->db->limit($limit, $start);

	$query = $this->db->query("
	       SELECT 
               T.*,
               ifnull(count(MO.idofertatransportista),0) AS solicitudes
                FROM 
	        (SELECT OC.idofertacarga,OC.IDGENERADORCARGA_FK, 
		OC.fecha_publicacion, OC.tipo_camion, OC.distancia, OC.fecha_carga, OC.fecha_descarga,
		OC.cantidad_carga, OC.tipo_carga, OC.precio, OC.detalle,
		OC.ORIGEN_CIUDAD as idorigen_ciudad, OC.DESTINO_CIUDAD as iddestino_ciudad, 
		OC.ORIGEN_REGION as idorigen_region, OC.DESTINO_REGION as iddestino_region,
		C1.NOMBRE AS origen_ciudad, C2.NOMBRE AS destino_ciudad,
		R1.NOMBRE AS origen_region, R2.NOMBRE AS destino_region,
		OC.estado_oferta        
		FROM  `ofertacarga` OC
		JOIN  `ciudad` C1 ON C1.IDCIUDAD = OC.ORIGEN_CIUDAD
		JOIN  `ciudad` C2 ON C2.IDCIUDAD = OC.DESTINO_CIUDAD
		JOIN  `region` R1 ON R1.IDREGION = OC.ORIGEN_REGION
		JOIN  `region` R2 ON R2.IDREGION = OC.DESTINO_REGION		
		WHERE OC.IDGENERADORCARGA_FK =$idUserType
		AND OC.estado_oferta IN ('0','1','2')
		) T
		LEFT OUTER JOIN `match_ofertas` MO 
		ON T.idofertacarga = MO.idofertacarga and MO.estado_solicitud_GC = '1'
	    GROUP BY 
	        T.idofertacarga ,T.IDGENERADORCARGA_FK, 
		T.fecha_publicacion, T.tipo_camion, T.distancia, T.fecha_carga, T.fecha_descarga,
		T.cantidad_carga, T.tipo_carga, T.precio, T.detalle,
		T.idorigen_ciudad, T.iddestino_ciudad, T.idorigen_region, T.iddestino_region,
		T.origen_ciudad, T.destino_ciudad,
		T.origen_region, T.destino_region    
		"); 
	if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
					$data[] = $row;
			}
			return $data;
	}
	return false;
 }


function fetch_tabla_ofertatransportista($idUserType,$limit, $start) {
	//$this->db->limit($limit, $start);

	$querystr = "
	SELECT 
          T.*,
          ifnull(count(MO.idofertatransportista),0) AS solicitudes
        FROM 
	(SELECT 
       OT.idofertatransportista,OT.IDTRANSPORTISTA_FK, 
		OT.fecha_publicacion, OT.patente, OT.tipo_camion,
		OT.ubicacion as ubicacion_origen, OT.destino_preferente,		
		OT.fecha_disponibilidad, OT.detalle, 
		
		C1.NOMBRE AS ubicacion, C2.NOMBRE AS destino,
        CH.NOMBRE AS chofer_nombre, CH.APELLIDO AS chofer_apellido, CH.RUT, 
        OT.estado_oferta
        FROM  `ofertatransportista` OT
		
		JOIN  `ciudad` C1 ON OT.UBICACION = C1.IDCIUDAD
		JOIN  `ciudad` C2 ON OT.DESTINO_PREFERENTE = C2.IDCIUDAD
		JOIN  `chofer` CH ON OT.IDTRANSPORTISTA_FK = CH.IDTRANSPORTISTA_FK
		JOIN  `camion` CA ON OT.PATENTE = CA.PATENTE
		
		WHERE 
		OT.IDTRANSPORTISTA_FK = $idUserType		
		AND CH.IDCHOFER = CA.IDCHOFER_FK 
		AND OT.estado_oferta IN ('0','1','2')
		) T
		LEFT OUTER JOIN `match_ofertas` MO 
		ON T.idofertatransportista = MO.idofertatransportista and MO.estado_solicitud = '1'
	    GROUP BY 
	        T.idofertatransportista,T.IDTRANSPORTISTA_FK, 
		T.fecha_publicacion, T.patente, T.tipo_camion,
		T.ubicacion, T.destino,
		T.ubicacion_origen, T.destino_preferente,	
         T.chofer_nombre, T.chofer_apellido, T.RUT,
         T.fecha_disponibilidad, T.detalle
		"; 
		$query = $this->db->query($querystr);
	if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
					$data[] = $row;
			}
			return $data;
	}
	return false;
 }



public function get_ofertacarga_by_id($id, $idUserType, $modalidad ='' , $limit, $start){
	

	//	$this->db->limit($limit, $start);
	$where = "";
	if($modalidad == "both"){
		$where = " AND ( OC.estado_oferta IN ('-1','-2') ) ";
	}else if($modalidad =="recibidas" || $modalidad == "enviadas"){
		$where = " AND ( OC.estado_oferta IN ('0','1','2') ) ";
	}else if($modalidad == "none"){
		$where = " AND ( OC.estado_oferta IN ('0','1') ) ";
	}
	$query = $this->db->query("SELECT OC.idofertacarga,OC.IDGENERADORCARGA_FK, 
		OC.fecha_publicacion, OC.tipo_camion, OC.distancia, OC.fecha_carga, OC.fecha_descarga,
		OC.cantidad_carga, OC.tipo_carga, OC.precio, OC.detalle, 
		OC.esLicitacion, OC.cantidad_viajes,OC.descripcion_estado,
		OC.origen_direccion, OC.destino_direccion,
		OC.origen_ciudad, OC.destino_ciudad,
		OC.origen_region, OC.destino_region,
		R1.nombre AS nregion_origen, R2.nombre AS nregion_destino,
		C1.nombre AS nciudad_origen, C2.nombre AS nciudad_destino
		FROM  `ofertacarga` OC	
		JOIN ciudad C1 ON C1.idciudad = OC.origen_ciudad
		JOIN ciudad C2 ON  C2.idciudad = OC.destino_ciudad		
		JOIN region R1 ON R1.idregion = OC.origen_region
		JOIN region R2 ON  R2.idregion = OC.destino_region
		WHERE (OC.IDGENERADORCARGA_FK ='$idUserType' OR '$idUserType' = '')
		AND (OC.idofertacarga = '$id'  )
		$where "); 
	if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
					$data[] = $row;
			}
			return $data;
	}
	return false;
}

 public function get_ofertatransportista_by_id($id,$idUserType,$modalidad = "",$limit, $start) {
	//$this->db->limit($limit, $start);
	$where = "";
	if($modalidad == "both"){
		$where = " AND ( OT.estado_oferta IN ('-1','-2') ) ";
	}else if($modalidad =="recibidas" || $modalidad == "enviadas"){
		$where = " AND ( OT.estado_oferta IN ('0','1','2') ) ";
	}else if($modalidad == "none"){
		$where = " AND ( OT.estado_oferta IN ('0','1') ) ";
	}
	$query = $this->db->query("SELECT OT.idofertatransportista,OT.IDTRANSPORTISTA_FK, 
		OT.fecha_publicacion, OT.patente, OT.tipo_camion,
		OT.fecha_disponibilidad, OT.detalle, 
		OT.ubicacion, OT.destino_preferente AS destino,
		OT.direccion_ubicacion, OT.direccion_destino,
        CH.NOMBRE AS chofer, CH.RUT as RUT,
        R1.nombre AS nregion_origen, R2.nombre AS nregion_destino,
        C1.nombre AS nciudad_origen, C2.nombre AS nciudad_destino,
        OT.estado_oferta, OT.descripcion_estado
		FROM  `ofertatransportista` OT		
		JOIN  `chofer` CH ON CH.IDTRANSPORTISTA_FK = OT.IDTRANSPORTISTA_FK
		JOIN  `camion` CA ON CA.PATENTE = OT.PATENTE
		JOIN ciudad C1 ON C1.idciudad = OT.ubicacion
		JOIN ciudad C2 ON  C2.idciudad = OT.destino_preferente	
		JOIN region R1 ON R1.idregion = OT.region_ubicacion
		JOIN region R2 ON  R2.idregion = OT.region_destino
		WHERE ( OT.IDTRANSPORTISTA_FK = '$idUserType' OR '$idUserType' = '' )
		AND OT.idofertatransportista = '$id' 
		AND CH.IDCHOFER = CA.IDCHOFER_FK  $where "); 
	if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
					$data[] = $row;
			}
			return $data;
	}
	return false;
 }

function get_match_ofertacarga_by_id($id,$status= '' , $limit,$start, $modalidad= "both") {
	$this->db->limit($limit, $start);
	$where="";
	if( $modalidad == "both"){ //para historial
		$where = "((MO.estado_oferta_GC IN ('-1','-2') AND MO.estado_solicitud_GC ='-2') 
		         OR (MO.estado_solicitud_GC IN ('-1','2') AND MO.estado_oferta_GC ='-2')) AND OC.estado_oferta IN ('-1','-2')"; 
	}else if($modalidad == "enviadas"){
		$where = "MO.estado_oferta_GC IN ('-1','1','2')  AND OC.estado_oferta IN ('0','1','2')"; 
	
	}else if($modalidad == "recibidas"){
		$where = "MO.estado_solicitud_GC IN ('-1','2') AND MO.estado_oferta_GC ='-2' AND OC.estado_oferta IN ('1','2')"; 
	
	}
	$query = $this->db->query("SELECT OC.idofertacarga,OC.IDGENERADORCARGA_FK, 
		OC.fecha_publicacion, OC.tipo_camion, OC.distancia, OC.fecha_carga, OC.fecha_descarga,
		OC.cantidad_carga, OC.tipo_carga, OC.precio, OC.detalle, 
		OC.esLicitacion, OC.cantidad_viajes,OC.descripcion_estado,
		OC.origen_direccion, OC.destino_direccion,
		OC.origen_ciudad, OC.destino_ciudad,
		OC.origen_region, OC.destino_region,
		C1.NOMBRE AS ubicacion, C2.NOMBRE AS destino,
		OC.estado_oferta as estado, OC.descripcion_estado,
			MO.orden_carga,
          	MO.estado_solicitud_GC as estado_solicitud, MO.estado_oferta_GC as estado_oferta, 
          	MO.descripcion_estado_solicitud_GC as descripcion_estado_solicitud, 
          	MO.descripcion_estado_oferta_GC as descripcion_estado_oferta
		FROM  `ofertacarga` OC
		JOIN  `ciudad` C1 ON C1.IDCIUDAD = OC.origen_ciudad
		JOIN  `ciudad` C2 ON C2.IDCIUDAD = OC.destino_ciudad
		INNER JOIN  `match_ofertas` MO ON OC.idofertacarga = MO.idofertacarga
		WHERE OC.IDGENERADORCARGA_FK =$id		
		AND ( $where )"); 
	if ($query->num_rows() > 0) {			
		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}
		return $data;
	}
	return false;
 }

function get_match_ofertatransportista_by_id($id,$status= '' , $limit,$start, $modalidad= "both") {
	$this->db->limit($limit, $start);
	$where="";
	if( $modalidad == "both"){ //para historial
		$where = "((MO.estado_oferta IN ('-1','-2') AND MO.estado_solicitud ='-2') 
		         OR (MO.estado_solicitud IN ('-1','2') AND MO.estado_oferta ='-2')) AND OT.estado_oferta IN ('-1','-2')"; 
	}else if($modalidad == "enviadas"){
		$where = "MO.estado_oferta IN ('-1','1','2')  AND OT.estado_oferta IN ('0','1','2')"; 
	
	}else if($modalidad == "recibidas"){
		$where = "MO.estado_solicitud IN ('-1','2') AND MO.estado_oferta ='-2' AND OT.estado_oferta IN ('1','2')"; 
	
	}
	$query = $this->db->query("SELECT OT.idofertatransportista,OT.IDTRANSPORTISTA_FK, 
		OT.fecha_publicacion, OT.patente, OT.tipo_camion, 
		OT.patente, OT.fecha_disponibilidad, OT.detalle, 
		C1.NOMBRE AS ubicacion, C2.NOMBRE AS destino,
        CH.NOMBRE AS chofer_nombre, CH.APELLIDO As chofer_apellido,
        CH.RUT, OT.estado_oferta as estado, OT.descripcion_estado,
        	MO.orden_carga,
          	MO.estado_solicitud, MO.estado_oferta, MO.descripcion_estado_solicitud, MO.descripcion_estado_oferta
		FROM  `ofertatransportista` OT
		JOIN  `ciudad` C1 ON C1.IDCIUDAD = OT.UBICACION
		JOIN  `ciudad` C2 ON C2.IDCIUDAD = OT.DESTINO_PREFERENTE
		JOIN  `chofer` CH ON CH.IDTRANSPORTISTA_FK = OT.IDTRANSPORTISTA_FK
		JOIN  `camion` CA ON CA.PATENTE = OT.PATENTE
		INNER JOIN  `match_ofertas` MO ON OT.idofertatransportista = MO.idofertatransportista
		WHERE OT.IDTRANSPORTISTA_FK =$id
		AND CH.IDCHOFER = CA.IDCHOFER_FK
		AND ( $where )"); 
	if ($query->num_rows() > 0) {			
		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}
		return $data;
	}
	return false;
 }



function match_ofertas_get_all_by_id($id=0, $idofertatransportista=0, $idofertacarga=0,$status = 0, $modalidad = "oferta",$limit,$start){  //valores = 0 no incluye condicion
      	
      	//modalidad => "oferta" o "solicitud"
      	$data = array();
    $idAcc = $this->session->userdata('userid');            
    $usrtype = $this->session->userdata('login_type');
    $idUserType = $this->Crud_model->account_get_id_by_type($idAcc,$usrtype); 
	if($modalidad == "solicitud") $idUserType = ''; // solicitud no necesita de IDUSER
	
	if(intval($idofertatransportista) > 0 && intval($idofertacarga) > 0){
		$data = array('idofertacarga' => $idofertacarga,
			'idofertatransportista' => $idofertatransportista,
			'estado_'.$modalidad => $status);
		
	}
	else{

		$querystr = "SELECT MO.* ";

		$qry_data_OC = ", OC.IDGENERADORCARGA_FK, 
		OC.fecha_publicacion, OC.tipo_camion, OC.distancia, OC.fecha_carga, OC.fecha_descarga,
		OC.cantidad_carga, OC.tipo_carga, OC.precio, OC.detalle, 
		OC.esLicitacion, OC.cantidad_viajes,OC.descripcion_estado,
		OC.origen_direccion, OC.destino_direccion,
		OC.origen_ciudad, OC.destino_ciudad,
		OC.origen_region, OC.destino_region,
		R1.nombre AS nregion_origen, R2.nombre AS nregion_destino,
		C1.nombre AS nciudad_origen, C2.nombre AS nciudad_destino ";


		$qry_data_OT = ", OT.IDTRANSPORTISTA_FK, 
		OT.fecha_publicacion, OT.patente, OT.tipo_camion,
		OT.fecha_disponibilidad, OT.detalle, 
		OT.ubicacion, OT.destino_preferente AS destino,
		OT.direccion_ubicacion, OT.direccion_destino,
        CH.NOMBRE AS chofer, CH.RUT as RUT,
        R1.nombre AS nregion_origen, R2.nombre AS nregion_destino,
        C1.nombre AS nciudad_origen, C2.nombre AS nciudad_destino, 
        OT.estado_oferta, OT.descripcion_estado ";


		$queryfrom = " FROM match_ofertas MO ";
		
		$join_oferta_T = " LEFT JOIN ofertatransportista OT 		
					 ON MO.idofertatransportista = OT.idofertatransportista 						
					JOIN  `chofer` CH ON CH.IDTRANSPORTISTA_FK = OT.IDTRANSPORTISTA_FK					
					JOIN  `camion` CA ON CA.PATENTE = OT.PATENTE
										AND CA.idchofer_fk = CH.idchofer
					JOIN ciudad C1 ON C1.idciudad = OT.ubicacion
					JOIN ciudad C2 ON  C2.idciudad = OT.destino_preferente	
					JOIN region R1 ON R1.idregion = OT.region_ubicacion
					JOIN region R2 ON  R2.idregion = OT.region_destino 	";

		
		$join_oferta_GC =  " LEFT JOIN ofertacarga OC 
					 ON MO.idofertacarga = OC.idofertacarga 					
					 JOIN ciudad C1 ON C1.idciudad = OC.origen_ciudad
					JOIN ciudad C2 ON  C2.idciudad = OC.destino_ciudad		
					JOIN region R1 ON R1.idregion = OC.origen_region
					JOIN region R2 ON  R2.idregion = OC.destino_region "; 
		
		$where_GC= " WHERE (MO.idofertacarga = '$idofertacarga' )  ";
		$where_filtro_GC = " AND (OC.idgeneradorcarga_fk = '$idUserType' OR '$idUserType' = '') ";
		$where_T = " WHERE (MO.idofertatransportista = '$idofertatransportista' ) ";
		$where_filtro_T = "	 AND (OT.idtransportista_fk = '$idUserType'	 OR '$idUserType' = '')	";

	    $and_where_T = " AND MO.estado_".$modalidad." = '$status' ";	
		$and_where_GC = " AND MO.estado_".$modalidad."_GC = '$status' ";	


		if(intval($idofertacarga) > 0) {
			//$data = array('idofertacarga' => $idofertacarga,'estado_'.$modalidad => $status);
			if($modalidad == "solicitud"){		
				$querystr .= $qry_data_OT.$queryfrom.$join_oferta_T.$where_GC.$where_filtro_T.$and_where_GC; // GENERADOR CARGA
			}else if($modalidad == "oferta"){
				$querystr .= $qry_data_OT.$queryfrom.$join_oferta_T.$where_GC.$where_filtro_T.$and_where_T; // TRANSPORTISTA
			}
		}


		else if(intval($idofertatransportista) > 0) { 
			//$data = array('idofertatransportista' => $idofertatransportista,'estado_'.$modalidad => $status);
			
			if($modalidad == "solicitud"){		
				$querystr .= $qry_data_OC.$queryfrom.$join_oferta_GC.$where_T.$where_filtro_GC.$and_where_T; // TRANSPORTISTA
			}else if($modalidad == "oferta"){
				$querystr .= $qry_data_OC.$queryfrom.$join_oferta_GC.$where_T.$where_filtro_GC.$and_where_GC; // GENERADOR CARGA
			}
			
		}
		
	}
	
	print_r($querystr);
	//$data = array('idofertacarga' => $idofertacarga,'idofertatransportista' => $idofertatransportista);
	$query = $this->db->query($querystr);
	//$this->db->limit($limit,$start);
	//$query = $this->db->get_where('match_ofertas',$data); 

	if ($query->num_rows() > 0) {
		foreach ($query->result_array() as $row) {
				$datas[] = $row;
		}
		return $datas;
}
	return false;

}
//Crear match de ofertas, si no existe se crea.
function match_ofertas($usertype,$idUserType){
	
	$num_match =0;
	$msg = "";
	/*$querystr = "SELECT OC.*, OT.* FROM ofertatransportista OT
			JOIN ofertacarga OC ON OC.origen_ciudad = OT.ubicacion
			AND OC.destino_ciudad = OT.destino_preferente
			AND OC.fecha_carga = OT.fecha_disponibilidad
			AND OC.tipo_camion = OT.tipo_camion
			WHERE 
			(OC.estado_oferta = '0'
			AND OT.estado_oferta = '0')
			AND
			   ( DATEDIFF( NOW() , DATE_ADD( OT.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) <= 0 )
            AND
			   ( DATEDIFF( NOW() , DATE_ADD( OC.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) <= 0 )			   
			 ";
			 */
	$querystr = "SELECT OC.*, OT.* FROM ofertatransportista OT
			JOIN ofertacarga OC ON 
			(
                OC.origen_ciudad = OT.ubicacion
                OR OC.origen_region = OT.region_ubicacion)
			AND 
				(OC.destino_ciudad = OT.destino_preferente
                 OR OC.destino_region = OT.region_destino
                 )
			AND OC.fecha_carga = OT.fecha_disponibilidad
			AND OC.tipo_camion = OT.tipo_camion
			WHERE 
			(OC.estado_oferta = '0'
			AND OT.estado_oferta = '0')
			AND
			   ( DATEDIFF( NOW() , DATE_ADD( OT.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) <= 0 )
            AND
			   ( DATEDIFF( NOW() , DATE_ADD( OC.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) <= 0 )";

	$where = "";
	if($usertype == "Transportista"){
		$where =  " AND OT.idtransportista_fk = $idUserType";
	}else if($usertype == "GeneradorCarga"){
		$where =  " AND OC.idgeneradorcarga_fk = $idUserType";
	}
			
	$querystr .= " " . $where;
	
	$query = $this->db->query($querystr);
	if ($query->num_rows() > 0) {
			foreach ($query->result_array() as  $row) {
					//$data[] = $row;
					//print_r($row);
				    $data = array("idofertacarga" => $row["idofertacarga"],
							"idofertatransportista" => $row["idofertatransportista"]);
					$query_info = $this->db->get_where('match_ofertas',$data);
					if($query_info->num_rows() == 0){
						$this->db->insert("match_ofertas",$data);
					}else{
						$num_match = $num_match - 1;
					}
			}
			
	}
	$num_match = $query->num_rows();

	//anular los registros fuera de tiempo...
	//FULL OUTER JOIN
	$queryf = "SELECT DISTINCT T.* FROM 
			    ((SELECT OC.idofertacarga, OT.idofertatransportista 
						FROM ofertatransportista OT
						LEFT JOIN ofertacarga OC 
						ON (OT.ubicacion = OC.origen_ciudad
						AND OT.destino_preferente = OC.destino_ciudad
						AND OT.fecha_disponibilidad = OC.fecha_carga
						AND OT.tipo_camion = OC.tipo_camion)
						WHERE 
						(OC.estado_oferta IN ('0','1')
			             AND
			             DATEDIFF( NOW() , DATE_ADD( OC.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) >0)
						OR 
						(OT.estado_oferta IN ('0','1')
			             AND
			             DATEDIFF( NOW() , DATE_ADD( OT.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) >0)
						)
				UNION ALL
				(SELECT OC.idofertacarga, OT.idofertatransportista 
						FROM ofertatransportista OT
						RIGHT JOIN ofertacarga OC 
						ON (OT.ubicacion = OC.origen_ciudad
						AND OT.destino_preferente = OC.destino_ciudad
						AND OT.fecha_disponibilidad = OC.fecha_carga
						AND OT.tipo_camion = OC.tipo_camion)
						WHERE 
						(OC.estado_oferta IN ('0','1')
			             AND
			             DATEDIFF( NOW() , DATE_ADD( OC.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) >0)
						OR 
						(OT.estado_oferta IN ('0','1')
			             AND
			             DATEDIFF( NOW() , DATE_ADD( OT.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) >0)
						)
					) T";
	
    $status_final = "-2";
    $desc = "Anulado, Fuera de tiempo";
	$dataupd = array("estado_oferta" => $status_final, "descripcion_estado" => $desc);
	$dataupdMatch = array("estado_oferta_GC" => $status_final,"estado_oferta" => $status_final,
					 "estado_solicitud_GC" => $status_final,"estado_solicitud" => $status_final,
				 	"descripcion_estado_oferta" => $desc,
				 	"descripcion_estado_oferta_GC" => $desc,
				 	"descripcion_estado_solicitud" => $desc,
				 	"descripcion_estado_solicitud_GC" => $desc);

	$tquery = $this->db->query($queryf);
	$msg .= "result: ".$tquery->num_rows(). "   ";
	if ($tquery->num_rows() > 0) {
		foreach ($tquery->result_array() as  $row) {
			$idoc = $row["idofertacarga"];
			$idot = $row["idofertatransportista"];
			$msg .= $idoc . " --  ". $idot. ": ";
			//if($idoc != NULL && intval($idoc) > 0){
			if(intval($idoc) > 0){	
				
				$this->db->where('idofertacarga', $idoc);
				$value = $this->db->update('ofertacarga', $dataupd);	
				///////////////////////////////////////////
				///////////////////////////////////////////
				$this->db->where('idofertacarga', $idoc);
				$value = $this->db->update('match_ofertas', $dataupdMatch);	
			}
			
			if($idot != NULL && intval($idot) > 0){
				
				$this->db->where('idofertatransportista', $idot);
				$value = $this->db->update('ofertatransportista', $dataupd);	
				///////////////////////////////////////////
				///////////////////////////////////////////
				$this->db->where('idofertatransportista', $idot);
				$value = $this->db->update('match_ofertas', $dataupdMatch);	
			}				
		}
			
	}
	
	$dato = array("total" => $num_match, "msg" => $msg);
	return $dato;


}
function ofertacarga_update_by_id($id = 0, $data){ //editar by id transportista!
	if ($id != 0) {		
		$this->db->where('idofertacarga', $id);
		$value = $this->db->update('ofertacarga', $data);	
		return true;		
	}else{
		return false;
	}
	
}

function ofertatransportista_update_by_id($id = 0, $data){ //editar by id transportista!
	if ($id != 0) {		
		$this->db->where('idofertatransportista', $id);
		$value = $this->db->update('ofertatransportista', $data);	
		return true;		
	}else{
		return false;
	}
	
}

function ofertacarga_delete_by_id($id = 0){
	if ($id != 0) {		
		$table = "ofertacarga";
		$this->db->delete($table,array('idofertacarga' => $id));
		return true;		
	}else{
		return false;
	}
	
}

function ofertatransportista_delete_by_id($id = 0){
	if ($id != 0) {		
		$table = "ofertatransportista";
		$this->db->delete($table,array('idofertatransportista' => $id));
		return true;		
	}else{
		return false;
	}
	
}

function get_num_ofertacarga_by_id($idUserType, $status= 0 ){
	$query = $this->db->query("SELECT OC.idofertacarga,OC.IDGENERADORCARGA_FK, 
		OC.fecha_publicacion, OC.tipo_camion, OC.distancia, OC.fecha_carga, OC.fecha_descarga,
		OC.cantidad_carga, OC.tipo_carga,  OC.precio, OC.detalle,
		C1.NOMBRE AS origen_ciudad, C2.NOMBRE AS destino_ciudad,
		R1.NOMBRE AS origen_region, R2.NOMBRE AS destino_region        
		FROM  `ofertacarga` OC
		JOIN  `ciudad` C1 ON C1.IDCIUDAD = OC.ORIGEN_CIUDAD
		JOIN  `ciudad` C2 ON C2.IDCIUDAD = OC.DESTINO_CIUDAD
		JOIN  `region` R1 ON R1.IDREGION = OC.ORIGEN_REGION
		JOIN  `region` R2 ON R2.IDREGION = OC.DESTINO_REGION		
		WHERE OC.IDGENERADORCARGA_FK =$idUserType
		AND (OC.estado_oferta IN ('0','1','2'))"); 
		
	return $query->num_rows();
	

}
function get_num_ofertatransportista_by_id($id,$status= '' ) {
	
	$query = $this->db->query("SELECT OT.idofertatransportista,OT.IDTRANSPORTISTA_FK, 
		OT.fecha_publicacion, OT.patente, OT.tipo_camion, 
		C1.NOMBRE AS ubicacion, C2.NOMBRE AS destino,
        CH.NOMBRE AS chofer
		FROM  `ofertatransportista` OT
		JOIN  `ciudad` C1 ON C1.IDCIUDAD = OT.UBICACION
		JOIN  `ciudad` C2 ON C2.IDCIUDAD = OT.DESTINO_PREFERENTE
		JOIN  `chofer` CH ON CH.IDTRANSPORTISTA_FK = OT.IDTRANSPORTISTA_FK
		JOIN  `camion` CA ON CA.PATENTE = OT.PATENTE
		WHERE OT.IDTRANSPORTISTA_FK =$id
		AND CH.IDCHOFER = CA.IDCHOFER_FK
		AND (OT.estado_oferta IN ('0','1','2') )"); 
			
	return $query->num_rows();
	
 }
 
 function get_num_match_ofertacarga_by_id($idUserType,$status= '' , $modalidad= "both") {
	
	$where="";
	if( $modalidad == "both"){
		$where = "((MO.estado_oferta_GC IN ('-1','-2') AND MO.estado_solicitud_GC ='-2') 
		         OR (MO.estado_solicitud_GC IN ('-1','2') AND MO.estado_oferta_GC ='-2')) AND OC.estado_oferta IN ('-1','-2')";
	}else if($modalidad == "enviadas"){
		$where = "MO.estado_oferta_GC IN ('-1','1','2') AND OC.estado_oferta IN ('0','1','2')";
	
	}else if($modalidad == "recibidas"){
		$where = "MO.estado_solicitud_GC IN ('-1','2') AND MO.estado_oferta_GC ='-2' AND OC.estado_oferta IN ('1','2')";
	
	}
	$query = $this->db->query("SELECT OC.idofertacarga,OC.IDGENERADORCARGA_FK, 
		OC.fecha_publicacion, 
		C1.NOMBRE AS ubicacion, C2.NOMBRE AS destino
		FROM  `ofertacarga` OC
		JOIN  `ciudad` C1 ON C1.IDCIUDAD = OC.ORIGEN_CIUDAD
		JOIN  `ciudad` C2 ON C2.IDCIUDAD = OC.DESTINO_CIUDAD
		INNER JOIN  `match_ofertas` MO ON OC.idofertacarga = MO.idofertacarga
		WHERE OC.IDGENERADORCARGA_FK =$idUserType		
		AND ( $where )"); 
			
	return $query->num_rows();
	
 }

 function get_num_match_ofertatransportista_by_id($idUserType,$status= '' , $modalidad= "both") {
	
	$where="";
	if( $modalidad == "both"){
		$where = "((MO.estado_oferta IN ('-1','-2') AND MO.estado_solicitud ='-2') 
		         OR (MO.estado_solicitud IN ('-1','2') AND MO.estado_oferta ='-2')) AND OT.estado_oferta IN ('-1','-2')";
	}else if($modalidad == "enviadas"){
		$where = "MO.estado_oferta IN ('-1','1','2') AND OT.estado_oferta IN ('0','1','2')";
	
	}else if($modalidad == "recibidas"){
		$where = "MO.estado_solicitud IN ('-1','2') AND MO.estado_oferta ='-2' AND OT.estado_oferta IN ('1','2')";
	
	}
	$query = $this->db->query("SELECT OT.idofertatransportista,OT.IDTRANSPORTISTA_FK, 
		OT.fecha_publicacion, OT.patente, OT.tipo_camion, 
		C1.NOMBRE AS ubicacion, C2.NOMBRE AS destino,
        CH.NOMBRE AS chofer
		FROM  `ofertatransportista` OT
		JOIN  `ciudad` C1 ON C1.IDCIUDAD = OT.UBICACION
		JOIN  `ciudad` C2 ON C2.IDCIUDAD = OT.DESTINO_PREFERENTE
		JOIN  `chofer` CH ON CH.IDTRANSPORTISTA_FK = OT.IDTRANSPORTISTA_FK
		JOIN  `camion` CA ON CA.PATENTE = OT.PATENTE
		INNER JOIN  `match_ofertas` MO ON OT.idofertatransportista = MO.idofertatransportista
		WHERE OT.IDTRANSPORTISTA_FK =$idUserType
		AND CH.IDCHOFER = CA.IDCHOFER_FK
		AND ( $where )"); 
		
	return $query->num_rows();
	
 }
///////////////////////////// CRUD FOR oa TABLE //////////////////////////////////////////////////


	
	function oa_set_countdown_by_id($id){ 
		//date_default_timezone_set('America/Argentina/Buenos_Aires');
		date_default_timezone_set('UTC');
		$info = $this->db->get_where('oa',array('idOA' => $id))->row();
		$time = $info->countdown;
		$timeused = $info->time_used;
		$secperquestion = intval($this->session->userdata("secperquestion"));
		$totalquestions = intval($this->db->get_where("oa",array("idOA" => $id))->row()->total);
		$total_time = $secperquestion; //in seconds
		
		//$zerotime = date("H:i:s","00:00:00");
		//echo "<p style='color:white'> TIME".strtotime(date("H:i:s","00:00:00"))." <p>";
		
		if( strtotime(date("H:i:s",strtotime( $time ) )) == strtotime(date("H:i:s",0)) && strtotime(date("H:i:s",strtotime( $timeused ) )) == strtotime(date("H:i:s",0))){			

			$formdata = date( "H:i:s",$total_time);
			$udata = array("countdown" => $formdata);
			$this->db->where('idOA', $id);
			$value = $this->db->update('oa', $udata);
			
		}
		//retrieve current timestamp
		$newdata = $this->db->get_where('oa',array('idOA' => $id))->row();
		$ntime = $newdata->countdown;
		$ntimesec = strtotime(date("H:i:s",strtotime($ntime) ) ) - strtotime(date("H:i:s",0) );
		$output = array('currenttimeFormat' => $ntime, 'currenttimeSeconds' => $ntimesec);
		return $output;
		
	}

	function oa_decrease_countdown_by_id($id){
		//date_default_timezone_set('America/Argentina/Buenos_Aires');
		date_default_timezone_set('UTC');
		$data = $this->db->get_where('oa',array('idOA' => $id))->row();
		$time = $data->countdown;
		$timeused = $data->time_used;
		//echo "<p style='color:white'> TIME ===> ".strtotime(date("H:i:s",strtotime($time) ))." </p>";
		//echo "<p style='color:white'> TIME zero ===> ".strtotime(date("H:i:s",0))." </p>";
		if( strtotime(date("H:i:s",strtotime( $time ) )) > strtotime(date("H:i:s",0))  ){
			
			$formdata1 = date( "H:i:s",strtotime($time . "-".strval(1). "second" ));
			$formdata2 = date( "H:i:s",strtotime($timeused . "+".strval(1). "second" ));
			$udata = array("countdown" => $formdata1, 'time_used' => $formdata2);
			$this->db->where('idOA', $id);
			$value = $this->db->update('oa', $udata);			
		}
		
		$newdata = $this->db->get_where('oa',array('idOA' => $id))->row();
		$ntime = $newdata->countdown;
		$ntimesec = strtotime(date("H:i:s",strtotime($ntime) ) ) - strtotime(date("H:i:s",0) );
		$output = array('currenttimeFormat' => $ntime, 'currenttimeSeconds' => $ntimesec);
		return $output;
	}

	function oa_update_by_id($id,$newpassword= '',$newpattern = '', $newsalt= ''){
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		if ($newpassword != ''){
			$data = array( 'Mpassword' => $newpassword );
			$this->db->where('id', $id);
			$this->db->update('oa', $data);	
		} 
		if ($newpattern != ''){
			$data = array( 'Mpattern' => $newpattern );
			$this->db->where('id', $id);
			$this->db->update('oa', $data);	
		} 
		if ($newsalt != ''){
			$data = array( 'salt' => $newsalt );
			$this->db->where('id', $id);
			$this->db->update('oa', $data);	
		} 
		return true;
	}

	function oa_get_countdown_by_id($id){ 
		//date_default_timezone_set('America/Argentina/Buenos_Aires');
		date_default_timezone_set('UTC');		
		//retrieve current timestamp
		$newdata = $this->db->get_where('oa',array('idOA' => $id))->row();
		$ntime = $newdata->countdown;
		$ntimesec = strtotime(date("H:i:s",strtotime($ntime) ) ) - strtotime(date("H:i:s",0) );
		$output = array('currenttimeFormat' => $ntime, 'currenttimeSeconds' => $ntimesec);
		return $output;
		
	}

	

}