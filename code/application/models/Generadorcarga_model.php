<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generadorcarga_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Generic_model');
		$table = json_decode(_TABLE,true);
	}
	

	function ofertatransportista_search($idUserType,$region_origen = "-1",$region_destino = "-1",$tipo_camion="-1")
	{

		$table = json_decode(_TABLE, true);
		$match_ofertas = $table["match_ofertas"]["name"];				$MO = $table["match_ofertas"]["alias"];
		$transportista = $table["transportista"]["name"];				$T = $table["transportista"]["alias"];
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$generadorcarga = $table["generadorcarga"]["name"];				$GC = $table["generadorcarga"]["alias"];
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];
		$account = $table["account"]["name"];							$ACC = $table["account"]["alias"];
		$ciudad = $table["ciudad"]["name"];							
																		$C1 = $table["ciudad1"]["alias"];
																		$C2 = $table["ciudad2"]["alias"];
		$region = $table["region"]["name"];								
																		$R1 = $table["region1"]["alias"];
																		$R2 = $table["region2"]["alias"];

		$querystr = "SELECT 
	          T.*,
	          ifnull(count(MO.idofertacarga),0) AS solicitudes
	        FROM 
		(SELECT 
			$OT.idofertatransportista,			$OT.IDTRANSPORTISTA_FK, 
			$OT.fecha_publicacion, 				$OT.patente, 
			$OT.tipo_camion,					$OT.fecha_disponibilidad, 
			$OT.detalle,						$OT.ubicacion, 
			$OT.destino_preferente AS destino,	$OT.direccion_ubicacion, 			
	        $C1.nombre AS nciudad_origen, 		$C2.nombre AS nciudad_destino,
	        $R1.nombre AS nregion_origen, 		$R2.nombre AS nregion_destino,
	        $OT.direccion_destino,		        $OT.estado_oferta, 
	        $OT.descripcion_estado
					FROM $ofertatransportista $OT 
					JOIN $ciudad $C1 ON 	C1.idciudad = $OT.ubicacion
					JOIN $ciudad $C2 ON  	C2.idciudad = $OT.destino_preferente	
					JOIN $region $R1 ON 	R1.idregion = $OT.region_ubicacion
					JOIN $region $R2 ON  	R2.idregion = $OT.region_destino			
				WHERE 
					(	$OT.region_ubicacion = $region_origen 	OR $region_origen = -1) 
					AND ($OT.region_destino = $region_destino 	OR $region_destino = -1) 				
					AND ($OT.tipo_camion = '$tipo_camion' 		OR '$tipo_camion' = '-1')
					AND ($OT.estado_oferta = '0'
					)
				) T
			LEFT OUTER JOIN $match_ofertas $MO 
			ON T.idofertatransportista = $MO.idofertatransportista AND $MO.estado_oferta_GC = '0'		
			LEFT OUTER JOIN $ofertacarga $OC
			ON $MO.idofertacarga = $OC.idofertacarga AND $MO.idofertacarga = '$idUserType'
		    GROUP BY 
		    T.idofertatransportista,T.IDTRANSPORTISTA_FK, 
			T.fecha_publicacion, T.patente, 
			T.tipo_camion,	T.fecha_disponibilidad, 
			T.detalle, 		T.ubicacion, 
			T.destino,		T.direccion_ubicacion, 
			T.direccion_destino,  T.estado_oferta, 
			T.descripcion_estado,
			T.nciudad_origen, T.nciudad_destino
			
				";
		return $this->Generic_model->doQuery($querystr);
	}


	function ofertacarga_get_num()
	{
		$table = json_decode(_TABLE, true);
		$match_ofertas = $table["match_ofertas"]["name"];				$MO = $table["match_ofertas"]["alias"];
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];

		$query = "SELECT $OC.idofertacarga
				FROM $ofertacarga $OC, $match_ofertas $MO
				WHERE NOT $OC.idofertacarga = $MO.idofertacarga";
		$res = $this->db->query($query);
		return $res->num_rows();
	}


	function ofertatransportista_get_num()
	{
		$query = "SELECT OC.idofertatransportista
				FROM ofertatransportista OC, match_ofertas MO
				WHERE NOT OC.idofertatransportista = MO.idofertatransportista";
		$res = $this->db->query($query);
		return $res->num_rows();
	}


	function ofertacarga_search($idUserType, $region_origen = "-1",$region_destino = "-1",$tipo_carga="-1",$tipo_camion="-1", $eslicitacion="-1")
	{

		$table = json_decode(_TABLE, true);
		$match_ofertas = $table["match_ofertas"]["name"];				$MO = $table["match_ofertas"]["alias"];
		$transportista = $table["transportista"]["name"];				$T = $table["transportista"]["alias"];
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$generadorcarga = $table["generadorcarga"]["name"];				$GC = $table["generadorcarga"]["alias"];
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];
		$account = $table["account"]["name"];							$ACC = $table["account"]["alias"];
		$ciudad = $table["ciudad"]["name"];							
																		$C1 = $table["ciudad1"]["alias"];
																		$C2 = $table["ciudad2"]["alias"];
		$region = $table["region"]["name"];								
																		$R1 = $table["region1"]["alias"];
																		$R2 = $table["region2"]["alias"];


		$querystr = "
			SELECT 
	          T.*,
	          ifnull(count($MO.idofertatransportista),0) AS solicitudes
        	FROM 
			(SELECT 
			$OC.idofertacarga, 			$OC.idgeneradorcarga_fk, 		$OC.fecha_carga, 			
			$OC.precio, 				$OC.tipo_carga, 				$OC.cantidad_carga, 
			$OC.fecha_publicacion, 		$OC.tipo_camion, 				$OC.distancia, 
			$OC.fecha_descarga,			$OC.detalle, 					$OC.esLicitacion, 
			$OC.cantidad_viajes,		$OC.descripcion_estado,			$OC.origen_direccion, 
			$OC.destino_direccion,
			$C1.nombre AS nciudad_origen, $C2.nombre AS nciudad_destino, 
			$R1.nombre AS nregion_origen, $R2.nombre AS nregion_destino
			FROM ofertacarga $OC 
					JOIN ciudad $C1 ON 	$C1.idciudad = $OC.origen_ciudad
					JOIN ciudad $C2 ON  $C2.idciudad = $OC.destino_ciudad
					JOIN region $R1 ON 	$R1.idregion = $OC.origen_region
					JOIN region $R2 ON  $R2.idregion = $OC.destino_region
				WHERE 
						($OC.origen_region 	= $region_origen 	OR $region_origen = -1) 
					AND ($OC.destino_region = $region_destino 	OR $region_destino = -1) 
					AND ($OC.tipo_carga 	= '$tipo_carga' 	OR '$tipo_carga' = '-1')
					AND ($OC.tipo_camion 	= '$tipo_camion' 	OR '$tipo_camion' = '-1')
					AND ($OC.esLicitacion 	= '$eslicitacion' 	OR '$eslicitacion' = '-1') 
					AND ($OC.estado_oferta 	= '0')
			) T
			LEFT OUTER JOIN $match_ofertas $MO 
			ON T.idofertacarga = $MO.idofertacarga 
				AND $MO.estado_oferta = '0'
			LEFT OUTER JOIN $ofertatransportista $OT 
			ON $MO.idofertatransportista = $OT.idofertatransportista 
				AND $MO.idofertatransportista = '$idUserType'
		    GROUP BY 
		    T.idofertacarga, T.idgeneradorcarga_fk, T.fecha_carga, 
		    T.precio, T.tipo_carga, T.cantidad_carga, 
			T.fecha_publicacion, T.tipo_camion, T.distancia, 
			T.fecha_descarga,	T.detalle, T.esLicitacion,
			T.cantidad_viajes,T.descripcion_estado, T.origen_direccion,
			T.destino_direccion,
			T.nciudad_origen, T.nciudad_destino, 
			T.nregion_origen, T.nregion_destino	
			"; //
		return $this->Generic_model->doQuery($querystr);
	}

	function ofertacarga_insert_by_id($data)
	{ 
		$table = json_decode(_TABLE,true);
		$value = $this->db->insert($table["ofertacarga"]["name"],$data);
		return $value;
	}

	function ofertatransportista_insert_by_id($data)
	{
		$table = json_decode(_TABLE,true);
		$value = $this->db->insert($table["ofertatransportista"]["name"],$data);
		return $value;
	}

	function fetch_tabla_ofertacarga($idUserType,$limit, $start) 
	{
		//$this->db->limit($limit, $start);
		$table = json_decode(_TABLE, true);
		$match_ofertas = $table["match_ofertas"]["name"];				$MO = $table["match_ofertas"]["alias"];
		$transportista = $table["transportista"]["name"];				$T = $table["transportista"]["alias"];
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$generadorcarga = $table["generadorcarga"]["name"];				$GC = $table["generadorcarga"]["alias"];
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];
		$account = $table["account"]["name"];							$ACC = $table["account"]["alias"];
		$ciudad = $table["ciudad"]["name"];							
																		$C1 = $table["ciudad1"]["alias"];
																		$C2 = $table["ciudad2"]["alias"];
		$region = $table["region"]["name"];								
																		$R1 = $table["region1"]["alias"];
																		$R2 = $table["region2"]["alias"];
		$query = $this->db->query("
		       SELECT 
	               T.*,
	               ifnull(count($MO.idofertatransportista),0) AS solicitudes
	                FROM 
		        (SELECT 
		        $OC.idofertacarga,		$OC.IDGENERADORCARGA_FK,		$OC.fecha_publicacion, 
		        $OC.tipo_camion, 		$OC.distancia, 					$OC.fecha_carga, 
		        $OC.fecha_descarga,		$OC.cantidad_carga, 			$OC.tipo_carga, 
		        $OC.precio, 			$OC.detalle,
				$OC.ORIGEN_CIUDAD as idorigen_ciudad, $OC.DESTINO_CIUDAD as iddestino_ciudad, 
				$OC.ORIGEN_REGION as idorigen_region, $OC.DESTINO_REGION as iddestino_region,
				$C1.NOMBRE AS origen_ciudad, $C2.NOMBRE AS destino_ciudad,
				$R1.NOMBRE AS origen_region, $R2.NOMBRE AS destino_region,
				$OC.estado_oferta        
				FROM  $ofertacarga $OC
				JOIN  $ciudad $C1 ON $C1.IDCIUDAD = $OC.ORIGEN_CIUDAD
				JOIN  $ciudad $C2 ON $C2.IDCIUDAD = $OC.DESTINO_CIUDAD
				JOIN  $region $R1 ON $R1.IDREGION = $OC.ORIGEN_REGION
				JOIN  $region $R2 ON $R2.IDREGION = $OC.DESTINO_REGION		
				WHERE 	$OC.IDGENERADORCARGA_FK =	$idUserType
						AND $OC.estado_oferta IN ('0','1','2')
				) T
				LEFT OUTER JOIN `match_ofertas` $MO 
				ON T.idofertacarga = $MO.idofertacarga and $MO.estado_solicitud_GC = '1'
			    GROUP BY 
			    T.idofertacarga ,	T.IDGENERADORCARGA_FK, 	T.fecha_publicacion, 
			    T.tipo_camion, 		T.distancia, 			T.fecha_carga, 
			    T.fecha_descarga,	T.cantidad_carga, 		T.tipo_carga, 
			    T.precio, 			T.detalle,				T.idorigen_ciudad, 
			    T.iddestino_ciudad, T.idorigen_region, 		T.iddestino_region,
				T.origen_ciudad, 	T.destino_ciudad,
				T.origen_region, 	T.destino_region    
			"); 
		return $this->Generic_model->doQueryObject($query);
	}


	function fetch_tabla_ofertatransportista($idUserType,$limit, $start) 
	{
		//$this->db->limit($limit, $start);
		$table = json_decode(_TABLE, true);
		$match_ofertas = $table["match_ofertas"]["name"];				$MO = $table["match_ofertas"]["alias"];
		$transportista = $table["transportista"]["name"];				$T = $table["transportista"]["alias"];
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$generadorcarga = $table["generadorcarga"]["name"];				$GC = $table["generadorcarga"]["alias"];
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];
		$account = $table["account"]["name"];							$ACC = $table["account"]["alias"];
		$chofer = $table["chofer"]["name"];							$CH = $table["chofer"]["alias"];
		$camion = $table["camion"]["name"];							$CA = $table["camion"]["alias"];
		$ciudad = $table["ciudad"]["name"];							
																		$C1 = $table["ciudad1"]["alias"];
																		$C2 = $table["ciudad2"]["alias"];
		$region = $table["region"]["name"];								
																		$R1 = $table["region1"]["alias"];
																		$R2 = $table["region2"]["alias"];
		$querystr = "
		SELECT 
          T.*,
          ifnull(count($MO.idofertatransportista),0) AS solicitudes
        FROM 
		(SELECT 
	       	$OT.idofertatransportista,			$OT.IDTRANSPORTISTA_FK, 
			$OT.fecha_publicacion, 				$OT.patente, 
			$OT.tipo_camion,					$OT.ubicacion as ubicacion_origen, 
			$OT.destino_preferente,				$OT.fecha_disponibilidad, 
			$OT.detalle, 
			
			$C1.NOMBRE AS ubicacion, 			$C2.NOMBRE AS destino,
	        $CH.NOMBRE AS chofer_nombre, 		$CH.APELLIDO AS chofer_apellido, 
	        $CH.RUT, 						    $OT.estado_oferta
	        FROM  $ofertatransportista $OT			
			JOIN  $ciudad $C1 ON $OT.UBICACION 			= $C1.IDCIUDAD
			JOIN  $ciudad $C2 ON $OT.DESTINO_PREFERENTE = $C2.IDCIUDAD
			JOIN  $chofer $CH ON $OT.IDTRANSPORTISTA_FK = $CH.IDTRANSPORTISTA_FK
			JOIN  $camion $CA ON $OT.PATENTE 			= $CA.PATENTE			
			WHERE 
					$OT.IDTRANSPORTISTA_FK 	= $idUserType		
				AND $CH.IDCHOFER 			= $CA.IDCHOFER_FK 
				AND $OT.estado_oferta IN ('0','1','2')
			) T
			LEFT OUTER JOIN $match_ofertas $MO 
			ON T.idofertatransportista = $MO.idofertatransportista 
				AND $MO.estado_solicitud = '1'
		    GROUP BY 
		    T.idofertatransportista,		T.IDTRANSPORTISTA_FK, 
			T.fecha_publicacion, 			T.patente, 			T.tipo_camion,
			T.ubicacion, 					T.destino,
			T.ubicacion_origen, 			T.destino_preferente,	
	        T.chofer_nombre, 				T.chofer_apellido, 	T.RUT,
	        T.fecha_disponibilidad, 		T.detalle
			"; 
		return $this->Generic_model->doQuery($querystr);
	}


	public function get_ofertacarga_by_id($id, $idUserType, $modalidad ='' , $limit, $start)
	{

		//	$this->db->limit($limit, $start);
		$table = json_decode(_TABLE, true);
		$match_ofertas = $table["match_ofertas"]["name"];				$MO = $table["match_ofertas"]["alias"];
		$transportista = $table["transportista"]["name"];				$T = $table["transportista"]["alias"];
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$generadorcarga = $table["generadorcarga"]["name"];				$GC = $table["generadorcarga"]["alias"];
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];
		$account = $table["account"]["name"];							$ACC = $table["account"]["alias"];
		$chofer = $table["chofer"]["name"];							$CH = $table["chofer"]["alias"];
		$camion = $table["camion"]["name"];							$CA = $table["camion"]["alias"];
		$ciudad = $table["ciudad"]["name"];							
																		$C1 = $table["ciudad1"]["alias"];
																		$C2 = $table["ciudad2"]["alias"];
		$region = $table["region"]["name"];								
																		$R1 = $table["region1"]["alias"];
																		$R2 = $table["region2"]["alias"];
		$where = "";
		if($modalidad == "both"){
			$where = " AND ( $OC.estado_oferta IN ('-1','-2') ) ";
		}else if($modalidad == RECIBIDAS || $modalidad == ENVIADAS){
			$where = " AND ( $OC.estado_oferta IN ('0','1','2') ) ";
		}else if($modalidad == "none"){
			$where = " AND ( $OC.estado_oferta IN ('0','1') ) ";
		}
		$query = $this->db->query("
			SELECT $OC.idofertacarga,		$OC.IDGENERADORCARGA_FK, 		$OC.fecha_publicacion, 
			$OC.tipo_camion, 				$OC.distancia, 					$OC.fecha_carga, 
			$OC.fecha_descarga,				$OC.cantidad_carga, 			$OC.tipo_carga, 
			$OC.precio, $OC.detalle, 		$OC.esLicitacion, 				$OC.cantidad_viajes,
			$OC.descripcion_estado,			$OC.origen_direccion, 			$OC.destino_direccion,
			$OC.origen_ciudad, 				$OC.destino_ciudad,
			$OC.origen_region, 				$OC.destino_region,
			$R1.nombre AS nregion_origen, $R2.nombre AS nregion_destino,
			$C1.nombre AS nciudad_origen, $C2.nombre AS nciudad_destino
			FROM  $ofertacarga $OC	
			JOIN $ciudad $C1 ON 	$C1.idciudad = $OC.origen_ciudad
			JOIN $ciudad $C2 ON  	$C2.idciudad = $OC.destino_ciudad		
			JOIN $region $R1 ON 	$R1.idregion = $OC.origen_region
			JOIN $region $R2 ON  	$R2.idregion = $OC.destino_region
			WHERE 
				($OC.IDGENERADORCARGA_FK =	'$idUserType' OR '$idUserType' = '')
				AND ($OC.idofertacarga = '$id'  )
			$where "); 
		return $this->Generic_model->doQueryObject($query);
	}


	public function get_ofertatransportista_by_id($id,$idUserType,$modalidad = "",$limit, $start) 
	{
		//$this->db->limit($limit, $start);
		$table = json_decode(_TABLE, true);
		$match_ofertas = $table["match_ofertas"]["name"];				$MO = $table["match_ofertas"]["alias"];
		$transportista = $table["transportista"]["name"];				$T = $table["transportista"]["alias"];
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$generadorcarga = $table["generadorcarga"]["name"];				$GC = $table["generadorcarga"]["alias"];
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];
		$account = $table["account"]["name"];							$ACC = $table["account"]["alias"];
		$chofer = $table["chofer"]["name"];							$CH = $table["chofer"]["alias"];
		$camion = $table["camion"]["name"];							$CA = $table["camion"]["alias"];
		$ciudad = $table["ciudad"]["name"];							
																		$C1 = $table["ciudad1"]["alias"];
																		$C2 = $table["ciudad2"]["alias"];
		$region = $table["region"]["name"];								
																		$R1 = $table["region1"]["alias"];
																		$R2 = $table["region2"]["alias"];
		$where = "";
		if($modalidad == "both"){
			$where = " AND ( $OT.estado_oferta IN ('-1','-2') ) ";
		}else if($modalidad == RECIBIDAS || $modalidad == ENVIADAS){
			$where = " AND ( $OT.estado_oferta IN ('0','1','2') ) ";
		}else if($modalidad == "none"){
			$where = " AND ( $OT.estado_oferta IN ('0','1') ) ";
		}
		$query = $this->db->query("
			SELECT 
			$OT.idofertatransportista,		$OT.IDTRANSPORTISTA_FK, 
			$OT.fecha_publicacion, 			$OT.patente, 
			$OT.tipo_camion,				$OT.fecha_disponibilidad, 
			$OT.detalle, 					$OT.ubicacion, 
			$OT.destino_preferente AS destino,
			$OT.direccion_ubicacion, 		$OT.direccion_destino,
	        $CH.NOMBRE AS chofer, 			$CH.RUT as RUT,
	        $R1.nombre AS nregion_origen, 	$R2.nombre AS nregion_destino,
	        $C1.nombre AS nciudad_origen, 	$C2.nombre AS nciudad_destino,
	        $OT.estado_oferta, 				$OT.descripcion_estado
			FROM  $ofertatransportista $OT		
			JOIN  $chofer $CH ON $CH.IDTRANSPORTISTA_FK = $OT.IDTRANSPORTISTA_FK
			JOIN  $camion $CA ON $CA.PATENTE 			= $OT.PATENTE
			JOIN  $ciudad $C1 ON $C1.idciudad = $OT.ubicacion
			JOIN  $ciudad $C2 ON $C2.idciudad = $OT.destino_preferente	
			JOIN  $region $R1 ON $R1.idregion = $OT.region_ubicacion
			JOIN  $region $R2 ON $R2.idregion = $OT.region_destino
			WHERE 
				( $OT.IDTRANSPORTISTA_FK = '$idUserType' OR '$idUserType' = '' )
				AND $OT.idofertatransportista = '$id' 
				AND $CH.IDCHOFER = $CA.IDCHOFER_FK  $where "); 
		return $this->Generic_model->doQueryObject($query);
	}

	//editar by id transportista!
	function ofertacarga_update_by_id($id = 0, $data)
	{ 
		$table = json_decode(_TABLE,true);
		if ($id != 0) {		
			$this->db->where('idofertacarga', $id);
			$value = $this->db->update($table["ofertacarga"]["name"], $data);	
			return true;		
		}else{
			return false;
		}
	}
	//editar by id transportista!
	function ofertatransportista_update_by_id($id = 0, $data)
	{ 
		$table = json_decode(_TABLE,true);
		if ($id != 0) {		
			$this->db->where('idofertatransportista', $id);
			$value = $this->db->update($table["ofertatransportista"]["name"], $data);	
			return true;		
		}else{
			return false;
		}
	}


	function ofertacarga_delete_by_id($id = 0)
	{
		$table = json_decode(_TABLE,true);
		if ($id != 0) {		
			
			$this->db->delete($table["ofertacarga"]["name"],
							  array('idofertacarga' => $id));
			return true;		
		}else{
			return false;
		}
	}


	function ofertatransportista_delete_by_id($id = 0)
	{
		$table = json_decode(_TABLE,true);
		if ($id != 0) {				
			$this->db->delete($table["ofertatransportista"]["name"],
							  array('idofertatransportista' => $id));
			return true;		
		}else{
			return false;
		}
	}


	function get_num_ofertacarga_by_id($idUserType, $status= 0 )
	{
		$table = json_decode(_TABLE, true);
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];
		$chofer = $table["chofer"]["name"];								$CH = $table["chofer"]["alias"];
		$camion = $table["camion"]["name"];								$CA = $table["camion"]["alias"];
		$ciudad = $table["ciudad"]["name"];							
																		$C1 = $table["ciudad1"]["alias"];
																		$C2 = $table["ciudad2"]["alias"];
		$region = $table["region"]["name"];								
																		$R1 = $table["region1"]["alias"];
																		$R2 = $table["region2"]["alias"];
		$query = $this->db->query("
			SELECT 
			$OC.idofertacarga,			$OC.IDGENERADORCARGA_FK, 
			$OC.fecha_publicacion, 		$OC.tipo_camion, 
			$OC.distancia, 				$OC.fecha_carga, 
			$OC.fecha_descarga,			$OC.cantidad_carga, 
			$OC.tipo_carga,  			$OC.precio, 
			$OC.detalle,
			$C1.NOMBRE AS origen_ciudad, $C2.NOMBRE AS destino_ciudad,
			$R1.NOMBRE AS origen_region, $R2.NOMBRE AS destino_region        
			FROM  $ofertacarga $OC
			JOIN  $ciudad $C1 	ON $C1.IDCIUDAD = $OC.ORIGEN_CIUDAD
			JOIN  $ciudad $C2 	ON $C2.IDCIUDAD = $OC.DESTINO_CIUDAD
			JOIN  $region $R1 	ON $R1.IDREGION = $OC.ORIGEN_REGION
			JOIN  $region $R2 	ON $R2.IDREGION = $OC.DESTINO_REGION		
			WHERE 	$OC.IDGENERADORCARGA_FK =$idUserType
					AND ($OC.estado_oferta IN ('0','1','2'))"); 
			
		return $query->num_rows();
	}


	function get_num_ofertatransportista_by_id($id,$status= '' ) 
	{
		$table = json_decode(_TABLE, true);
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$chofer = $table["chofer"]["name"];								$CH = $table["chofer"]["alias"];
		$camion = $table["camion"]["name"];								$CA = $table["camion"]["alias"];
		$ciudad = $table["ciudad"]["name"];							
																		$C1 = $table["ciudad1"]["alias"];
																		$C2 = $table["ciudad2"]["alias"];
		$query = $this->db->query("
			SELECT 
			$OT.idofertatransportista,	$OT.IDTRANSPORTISTA_FK, 
			$OT.fecha_publicacion, 		$OT.patente, 
			$OT.tipo_camion, 
			$C1.NOMBRE AS ubicacion, 	$C2.NOMBRE AS destino,
	        $CH.NOMBRE AS chofer
			FROM  $ofertatransportista $OT
			JOIN  $ciudad $C1 	ON 	$C1.IDCIUDAD 			= $OT.UBICACION
			JOIN  $ciudad $C2 	ON 	$C2.IDCIUDAD 			= $OT.DESTINO_PREFERENTE
			JOIN  $chofer $CH 	ON 	$CH.IDTRANSPORTISTA_FK 	= $OT.IDTRANSPORTISTA_FK
			JOIN  $camion $CA 	ON 	$CA.PATENTE 			= $OT.PATENTE
			WHERE $OT.IDTRANSPORTISTA_FK =	$id
			AND CH.IDCHOFER = CA.IDCHOFER_FK
			AND ($OT.estado_oferta IN ('0','1','2') )"); 
				
		return $query->num_rows();
	}
	 

	function reactivate_oferta($id)
	{

	 	$status = 0;
	 	$desc_offer = "Reiniciado";
	 	//oferta transportista
	 	$this->Crud_model->table_update_by_id("ofertatransportista",$id,"estado_oferta",$status);
	 	$this->Crud_model->table_update_by_id("ofertatransportista",$id,"descripcion_estado",$desc_offer);

	 	$querystr = "UPDATE match_ofertas
	 				SET estado_oferta = '$status' ,
	 					estado_solicitud_GC = '$status' , 
	 					estado_oferta_GC = '$status' , 
	 					descripcion_estado_oferta = '$desc_offer' ,
	 					descripcion_estado_solicitud = '$desc_offer'
	 				WHERE idofertatransportista = '$id'";

	 	$query = $this->db->query($querystr);
	 	/////////////////////////////////////////////////////////////////////////////////////////////////        
	}


}