<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generic_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}


	public function fillPageDataCounters($usertype,$idUserType,$page_data,$page_name,$page_title)
	{
		$table = json_decode(_TABLE,true);

		$page_data["modal_title_add"] = "Agregar ".$page_name;
	    $page_data["modal_title_upd"] = "Modificar ".$page_name;
        $page_data["modal_title_text_add"] = "";
        $page_data["modal_title_text_upd"] = "";
        $page_data["nombre_empresa"] = $this->get_fieldcompany_by_id($table["empresa"]["name"],$idUserType,"company_name")->company_name;
        $page_data["nombre_rep_legal"] = $this->get_fieldcompany_by_id($table["empresa"]["name"],$idUserType,"name_legal_rep")->name_legal_rep;
				$page_data["num_catalogos"] = $this->Generic_model->get_num_filas("catalog");


        if($usertype == EMPRESA){
        	$page_data["page_name"]  = $page_name;
	        $page_data["page_title"] = $page_title;
	        $idAcc = $this->session->userdata('userid');
					$page_data["num_descargas"] = $this->Generic_model->get_num_filas_log($idAcc);



        }else if($usertype == ADMIN ){
        	$page_data["page_name"]  = $page_name;
	        $page_data["page_title"] = $page_title;
					$page_data["num_descargas"] = $this->Generic_model->get_num_filas("log_catalog");
	        $page_data["num_cuentas"] = $this->Generic_model->get_num_cuentas(-1);
	        $page_data["num_cuentas_deshabilitadas"] = $this->Generic_model->get_num_cuentas(0);
	        $idAcc = $this->session->userdata('userid');

        }
        return $page_data;
    }


    public function createPagination($url,$perpage,$urisegment,$total_rows,$dataName,$Alldata)
    {

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


	public function formateaFecha($input,$showYear = "si")
	{
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


	public function generateRandomString($length = 10,$option = -1)
	{
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


	public function generateRandomToken($length = 10)
	{
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

///////////////////////////// GENERIC CRUD FOR TABLE //////////////////////////////////////////////////
	//params $querystring => a raw query string to call db->query() to solve
	public function doQuery($querystring)
	{

		$query = $this->db->query($querystring);
		if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
						$data[] = $row;
				}
				return $data;
		}
		return false;
	}

	//params $querystring => a query made by CI active record

	public function doQueryObject($query)
	{

		if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
						$data[] = $row;
				}
				return $data;
		}
		return false;
	}

	function delete_by_id($table = '',$id=0, $iduser = 0)
	{
		$tables = json_decode(_TABLES);

		if ($id != 0) {

			if( in_array($table, ($tables)  ) ){

				$this->db->delete($table,array('id'.$table => $id));
				return true;
			}
			else{ return false; }

		}else{
			return false;
		}
	}


	public function fetch_tabla($tabla,$limit, $start)
	{
		$this->db->limit($limit, $start);
		$query = $this->db->get($tabla); //add where comprado = 1 !
		return $this->doQueryObject($query);
	}

	function category_get_all()
	{
		$table = json_decode(_TABLE,true);
		$categoria = $table["categoria"]["name"]; 	$CA = $table["categoria"]["alias"];
		$familia = $table["familia"]["name"];		$FA = $table["familia"]["alias"];

		$querystr = "SELECT $CA.idcategory,
							$CA.name as category_name,
							$CA.idfamily_fk,
							$FA.idfamily,
							$FA.name as family_name
					FROM $categoria $CA
					LEFT JOIN $familia $FA ON $CA.idfamily_fk = $FA.idfamily";

		$query = $this->db->query($querystr);
		return $this->Generic_model->doQueryObject($query);
	}

	function catalog_get_all( $order_by = "none" )
	{
		$table = json_decode(_TABLE,true);
		$categoria = $table["categoria"]["name"]; 	$CATE = $table["categoria"]["alias"];
		$catalogo = $table["catalogo"]["name"];		$CATA = $table["catalogo"]["alias"];

		$querystr = "SELECT
							$CATA.idcatalog,
							$CATA.title,
							$CATA.size,
							$CATA.size_rar,
							$CATA.description,
							$CATE.idcategory,
							$CATE.name,
							$CATA.has_pdf,
							$CATA.has_rar,
							$CATE.idfamily_fk
					FROM $catalogo $CATA
					LEFT JOIN $categoria $CATE ON $CATA.idcategory_fk = $CATE.idcategory ";
	 if(strtolower($order_by) == "desc" || strtolower($order_by) == "asc"){ $querystr .= " ORDER BY $CATA.idcatalog ".$order_by. " LIMIT 5"; }

		return $this->Generic_model->doQuery($querystr);
	}


		function log_catalog_get_all( $order_by = "none" , $idacc = 0)
		{
			$table = json_decode(_TABLE,true);
			$categoria = $table["categoria"]["name"]; 	$CATE = $table["categoria"]["alias"];
			$catalogo = $table["catalogo"]["name"];		$CATA = $table["catalogo"]["alias"];
			$logcatalogo = $table["log_catalogo"]["name"];		$LCAT = $table["log_catalogo"]["alias"];


			$querystr = "SELECT
								$CATA.idcatalog,
								$CATA.title,
								$CATA.size,
								$CATA.description,
								$CATE.idcategory,
								$CATE.name,
								$CATA.has_pdf,
								$CATA.has_rar,
								$CATE.idfamily_fk,
								$LCAT.date_register,
								$LCAT.idlog_catalog
						FROM $logcatalogo $LCAT
						LEFT OUTER JOIN $catalogo $CATA ON $LCAT.idcatalog = $CATA.idcatalog
						LEFT OUTER JOIN $categoria $CATE ON $CATA.idcategory_fk = $CATE.idcategory
						WHERE ($LCAT.idaccount = '$idacc' OR '$idacc' = '0') ";
		 if(strtolower($order_by) == "desc" || strtolower($order_by) == "asc"){ $querystr .= " ORDER BY $LCAT.idlog_catalog ".$order_by. " LIMIT 5"; }

			return $this->Generic_model->doQuery($querystr);
		}

		function get_num_filas_log($idacc)
	{
		$table = json_decode(_TABLE,true);
		$categoria = $table["categoria"]["name"]; 	$CATE = $table["categoria"]["alias"];
		$catalogo = $table["catalogo"]["name"];		$CATA = $table["catalogo"]["alias"];
		$logcatalogo = $table["log_catalogo"]["name"];		$LCAT = $table["log_catalogo"]["alias"];


		$querystr = "SELECT
							$CATA.idcatalog,
							$CATA.title,
							$CATA.size,
							$CATA.description,
							$CATE.idcategory,
							$CATE.name,
							$CATA.has_pdf,
							$CATA.has_rar,
							$CATE.idfamily_fk,
							$LCAT.date_register,
							$LCAT.idlog_catalog
					FROM $logcatalogo $LCAT
					LEFT OUTER JOIN $catalogo $CATA ON $LCAT.idcatalog = $CATA.idcatalog
					LEFT OUTER JOIN $categoria $CATE ON $CATA.idcategory_fk = $CATE.idcategory
					WHERE ($LCAT.idaccount = '$idacc' OR '$idacc' = '0') ";
	 if(strtolower($order_by) == "desc" || strtolower($order_by) == "asc"){ $querystr .= " ORDER BY $LCAT.idlog_catalog ".$order_by. " LIMIT 5"; }

		$qry = $this->Generic_model->doQuery($querystr);
		return count($qry);
	}

	public function get_num_filas($tabla)
	{
		$total = 0;
		$total = $this->db->count_all($tabla);
		return $total;
	}

	public function get_num_cuentas($flag = -1) // flag = enabled = 1, flag = enabled = 0
	{
		$querystr = "SELECT 1 FROM account WHERE (enabled = '$flag' OR '$flag' = '-1')";
		$query = $this->db->query($querystr);
		return $query->num_rows();
	}

	function get_fieldcompany_by_id($tbl, $id = '',$fieldname = '')
	{
		$table = json_decode(_TABLE,true);
		if($fieldname != ''){

			$result = $this->db->select($fieldname)
					->get_where($tbl,array("idaccount_fk" => $id))
					->row();

			return $result;

		}else{
			return false;
		}
	}

	function get_field_by_id($tbl, $id = '',$fieldname = '')
	{
		$table = json_decode(_TABLE,true);
		if($fieldname != ''){

			$result = $this->db->select($fieldname)
					->get_where($tbl,array("id".$tbl => $id))
					->row();

			return $result;

		}else{
			return false;
		}
	}
	function get_id_by_field($tbl, $fieldname, $fieldval = '')
	{
		$table = json_decode(_TABLE,true);
		if($fieldname != ''){

			$result = $this->db->select("id".$tbl)
					->get_where($tbl,array($fieldname => $fieldval))->first_row();


			return $result;

		}else{
			return false;
		}
	}

	function table_update($tablename, $id, $data)
	{

		$tables = json_decode(_TABLES);

		if( in_array($tablename, $tables) ){

			$this->db->where('id'.strval($tablename), $id);
			$result = $this->db->update($tablename,$data);
			return $result;
		}
		else{ return false; }
	}

	function table_update_by_id_field($tbl,$id,$fieldname,$value)
	{

		$data = array($fieldname => $value);
		$result = $this->table_update($tbl,$id,$data);
		return $result;
	}


	function table_insert($tablename, $data)
	{
		$value = $this->db->insert($tablename,$data);
		return $value;
	}
	///////////////////////////// GENERIC CRUD FOR TABLE //////////////////////////////////////////////////
	////////////------------------------------END-----------------------------------------------///////////


	function get_tipo_equipo()
	{
		//$this->db->limit($limit, $start);
		$table = json_decode(_TABLE,true);
		$tipocamion = $table["tipocamion"]["name"];
		$query = $this->db->query("SELECT DISTINCT tipo FROM $tipocamion");
		return $this->doQueryObject($query);
	}


	function get_tipo_carga()
	{
		//$this->db->limit($limit, $start);
		$table = json_decode(_TABLE,true);
		$carga = $table["carga"]["name"];
		$query = $this->db->query("SELECT DISTINCT tipo FROM $carga");
		return $this->doQueryObject($query);
	}

}
