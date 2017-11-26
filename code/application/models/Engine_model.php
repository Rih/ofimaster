<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Engine_model extends CI_Model {
	public $table;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Generic_model');
		$table = json_decode(_TABLE,true);
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

	public function get_distancia_ciudades($idciudad1, $idciudad2) 
	{
		$table = json_decode(_TABLE,true);	
		if(is_int($idciudad1) && is_int($idciudad2) ){
			$query = $this->db->get_where($table["distancia_ciudades"]["name"],
										  array("idciudad1" => $idciudad1, "idciudad2" => $idciudad2));
			if ($query->num_rows() > 0) {
					$dist = $query->first_row()->distancia;						
					return intval($dist);
			}
			
		}
		return -1;	
		
	}

		
	function match_ofertas_update_estado_oferta( $idofertatransportista, $idofertacarga,$value)
	{
		
		//VER
		$table = json_decode(_TABLE,true);
		$match_ofertas  = $table["match_ofertas"]["name"];
		$this->db->query("UPDATE $match_ofertas
		SET estado_oferta = '$value'
		WHERE idofertatransportista = '$idofertatransportista' 
		      AND idofertacarga = '$idofertacarga'");
		return $value;
	}


	function get_lastPublicaciones($idUserType, $usertype, $idAcc, $status = '0')
	{
		$querystr = ""; $and_where = "";
		$inner_join = "";
		$table = json_decode(_TABLE,true);
		$transportista = $table["transportista"]["name"];				$T = $T["transportista"]["alias"]; 
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$generadorcarga = $table["generadorcarga"]["name"];				$GC = $table["generadorcarga"]["alias"];
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$match_ofertas = $table["match_ofertas"]["name"];				$MO = $table["match_ofertas"]["alias"];				
		$chofer = $table["chofer"]["name"];								$CH = $table["chofer"]["alias"]; 
		$camion = $table["camion"]["name"];								$CA = $table["camion"]["alias"]; 
		
		$ciudad = $table["ciudad"]["name"];								
																		$C1 = $table["ciudad1"]["alias"]; 
																		$C2 = $table["ciudad2"]["alias"]; 
		$region = $table["region"]["name"];								
																		$R1 = $table["region1"]["alias"]; 
																		$R2 = $table["region2"]["alias"]; 
		
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
		if($usertype == TRANSPORTISTA ){
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

			$querystr = "
			SELECT 
					$OT.idofertatransportista, 		$OT.patente,				$OT.ubicacion, 
					$OT.destino_preferente,			$OT.fecha_disponibilidad,
					$OT.fecha_publicacion,			$OT.detalle,
					$C1.nombre as nciudad_origen, 	$C2.nombre as nciudad_destino,
					$R1.nombre as nregion_origen, 	$R2.nombre as nregion_destino,		
					$OC.precio, 					$OC.cantidad_carga, 		$CH.nombre as nombre_chofer, 
					$CH.apellido as apellido_chofer,$CH.RUT,					$MO.estado_oferta, 
					$MO.estado_solicitud, 			$MO.estado_oferta_GC, 		$MO.estado_solicitud_GC,
					$MO.descripcion_estado_oferta,	$MO.descripcion_estado_solicitud
			FROM $ofertatransportista $OT 		
			INNER JOIN $match_ofertas $MO 
					ON $OT.idofertatransportista = $MO.idofertatransportista
					AND ($MO.estado_oferta IN (2) OR $MO.estado_solicitud IN (2) )
			LEFT JOIN $ofertacarga $OC 
					ON $MO.idofertacarga= $OC.idofertacarga
			INNER JOIN $camion $CA 
					ON $CA.patente 		= $OT.patente
			INNER JOIN $chofer $CH 
					ON $CH.idchofer 	= $CA.idchofer_fk		
			JOIN $ciudad $C1 
					ON $C1.idciudad 	= $OT.ubicacion
			JOIN $ciudad $C2 
					ON $C2.idciudad 	= $OT.destino_preferente	
			JOIN $region $R1 
					ON $R1.idregion 	= $OT.region_ubicacion		
			JOIN $region $R2 
					ON $R2.idregion 	= $OT.region_destino
			WHERE $OT.idtransportista_fk = '$idUserType' 
			AND ($OT.estado_oferta = '2')
			order by $OT.fecha_publicacion DESC
			LIMIT 0,5";

			$inner_join = "  ";
			$and_where = " ";

		}else if($usertype == GENERADORCARGA ){
			$inner_join = " INNER JOIN generadorcarga T ON T.idaccount = ACC.id ";
			$and_where = " AND $OC.idgeneradorcarga_fk = '".$idUserType."' ";

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

			$querystr = "SELECT $OC.idofertacarga, $OT.patente,$OT.ubicacion, $OT.destino_preferente,
			$OC.fecha_carga, $OC.fecha_publicacion,$OC.detalle,
			$C1.nombre as nciudad_origen, $C2.nombre as nciudad_destino,
			$R1.nombre as nregion_origen, $R2.nombre as nregion_destino,		
			$OC.precio, $OC.cantidad_carga, $CH.nombre as nombre_chofer, $CH.apellido as apellido_chofer, $CH.RUT,
			$MO.estado_oferta, $MO.estado_solicitud, $MO.estado_oferta_GC, $MO.estado_solicitud_GC,
			$MO.descripcion_estado_oferta_GC,$MO.descripcion_estado_solicitud_GC
			FROM $ofertacarga $OC		
			INNER JOIN $match_ofertas $MO ON $OC.idofertacarga = $MO.idofertacarga
			AND ($MO.estado_oferta_GC IN (2) OR $MO.estado_solicitud_GC IN (2) )
			LEFT JOIN $ofertatransportista $OT ON  $MO.idofertatransportista = $OT.idofertatransportista
			INNER JOIN $camion $CA ON $CA.patente = $OT.patente
			INNER JOIN $chofer $CH ON $CH.idchofer = $CA.idchofer_fk
			JOIN $ciudad $C1 ON $C1.idciudad = $OC.origen_ciudad
			JOIN $ciudad $C2 ON  $C2.idciudad = $OC.destino_ciudad	
			JOIN $region $R1 ON $R1.idregion = $OC.origen_region		
			JOIN $region $R2 ON $R2.idregion = $OC.destino_region		
			WHERE $OC.idgeneradorcarga_fk = '$idUserType' 
			AND ($OC.estado_oferta = '2')
			order by $OC.fecha_publicacion DESC
			LIMIT 0,5";
		}	
		return $this->Generic_model->doQuery($querystr);	
	}


	function fetch_tabla_empresa_by_match($modalidad,$idoferta )
	{
		$querystr = "";
		$table = json_decode(_TABLE,true);
		$transportista = $table["transportista"]["name"];				$T = $T["transportista"]["alias"]; 
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$generadorcarga = $table["generadorcarga"]["name"];				$GC = $table["generadorcarga"]["alias"];
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$match_ofertas = $table["match_ofertas"]["name"];				$MO = $table["match_ofertas"]["alias"];				
		$chofer = $table["chofer"]["name"];								$CH = $table["chofer"]["alias"]; 
		$camion = $table["camion"]["name"];								$CA = $table["camion"]["alias"]; 
		
		$ciudad = $table["ciudad"]["name"];								
																		$C1 = $table["ciudad1"]["alias"]; 
																		$C2 = $table["ciudad2"]["alias"]; 
		$region = $table["region"]["name"];								
																		$R1 = $table["region1"]["alias"]; 
																		$R2 = $table["region2"]["alias"]; 
		

		if($modalidad == GENERADORCARGA){ //ve datos de su contraparte
			$querystr ="SELECT E.* FROM `match_ofertas` $MO
				JOIN `ofertatransportista` $OT 
					ON $MO.idofertatransportista = $OT.idofertatransportista AND $OT.estado_oferta = '2'
				JOIN `transportista` T 
					ON T.idtransportista = $OT.idtransportista_fk 
				JOIN `account` ACC 
					ON ACC.id = T.idaccount
				JOIN `empresa` E 
					ON E.idaccount = ACC.id
				WHERE ($MO.estado_solicitud_GC = '2' OR $MO.estado_oferta_GC = '2') AND $MO.idofertacarga = '$idoferta' ";
		}else if($modalidad == TRANSPORTISTA){ //ve datos de su contraparte
			$querystr ="SELECT E.* FROM `match_ofertas` $MO
				JOIN `ofertacarga` $OC 
					ON $MO.idofertacarga = $OC.idofertacarga AND $OC.estado_oferta = '2'
				JOIN `generadorcarga` $GC 
					ON $GC.idgeneradorcarga = $OC.idgeneradorcarga_fk 
				JOIN `account` ACC 
					ON ACC.id = $GC.idaccount
				JOIN `empresa` E 
					ON E.idaccount = ACC.id
				WHERE ($MO.estado_solicitud = '2' OR $MO.estado_oferta = '2') AND $MO.idofertatransportista = '$idoferta' ";
		}
		
		return $this->Generic_model->doQuery($querystr);
	}


	function get_match_ofertacarga_by_id($id,$status= '' , $limit,$start, $modalidad= "both") 
	{
		$table = json_decode(_TABLE,true);
		$transportista = $table["transportista"]["name"];				$T = $T["transportista"]["alias"]; 
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$generadorcarga = $table["generadorcarga"]["name"];				$GC = $table["generadorcarga"]["alias"];
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$match_ofertas = $table["match_ofertas"]["name"];				$MO = $table["match_ofertas"]["alias"];				
		$chofer = $table["chofer"]["name"];								$CH = $table["chofer"]["alias"]; 
		$camion = $table["camion"]["name"];								$CA = $table["camion"]["alias"]; 
		
		$ciudad = $table["ciudad"]["name"];								
																		$C1 = $table["ciudad1"]["alias"]; 
																		$C2 = $table["ciudad2"]["alias"]; 
		$region = $table["region"]["name"];								
																		$R1 = $table["region1"]["alias"]; 
																		$R2 = $table["region2"]["alias"]; 

		$this->db->limit($limit, $start);
		$where="";
		if( $modalidad == "both"){ //para historial
			$where = "(($MO.estado_oferta_GC IN ('-1','-2') AND $MO.estado_solicitud_GC ='-2') 
			         OR ($MO.estado_solicitud_GC IN ('-1','2') AND $MO.estado_oferta_GC ='-2')) AND $OC.estado_oferta IN ('-1','-2')"; 
		}else if($modalidad == ENVIADAS ){
			$where = "$MO.estado_oferta_GC IN ('-1','1','2')  AND $OC.estado_oferta IN ('0','1','2')"; 
		
		}else if($modalidad == RECIBIDAS){
			$where = "$MO.estado_solicitud_GC IN ('-1','2') AND $MO.estado_oferta_GC ='-2' AND $OC.estado_oferta IN ('1','2')"; 
		
		}
		/*
		$query = $this->db->query("	SELECT $OC.idofertacarga,$OC.IDGENERADORCARGA_FK, 
			$OC.fecha_publicacion, $OC.tipo_camion, $OC.distancia, $OC.fecha_carga, $OC.fecha_descarga,
			$OC.cantidad_carga, $OC.tipo_carga, $OC.precio, $OC.detalle, 
			$OC.esLicitacion, $OC.cantidad_viajes,$OC.descripcion_estado,
			$OC.origen_direccion, $OC.destino_direccion,
			$OC.origen_ciudad, $OC.destino_ciudad,
			$OC.origen_region, $OC.destino_region,
			$C1.NOMBRE AS ubicacion, $C2.NOMBRE AS destino,
			$OC.estado_oferta as estado, $OC.descripcion_estado,
				$MO.orden_carga,
	          	$MO.estado_solicitud_GC as estado_solicitud, $MO.estado_oferta_GC as estado_oferta, 
	          	$MO.descripcion_estado_solicitud_GC as descripcion_estado_solicitud, 
	          	$MO.descripcion_estado_oferta_GC as descripcion_estado_oferta
			FROM  `ofertacarga` OC
			JOIN  `ciudad` $C1 ON $C1.IDCIUDAD = $OC.origen_ciudad
			JOIN  `ciudad` $C2 ON $C2.IDCIUDAD = $OC.destino_ciudad
			INNER JOIN  `match_ofertas` MO ON $OC.idofertacarga = $MO.idofertacarga
			WHERE $OC.IDGENERADORCARGA_FK =$id		
			AND ( $where )	"); 
			*/
		$query = $this->db->query("
			SELECT T.*,
			ifnull(count($MO.idofertacarga),0) AS solicitudes
	        FROM 
			(SELECT $OC.idofertacarga,$OC.IDGENERADORCARGA_FK, 
			$OC.fecha_publicacion, $OC.tipo_camion, $OC.distancia, $OC.fecha_carga, $OC.fecha_descarga,
			$OC.cantidad_carga, $OC.tipo_carga, $OC.precio, $OC.detalle, 
			$OC.esLicitacion, $OC.cantidad_viajes,
			$OC.origen_direccion, $OC.destino_direccion,
			$OC.origen_ciudad, $OC.destino_ciudad,
			$OC.origen_region, $OC.destino_region,
			$C1.NOMBRE AS ubicacion, $C2.NOMBRE AS destino,
			$OC.estado_oferta as estado, $OC.descripcion_estado,
				$MO.orden_carga,
	          	$MO.estado_solicitud_GC as estado_solicitud, $MO.estado_oferta_GC as estado_oferta, 
	          	$MO.descripcion_estado_solicitud_GC as descripcion_estado_solicitud, 
	          	$MO.descripcion_estado_oferta_GC as descripcion_estado_oferta
			FROM  `ofertacarga` $OC
			JOIN  `ciudad` $C1 ON $C1.IDCIUDAD = $OC.origen_ciudad
			JOIN  `ciudad` $C2 ON $C2.IDCIUDAD = $OC.destino_ciudad
			INNER JOIN  `match_ofertas` $MO ON $OC.idofertacarga = $MO.idofertacarga
			WHERE $OC.IDGENERADORCARGA_FK =$id		
			AND ( $where )
			) T
			LEFT OUTER JOIN `match_ofertas` $MO 
			ON T.idofertacarga = $MO.idofertacarga AND $MO.estado_solicitud_GC = '1'				
			GROUP BY 
			T.idofertacarga,T.IDGENERADORCARGA_FK, 
			T.fecha_publicacion, T.tipo_camion, T.distancia, T.fecha_carga, T.fecha_descarga,
			T.cantidad_carga, T.tipo_carga, T.precio, T.detalle, 
			T.esLicitacion, T.cantidad_viajes,
			T.origen_direccion, T.destino_direccion,
			T.origen_ciudad, T.destino_ciudad,
			T.origen_region, T.destino_region,
			T.ubicacion, T.destino,
			T.estado, T.descripcion_estado,
				T.orden_carga,
	          	T.estado_solicitud, T.estado_oferta, 
	          	T.descripcion_estado_solicitud, 
	          	T.descripcion_estado_oferta
			"); 

		return $this->Generic_model->doQueryObject($query);
	}


	function get_match_ofertatransportista_by_id($id,$status= '' , $limit,$start, $modalidad= "both") 
	{
		$table = json_decode(_TABLE,true);
		$transportista = $table["transportista"]["name"];				$T = $T["transportista"]["alias"]; 
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$generadorcarga = $table["generadorcarga"]["name"];				$GC = $table["generadorcarga"]["alias"];
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$match_ofertas = $table["match_ofertas"]["name"];				$MO = $table["match_ofertas"]["alias"];				
		$chofer = $table["chofer"]["name"];								$CH = $table["chofer"]["alias"]; 
		$camion = $table["camion"]["name"];								$CA = $table["camion"]["alias"]; 
		
		$ciudad = $table["ciudad"]["name"];								
																		$C1 = $table["ciudad1"]["alias"]; 
																		$C2 = $table["ciudad2"]["alias"]; 
		$region = $table["region"]["name"];								
																		$R1 = $table["region1"]["alias"]; 
																		$R2 = $table["region2"]["alias"]; 
		$this->db->limit($limit, $start);
		$where="";
		if( $modalidad == "both"){ //para historial
			$where = "(($MO.estado_oferta IN ('-1','-2') AND $MO.estado_solicitud ='-2') 
			         OR ($MO.estado_solicitud IN ('-1','2') AND $MO.estado_oferta ='-2')) AND $OT.estado_oferta IN ('-1','-2')"; 
		}else if($modalidad == ENVIADAS ){
			$where = "$MO.estado_oferta IN ('-1','1','2')  AND $OT.estado_oferta IN ('0','1','2')"; 
		
		}else if($modalidad == RECIBIDAS ){
			$where = "$MO.estado_solicitud IN ('-1','2') AND $MO.estado_oferta ='-2' AND $OT.estado_oferta IN ('1','2')"; 
		
		}
		/*$query = $this->db->query("SELECT $OT.idofertatransportista,$OT.IDTRANSPORTISTA_FK, 
			$OT.fecha_publicacion, $OT.patente, $OT.tipo_camion, 
			$OT.fecha_disponibilidad, $OT.detalle, 
			$C1.NOMBRE AS ubicacion, $C2.NOMBRE AS destino,
	        $CH.NOMBRE AS chofer_nombre, $CH.APELLIDO As chofer_apellido,
	        $CH.RUT, $OT.estado_oferta as estado, $OT.descripcion_estado,
	        	$MO.orden_carga,
	          	$MO.estado_solicitud, $MO.estado_oferta, $MO.descripcion_estado_solicitud, $MO.descripcion_estado_oferta
			FROM  `ofertatransportista` OT
			JOIN  `ciudad` $C1 ON $C1.IDCIUDAD = $OT.UBICACION
			JOIN  `ciudad` $C2 ON $C2.IDCIUDAD = $OT.DESTINO_PREFERENTE
			JOIN  `chofer` $CH ON $CH.IDTRANSPORTISTA_FK = $OT.IDTRANSPORTISTA_FK
			JOIN  `camion` $CA ON $CA.PATENTE = $OT.PATENTE
			INNER JOIN  `match_ofertas` MO ON $OT.idofertatransportista = $MO.idofertatransportista
			WHERE $OT.IDTRANSPORTISTA_FK =$id
			AND $CH.IDCHOFER = $CA.IDCHOFER_FK
			AND ( $where )"); 
		*/
		$query = $this->db->query("
			SELECT T.*,
			ifnull(count($MO.idofertatransportista),0) AS solicitudes
	        FROM 
			(SELECT $OT.idofertatransportista,$OT.IDTRANSPORTISTA_FK, 
			$OT.fecha_publicacion, $OT.patente, $OT.tipo_camion, 
			$OT.fecha_disponibilidad, $OT.detalle, 
			$C1.NOMBRE AS ubicacion, $C2.NOMBRE AS destino,
	        $CH.NOMBRE AS chofer_nombre, $CH.APELLIDO As chofer_apellido,
	        $CH.RUT, $OT.estado_oferta as estado, $OT.descripcion_estado,
	        	$MO.orden_carga,
	          	$MO.estado_solicitud, $MO.estado_oferta, $MO.descripcion_estado_solicitud, $MO.descripcion_estado_oferta
			FROM  `ofertatransportista` $OT
			JOIN  `ciudad` $C1 ON $C1.IDCIUDAD = $OT.UBICACION
			JOIN  `ciudad` $C2 ON $C2.IDCIUDAD = $OT.DESTINO_PREFERENTE
			JOIN  `chofer` $CH ON $CH.IDTRANSPORTISTA_FK = $OT.IDTRANSPORTISTA_FK
			JOIN  `camion` $CA ON $CA.PATENTE = $OT.PATENTE
			INNER JOIN  `match_ofertas` $MO ON $OT.idofertatransportista = $MO.idofertatransportista
			WHERE $OT.IDTRANSPORTISTA_FK =$id
			AND $CH.IDCHOFER = $CA.IDCHOFER_FK
			AND ( $where )
			) T
			LEFT OUTER JOIN `match_ofertas` $MO 
			ON T.idofertatransportista = $MO.idofertatransportista AND $MO.estado_solicitud = '1'				
			GROUP BY 
			T.idofertatransportista,T.IDTRANSPORTISTA_FK, 
			T.fecha_publicacion, T.patente, T.tipo_camion, 
			T.fecha_disponibilidad, T.detalle, 
			T.ubicacion, T.destino,
	        T.chofer_nombre, T.chofer_apellido,
	        T.RUT, T.estado, T.descripcion_estado,
	        T.orden_carga,
	        T.estado_solicitud, T.estado_oferta, T.descripcion_estado_solicitud, T.descripcion_estado_oferta
			"); 

		return $this->Generic_model->doQueryObject($query);
	}

	//valores = 0 no incluye condicion
	function match_ofertas_get_all_by_id($id=0, $idofertatransportista=0, $idofertacarga=0,$status = 0, $modalidad = "oferta",$limit,$start)
	{  
		$table = json_decode(_TABLE,true);
		$transportista = $table["transportista"]["name"];				$T = $T["transportista"]["alias"]; 
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$generadorcarga = $table["generadorcarga"]["name"];				$GC = $table["generadorcarga"]["alias"];
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$match_ofertas = $table["match_ofertas"]["name"];				$MO = $table["match_ofertas"]["alias"];				
		$chofer = $table["chofer"]["name"];								$CH = $table["chofer"]["alias"]; 
		$camion = $table["camion"]["name"];								$CA = $table["camion"]["alias"]; 
		
		$ciudad = $table["ciudad"]["name"];								
																		$C1 = $table["ciudad1"]["alias"]; 
																		$C2 = $table["ciudad2"]["alias"]; 
		$region = $table["region"]["name"];								
																		$R1 = $table["region1"]["alias"]; 
																		$R2 = $table["region2"]["alias"]; 
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

			$querystr = "SELECT $MO.* ";

			$qry_data_OC = ", $OC.IDGENERADORCARGA_FK, 
			$OC.fecha_publicacion, $OC.tipo_camion, $OC.distancia, $OC.fecha_carga, $OC.fecha_descarga,
			$OC.cantidad_carga, $OC.tipo_carga, $OC.precio, $OC.detalle, 
			$OC.esLicitacion, $OC.cantidad_viajes,$OC.descripcion_estado,
			$OC.origen_direccion, $OC.destino_direccion,
			$OC.origen_ciudad, $OC.destino_ciudad,
			$OC.origen_region, $OC.destino_region,
			$R1.nombre AS nregion_origen, $R2.nombre AS nregion_destino,
			$C1.nombre AS nciudad_origen, $C2.nombre AS nciudad_destino ";


			$qry_data_OT = ", $OT.IDTRANSPORTISTA_FK, 
			$OT.fecha_publicacion, $OT.patente, $OT.tipo_camion,
			$OT.fecha_disponibilidad, $OT.detalle, 
			$OT.ubicacion, $OT.destino_preferente AS destino,
			$OT.direccion_ubicacion, $OT.direccion_destino,
	        $CH.NOMBRE AS chofer, $CH.RUT as RUT,
	        $R1.nombre AS nregion_origen, $R2.nombre AS nregion_destino,
	        $C1.nombre AS nciudad_origen, $C2.nombre AS nciudad_destino, 
	        $OT.estado_oferta, $OT.descripcion_estado ";


			$queryfrom = " FROM match_ofertas $MO ";
			
			$join_oferta_T = " LEFT JOIN $ofertatransportista $OT 		
						 ON $MO.idofertatransportista = $OT.idofertatransportista 						
						JOIN  `chofer` $CH ON $CH.IDTRANSPORTISTA_FK = $OT.IDTRANSPORTISTA_FK					
						JOIN  `camion` $CA ON $CA.PATENTE = $OT.PATENTE
											AND $CA.idchofer_fk = $CH.idchofer
						JOIN ciudad $C1 ON $C1.idciudad = $OT.ubicacion
						JOIN ciudad $C2 ON  $C2.idciudad = $OT.destino_preferente	
						JOIN region $R1 ON $R1.idregion = $OT.region_ubicacion
						JOIN region $R2 ON  $R2.idregion = $OT.region_destino 	";

			
			$join_oferta_GC =  " LEFT JOIN $ofertacarga $OC 
						 ON $MO.idofertacarga = $OC.idofertacarga 					
						 JOIN $ciudad $C1 ON $C1.idciudad = $OC.origen_ciudad
						JOIN $ciudad $C2 ON  $C2.idciudad = $OC.destino_ciudad		
						JOIN $region $R1 ON $R1.idregion = $OC.origen_region
						JOIN $region $R2 ON  $R2.idregion = $OC.destino_region "; 
			
			$where_GC= " WHERE ($MO.idofertacarga = '$idofertacarga' )  ";
			$where_filtro_GC = " AND ($OC.idgeneradorcarga_fk = '$idUserType' OR '$idUserType' = '') ";
			$where_T = " WHERE ($MO.idofertatransportista = '$idofertatransportista' ) ";
			$where_filtro_T = "	 AND ($OT.idtransportista_fk = '$idUserType'	 OR '$idUserType' = '')	";

		    $and_where_T = " AND $MO.estado_".$modalidad." = '$status' ";	
			$and_where_GC = " AND $MO.estado_".$modalidad."_GC = '$status' ";	


			if(intval($idofertacarga) > 0) {
				//$data = array('idofertacarga' => $idofertacarga,'estado_'.$modalidad => $status);
				if($modalidad == SOLICITUD ){		
					$querystr .= $qry_data_OT.$queryfrom.$join_oferta_T.$where_GC.$where_filtro_T.$and_where_GC; // GENERADOR CARGA
				}else if($modalidad == OFERTA ){
					$querystr .= $qry_data_OT.$queryfrom.$join_oferta_T.$where_GC.$where_filtro_T.$and_where_T; // TRANSPORTISTA
				}
			}


			else if(intval($idofertatransportista) > 0) { 
				//$data = array('idofertatransportista' => $idofertatransportista,'estado_'.$modalidad => $status);
				
				if($modalidad == SOLICITUD ){		
					$querystr .= $qry_data_OC.$queryfrom.$join_oferta_GC.$where_T.$where_filtro_GC.$and_where_T; // TRANSPORTISTA
				}else if($modalidad == OFERTA ){
					$querystr .= $qry_data_OC.$queryfrom.$join_oferta_GC.$where_T.$where_filtro_GC.$and_where_GC; // GENERADOR CARGA
				}
				
			}
			
		}
		return $this->Generic_model->doQuery($querystr);
	}

	//Crear match de ofertas, si no existe se crea.
	function match_ofertas($usertype,$idUserType)
	{
		$table = json_decode(_TABLE,true);		
		$transportista = $table["transportista"]["name"];				$T = $T["transportista"]["alias"]; 
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$generadorcarga = $table["generadorcarga"]["name"];				$GC = $table["generadorcarga"]["alias"];
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$match_ofertas = $table["match_ofertas"]["name"];				$MO = $table["match_ofertas"]["alias"];				
		$chofer = $table["chofer"]["name"];								$CH = $table["chofer"]["alias"]; 
		$camion = $table["camion"]["name"];								$CA = $table["camion"]["alias"]; 
		
		$ciudad = $table["ciudad"]["name"];								
																		$C1 = $table["ciudad1"]["alias"]; 
																		$C2 = $table["ciudad2"]["alias"]; 
		$region = $table["region"]["name"];								
																		$R1 = $table["region1"]["alias"]; 
																		$R2 = $table["region2"]["alias"]; 	
		$num_match =0;
		$msg = "";
		/*$querystr = "SELECT $OC.*, $OT.* FROM ofertatransportista OT
				JOIN ofertacarga OC ON $OC.origen_ciudad = $OT.ubicacion
				AND $OC.destino_ciudad = $OT.destino_preferente
				AND $OC.fecha_carga = $OT.fecha_disponibilidad
				AND $OC.tipo_camion = $OT.tipo_camion
				WHERE 
				($OC.estado_oferta = '0'
				AND $OT.estado_oferta = '0')
				AND
				   ( DATEDIFF( NOW() , DATE_ADD( $OT.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) <= 0 )
	            AND
				   ( DATEDIFF( NOW() , DATE_ADD( $OC.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) <= 0 )			   
				 ";
				 */
				 
				 // $OT.destino_preferente = 0 => cualquier destino

		$querystr = "SELECT $OC.*, $OT.* FROM ofertatransportista OT
				JOIN $ofertacarga $OC ON 
				(
	                $OC.origen_ciudad = $OT.ubicacion
	                OR $OC.origen_region = $OT.region_ubicacion)
				AND 
					($OC.destino_ciudad = $OT.destino_preferente
	                 OR $OC.destino_region = $OT.region_destino
	                 )
				AND $OC.fecha_carga = $OT.fecha_disponibilidad
				AND $OC.tipo_camion = $OT.tipo_camion
				WHERE 
				($OC.estado_oferta = '0'
				AND $OT.estado_oferta = '0')
				AND
				   ( DATEDIFF( NOW() , DATE_ADD( $OT.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) <= 0 )
	            AND
				   ( DATEDIFF( NOW() , DATE_ADD( $OC.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) <= 0 )";

		$where = "";
		if($usertype == "Transportista"){
			$where =  " AND $OT.idtransportista_fk = $idUserType";
		}else if($usertype == "GeneradorCarga"){
			$where =  " AND $OC.idgeneradorcarga_fk = $idUserType";
		}
				
		$querystr .= " " . $where;
		
		$query = $this->db->query($querystr);
		if ($query->num_rows() > 0) {
				foreach ($query->result_array() as  $row) {
						//$data[] = $row;
						//print_r($row);
					    $data = array("idofertacarga" => $row["idofertacarga"],
								"idofertatransportista" => $row["idofertatransportista"]);
						$query_info = $this->db->get_where($table["match_ofertas"]["name"],$data);
						if($query_info->num_rows() == 0){
							$this->db->insert($table["match_ofertas"]["name"],$data);
						}else{
							$num_match = $num_match - 1;
						}
				}
				
		}
		$num_match = $query->num_rows();

		//anular los registros fuera de tiempo...
		//FULL OUTER JOIN
		$queryf = "SELECT DISTINCT T.* FROM 
				    ((SELECT $OC.idofertacarga, $OT.idofertatransportista 
							FROM $ofertatransportista $OT
							LEFT JOIN $ofertacarga $OC 
							ON ($OT.ubicacion = $OC.origen_ciudad
							AND $OT.destino_preferente = $OC.destino_ciudad
							AND $OT.fecha_disponibilidad = $OC.fecha_carga
							AND $OT.tipo_camion = $OC.tipo_camion)
							WHERE 
							($OC.estado_oferta IN ('0','1')
				             AND
				             DATEDIFF( NOW() , DATE_ADD( $OC.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) >0)
							OR 
							($OT.estado_oferta IN ('0','1')
				             AND
				             DATEDIFF( NOW() , DATE_ADD( $OT.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) >0)
							)
					UNION ALL
					(SELECT $OC.idofertacarga, $OT.idofertatransportista 
							FROM ofertatransportista $OT
							RIGHT JOIN ofertacarga $OC 
							ON ($OT.ubicacion = $OC.origen_ciudad
							AND $OT.destino_preferente = $OC.destino_ciudad
							AND $OT.fecha_disponibilidad = $OC.fecha_carga
							AND $OT.tipo_camion = $OC.tipo_camion)
							WHERE 
							($OC.estado_oferta IN ('0','1')
				             AND
				             DATEDIFF( NOW() , DATE_ADD( $OC.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) >0)
							OR 
							($OT.estado_oferta IN ('0','1')
				             AND
				             DATEDIFF( NOW() , DATE_ADD( $OT.FECHA_PUBLICACION, INTERVAL 48 HOUR ) ) >0)
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
					$value = $this->db->update($table["ofertacarga"]["name"], $dataupd);	
					///////////////////////////////////////////
					///////////////////////////////////////////
					$this->db->where('idofertacarga', $idoc);
					$value = $this->db->update($table["match_ofertas"]["name"], $dataupdMatch);	
				}
				
				if($idot != NULL && intval($idot) > 0){
					
					$this->db->where('idofertatransportista', $idot);
					$value = $this->db->update($table["ofertatransportista"]["name"], $dataupd);	
					///////////////////////////////////////////
					///////////////////////////////////////////
					$this->db->where('idofertatransportista', $idot);
					$value = $this->db->update($table["match_ofertas"]["name"], $dataupdMatch);	
				}				
			}
				
		}
		
		$dato = array("total" => $num_match, "msg" => $msg);
		return $dato;
	}

	function get_num_match_ofertacarga_by_id($idUserType,$status= '' , $modalidad= "both") 
	{
		
		$table = json_decode(_TABLE,true);
		$transportista = $table["transportista"]["name"];				$T = $T["transportista"]["alias"]; 
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$generadorcarga = $table["generadorcarga"]["name"];				$GC = $table["generadorcarga"]["alias"];
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$match_ofertas = $table["match_ofertas"]["name"];				$MO = $table["match_ofertas"]["alias"];				
		$chofer = $table["chofer"]["name"];								$CH = $table["chofer"]["alias"]; 
		$camion = $table["camion"]["name"];								$CA = $table["camion"]["alias"]; 
		
		$ciudad = $table["ciudad"]["name"];								
																		$C1 = $table["ciudad1"]["alias"]; 
																		$C2 = $table["ciudad2"]["alias"]; 
		$region = $table["region"]["name"];								
																		$R1 = $table["region1"]["alias"]; 
																		$R2 = $table["region2"]["alias"]; 

		$where="";
		if( $modalidad == "both"){
			$where = "(($MO.estado_oferta_GC IN ('-1','-2') AND $MO.estado_solicitud_GC ='-2') 
			         OR ($MO.estado_solicitud_GC IN ('-1','2') AND $MO.estado_oferta_GC ='-2')) AND $OC.estado_oferta IN ('-1','-2')";
		}else if($modalidad == ENVIADAS ){
			$where = "$MO.estado_oferta_GC IN ('-1','1','2') AND $OC.estado_oferta IN ('0','1','2')";
		
		}else if($modalidad == RECIBIDAS ){
			$where = "$MO.estado_solicitud_GC IN ('-1','2') AND $MO.estado_oferta_GC ='-2' AND $OC.estado_oferta IN ('1','2')";
		
		}
		$query = $this->db->query("SELECT $OC.idofertacarga, $OC.IDGENERADORCARGA_FK, 
			$OC.fecha_publicacion, 
			$C1.NOMBRE AS ubicacion, $C2.NOMBRE AS destino
			FROM  `ofertacarga` $OC
			JOIN  `ciudad` $C1 ON $C1.IDCIUDAD = $OC.ORIGEN_CIUDAD
			JOIN  `ciudad` $C2 ON $C2.IDCIUDAD = $OC.DESTINO_CIUDAD
			INNER JOIN  `match_ofertas` $MO ON $OC.idofertacarga = $MO.idofertacarga
			WHERE $OC.IDGENERADORCARGA_FK =$idUserType		
			AND ( $where )"); 
				
		return $query->num_rows();
		
	}

	function get_num_match_ofertatransportista_by_id($idUserType,$status= '' , $modalidad= "both") 
	{
		$table = json_decode(_TABLE,true);
		$transportista = $table["transportista"]["name"];				$T = $T["transportista"]["alias"]; 
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$generadorcarga = $table["generadorcarga"]["name"];				$GC = $table["generadorcarga"]["alias"];
		$ofertacarga = $table["ofertacarga"]["name"];					$OC = $table["ofertacarga"]["alias"];
		$ofertatransportista = $table["ofertatransportista"]["name"];	$OT = $table["ofertatransportista"]["alias"];
		$match_ofertas = $table["match_ofertas"]["name"];				$MO = $table["match_ofertas"]["alias"];				
		$chofer = $table["chofer"]["name"];								$CH = $table["chofer"]["alias"]; 
		$camion = $table["camion"]["name"];								$CA = $table["camion"]["alias"]; 
		
		$ciudad = $table["ciudad"]["name"];								
																		$C1 = $table["ciudad1"]["alias"]; 
																		$C2 = $table["ciudad2"]["alias"]; 
		$region = $table["region"]["name"];								
																		$R1 = $table["region1"]["alias"]; 
																		$R2 = $table["region2"]["alias"]; 
		$where="";
		if( $modalidad == "both"){
			$where = "(($MO.estado_oferta IN ('-1','-2') AND $MO.estado_solicitud ='-2') 
			         OR ($MO.estado_solicitud IN ('-1','2') AND $MO.estado_oferta ='-2')) AND $OT.estado_oferta IN ('-1','-2')";
		}else if($modalidad == ENVIADAS ){
			$where = "$MO.estado_oferta IN ('-1','1','2') AND $OT.estado_oferta IN ('0','1','2')";
		
		}else if($modalidad == RECIBIDAS ){
			$where = "$MO.estado_solicitud IN ('-1','2') AND $MO.estado_oferta ='-2' AND $OT.estado_oferta IN ('1','2')";
		
		}
		$query = $this->db->query("SELECT $OT.idofertatransportista,$OT.IDTRANSPORTISTA_FK, 
			$OT.fecha_publicacion, $OT.patente, $OT.tipo_camion, 
			$C1.NOMBRE AS ubicacion, $C2.NOMBRE AS destino,
	        $CH.NOMBRE AS chofer
			FROM  `ofertatransportista` $OT
			JOIN  `ciudad` $C1 ON $C1.IDCIUDAD = $OT.UBICACION
			JOIN  `ciudad` $C2 ON $C2.IDCIUDAD = $OT.DESTINO_PREFERENTE
			JOIN  `chofer` $CH ON $CH.IDTRANSPORTISTA_FK = $OT.IDTRANSPORTISTA_FK
			JOIN  `camion` $CA ON $CA.PATENTE = $OT.PATENTE
			INNER JOIN  `match_ofertas` $MO ON $OT.idofertatransportista = $MO.idofertatransportista
			WHERE $OT.IDTRANSPORTISTA_FK =$idUserType
			AND $CH.IDCHOFER = $CA.IDCHOFER_FK
			AND ( $where )"); 
			
		return $query->num_rows();
	}


///////////////////////////// CRUD FOR oa TABLE //////////////////////////////////////////////////

}