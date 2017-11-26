<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	static $configData = array();
	static $_tables = array();
	static $_table = array();
	static $_statusOferta = array();
	static $_descOferta = array();
	static $_mensajes = array();

	// Tipos de usuario
	$configData["Admin"] = "Admin";
	$configData["Transportista"] = "Transportista";
	$configData["GeneradorCarga"] = "GeneradorCarga";
	// Modalidad de query
	$configData["recibidas"] = "recibidas";
	$configData["enviadas"] = "enviadas";
	// Modalidad de ofertas	
	$configData["oferta"] = "oferta";
	$configData["solicitud"] = "solicitud";

	
	//nombres
	$_tables[] = "camion";
	$_tables[] = "chofer";
	$_tables[] = "generadorcarga";
	$_tables[] = "ofertacarga";
	$_tables[] = "carga";
	$_tables[] = "transportista";
	$_tables[] = "ofertatransportista";
	$_tables[] = "match_ofertas";	
	$_tables[] = "estado";

	$_tables[] = "account";
	$_tables[] = "sucursal";
	$_tables[] = "empresa";	
	$_tables[] = "ciudad";	
	$_tables[] = "calculo_distancia_ciudades";
	$_tables[] = "region";
	
	
	
	//Nombres de Cablas
	$_table["camion"]["name"] = "camion";
	$_table["chofer"]["name"] = "chofer";
	$_table["generadorcarga"]["name"] = "generadorcarga";
	$_table["ofertacarga"]["name"] = "ofertacarga";
	$_table["carga"]["name"] = "carga";
	$_table["transportista"]["name"] = "transportista";
	$_table["ofertatransportista"]["name"] = "ofertatransportista";
	$_table["match_ofertas"]["name"] = "match_ofertas";
	$_table["estado"]["name"] = "estado";

	$_table["account"]["name"] = "account";	
	$_table["sucursal"]["name"] = "sucursal";
	$_table["empresa"]["name"] = "empresa";

	$_table["ciudad"]["name"] = "ciudad";
	$_table["ciudad1"]["name"] = "ciudad";
	$_table["ciudad2"]["name"] = "ciudad";
	$_table["distancia_ciudades"]["name"] = "calculo_distancia_ciudades";
	$_table["region"]["name"] = "region";
	$_table["region1"]["name"] = "region";
	$_table["region2"]["name"] = "region";
	
	//Alias de tablas para construccion de Query's

	$_table["camion"]["alias"] = "CA";
	$_table["chofer"]["alias"] = "CH";
	$_table["generadorcarga"]["alias"] = "GC";
	$_table["ofertacarga"]["alias"] = "OC";
	$_table["carga"]["alias"] = "CAR";
	$_table["transportista"]["alias"] = "T";
	$_table["ofertatransportista"]["alias"] = "OT";
	$_table["match_ofertas"]["alias"] = "MO";	
	$_table["estado"]["alias"] = "estado";
	
	$_table["account"]["alias"] = "ACC";
	$_table["sucursal"]["alias"] = "SU";
	$_table["empresa"]["alias"] = "empresa";

	$_table["ciudad"]["alias"] = "CD";
	$_table["ciudad1"]["alias"] = "C1";
	$_table["distancia_ciudades"]["alias"] = "CDC";
	$_table["ciudad2"]["alias"] = "C2";
	$_table["region"]["alias"] = "RG";
	$_table["region1"]["alias"] = "R1";
	$_table["region2"]["alias"] = "R2";
	

	//status de oferta
	
	$_statusOferta["-2"] = -2;
	$_statusOferta["-1"] = -1;
	$_statusOferta["0"] = 0;
	$_statusOferta["1"] = 1;
	$_statusOferta["2"] = 2;
	
	//status de oferta
	
	$_descOferta["anulado"] = "Anulado, fuera de tiempo.";
	$_descOferta["iniciado"] = "Iniciado.";
	$_descOferta["procesando"] = "En proceso.";
	$_descOferta["finalizado_exito"] = "finalizado_exito.";
	$_descOferta["finalizado_rechazo"] = "finalizado_rechazo.";
	$_descOferta["habilitado"] = "habilitado, fuera de tiempo.";
	$_descOferta["deshabilitado"] = "deshabilitado, fuera de tiempo.";

	
	$_mensajes["info_no_data"] = "Por el momento no hay información según los filtros utilizados, Ingrese su camión disponible para que las empresas que buscan CAMIONES se pongan en contacto con usted";



?>