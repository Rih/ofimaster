<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code




/*
*
*
Config Aplications Data
*
*
*/

	$_tables = array();
	$_table = array();

	define("SYSTEM_NAME", "TRANSRuta");
	define("EMAIL_SYSTEM", "no-reply@transruta.cl");
	// Tipos de usuario
	define("ADMIN", "Admin");
	define("EMPRESA", "Empresa");
	define("GENERADORCARGA", "GeneradorCarga");
	define("ADMIN_NAME", "Administrador");
	define("EMPRESA_NAME", "Empresa");
	define("TRANSPORTISTA_NAME", "Transportista");
	define("GENERADORCARGA_NAME", "Generador de Carga");
	// Modalidad de query
	define("RECIBIDAS", "recibidas");
	define("ENVIADAS", "enviadas");
	// Modalidad de ofertas
	define("OFERTA", "oferta");
	define("SOLICITUD", "solicitud");


	//nombres

	$_tables[] = "account";
	$_tables[] = "company";

	$_tables[] = "family";
	$_tables[] = "category";
	$_tables[] = "subcategory";
	$_tables[] = "product";
	$_tables[] = "catalog";
	$_tables[] = "log_catalog";



	//Nombres de Tablas

	$_table["account"]["name"] = "account";
	$_table["empresa"]["name"] = "company";

	$_table["familia"]["name"] = "family";
	$_table["categoria"]["name"] = "category";
	$_table["subcategoria"]["name"] = "subcategory";
	$_table["producto"]["name"] = "product";
	$_table["catalogo"]["name"] = "catalog";
	$_table["log_catalogo"]["name"] = "log_catalog";


	//Alias de tablas para construccion de Query's

	$_table["account"]["alias"] = "ACC";
	$_table["empresa"]["alias"] = "E";

	$_table["familia"]["alias"] = "FA";
	$_table["categoria"]["alias"] = "CA";
	$_table["subcategoria"]["alias"] = "SCA";
	$_table["producto"]["alias"] = "PR";
	$_table["catalogo"]["alias"] = "CLG";
	$_table["log_catalogo"]["alias"] = "LCTG";

	define("SUCCESS_MSG_ADD","Datos guardados correctamente.");
	define("ERROR_MSG_ADD","Problemas al guardar.");
	define("SUCCESS_MSG_UPD","Datos actualizados correctamente.");
	define("ERROR_MSG_UPD","Problemas al actualizar datos.");
	//status de oferta

	define("FINALIZADO_STAT", -2);
	define("ERROR_STAT", -1);
	define("INIT_STAT" , 0);
	define("REQUEST_STAT",  1);
	define("JOINED_STAT" , 2);

	//status de oferta

	define("ANULADO" , "Anulado, fuera de tiempo.");
	define("INICIADO" , "Iniciado.");
	define("PROCESANDO" , "En proceso.");
	define("FINALIZADO_EXITO" , "finalizado_exito.");
	define("FINALIZADO_RECHAZO" , "finalizado_rechazo.");
	define("HABILITADO" , "habilitado, fuera de tiempo.");
	define("DESHABILITADO" , "deshabilitado, fuera de tiempo.");

	//mensajes
	define("INFO_NO_DATA" , "Por el momento no hay informacion segun los filtros utilizados, Ingrese su camion disponible para que las empresas que buscan CAMIONES se pongan en contacto con usted");
	define("ERROR_VALIDACION","Complete todos los campos solicitados por favor");

	//URL PATH
	define("URL_PATH_UPLOAD","uploads".DIRECTORY_SEPARATOR);
	define("BASE_WEBPAGE","http://www.ofimaster.cl");
	define ("_TABLES", json_encode($_tables));
	define ("_TABLE", json_encode($_table));
