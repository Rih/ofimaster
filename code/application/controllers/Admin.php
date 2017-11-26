<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *	@author : Joyonto Roy
 *	date	: 20 August, 2013
 *	University Of Dhaka, Bangladesh
 *   Nulled By Vokey
 *	Ekattor School & College Management System
 *	http://codecanyon.net/user/joyontaroy
 */

class Admin extends CI_Controller
{


    function __construct()
    {
        parent::__construct();

		$this->load->model('Crud_model');
        $this->load->model('Admin_model');

        $this->load->database();
        $this->load->library("pagination");
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {


        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . '?Login', 'refresh');
        if ($this->session->userdata('admin_login') == 1){
            $usertype = $this->session->userdata('login_type');
            redirect(base_url() . '?'.$usertype.'/dashboard', 'refresh');
        }


    }

    /***ADMIN DASHBOARD***/
    function dashboard($param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            if($param1 != ''){
                $page_data['msg'] = $param1;
            }

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);
            $todos = "-1";
            $order_by = "DESC";
            $page_data["ultimos_catalogos"] = $this->Generic_model->catalog_get_all($order_by);
            $page_data["catalogos_descargados"] = $this->Generic_model->log_catalog_get_all($order_by);
            $page_data["ultimos_registrados"] = $this->Admin_model->fetch_tabla_empresa_all($todos, $order_by);
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'dashboard','Dashboard');
            $this->load->view('index', $page_data);
        }


    }

     function misdatos($action = "none",$mode = "none") //upd emp = empresa o rep = representante
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);

            if($action == "upd" && $mode == "emp"){
                $business_name = $this->input->post('business_name');
                 $rut = $this->input->post('rut');
                 $line_of_business = $this->input->post('line_of_business');
                 $company_name = $this->input->post('company_name');
                 $contact_phone = $this->input->post('contact_phone');
                 $position = $this->input->post('position');
                 $city_state = $this->input->post('city_state');
                 //$fono = $this->input->post('fono');
                 //$pag_web = $this->input->post('pag_web');
                 $comments = $this->input->post('comments');
                 $data = array("business_name" => $business_name,
                              "line_of_business" => $line_of_business,
                              "RUT" => $rut,
                              "company_name" => $company_name,
                              "contact_phone" => $contact_phone,
                              "position" => $position,
                              "city_state" => $city_state,
                              "comments" => $comments
                              );

                $this->Empresa_model->empresa_update_by_id($idAcc,$data);
                $msg_result = ($result== true)?SUCCESS_MSG_UPD:ERR_MSG_UPD;
                $return = array("msg" => $msg_result,
                "num_disabled_accs" => "-1",
                "num_catalogos" => "-1");
                echo json_encode($return);

            }
            if($action == "upd" && $mode == "rep"){
                $name_legal_rep = $this->input->post('name_legal_rep');
                $RUT_legal_rep = $this->input->post('RUT_legal_rep');
                $address_legal_rep = $this->input->post('address_legal_rep');
                $comments_legal_rep = $this->input->post('comments_legal_rep');


                $data = array("name_legal_rep" =>  $name_legal_rep,
                              "RUT_legal_rep" => $RUT_legal_rep,
                              "address_legal_rep" => $address_legal_rep,
                              "comments_legal_rep" => $comments_legal_rep
                              );
                $result = $this->Empresa_model->empresa_update_by_id($idAcc,$data);
                $msg_result = ($result== true)?SUCCESS_MSG_UPD:ERR_MSG_UPD;

                $return = array("msg" => $msg_result,
                "num_disabled_accs" => "-1",
                "num_catalogos" => "-1");
                echo json_encode($return);


            }
            if($action =="none"){
                $limit = 10;
                $page_data['mis_datos'] = $this->Empresa_model->fetch_tabla_empresa($idAcc,$limit, 0);
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'misdatos','Mis Datos');
                $this->load->view('index', $page_data);
            }


        }


    }


    function clientes($option = "show", $id = 0 , $mode = "none")
    {
       if ($this->session->userdata('admin_login') != 1){
           redirect(base_url(), 'refresh');
       }
       else{

           $page_data = array();
           $idAcc = $this->session->userdata('userid');
           $usrtype = $this->session->userdata('login_type');
           $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);
           $tablename = 'account';
           $enabled = -1;

           if($option == "show"){
               $page_data["cuentas_info"] = $this->Admin_model->fetch_tabla_empresa_all($enabled);
               $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'clientes','Gestion Clientes');
               $this->load->view('index', $page_data);
           }

       }


   }

     function hab_cuentas($option = "show", $id = 0 , $mode = "none")
     {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);
            $tablename = 'account';
            $enabled = 0;




            //$page_data['cuentas'] = $this->Admin_model->fetch_tabla($tablename,$limit,$start);
            //print_r($page_data["cuentas_info"]);

            if($option == "hab"){

                $result = $this->Generic_model->table_update_by_id_field('account',$id,'enabled',1);
                $msg_result = ($result== true)?SUCCESS_MSG_UPD:ERR_MSG_UPD;
                $page_data["cuentas_info"] = $this->Admin_model->fetch_tabla_empresa_all($enabled);
                $disabled_accs = $this->Generic_model->get_num_cuentas(0);
                $return = array("msg" => $msg_result, "tabla" => $page_data["cuentas_info"],
                "num_disabled_accs" => $disabled_accs,
                "num_catalogos" => "-1");
                echo json_encode($return);
                //redirect(base_url()."?".$usrtype."/hab_cuentas",'refresh');
            }



            if($option == "show"){
                $page_data["cuentas_info"] = $this->Admin_model->fetch_tabla_empresa_all($enabled);
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'hab_cuentas','Cuentas');
                $this->load->view('index', $page_data);
            }

        }


    }
    /*
    * CUENTAS
    */

     function cuentas($option = "show", $id = 0 , $mode = "none") //mode es para upd //cargaS = carga
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);
            $tablename = 'account';
            //$page_data['cuentas_info'] = $this->Admin_model->fetch_tabla_empresa_all($idAcc);
            $table = json_decode(_TABLE, true);
            $enabled = -1;
            //$page_data['num_ofertas'] = $this->Admin_model->get_num_ofertatransportista_by_id($idUserType);
            //$page_data['cargas'] = $this->Admin_model->carga_get_all_by_id(0,$idUserType);


            $config = array();
            $config["base_url"] = base_url() . "?".$usrtype."/cuentas/$option/$id/$mode";
            $config["total_rows"] = $page_data['num_cuentas'];
            $config["per_page"] = 20; //20 antes
            $config["uri_segment"] = 6;

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
            $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
            $limit = $config["per_page"];
            $start = $page;
            //$page_data['cuentas'] = $this->Admin_model->fetch_tabla($tablename,$limit,$start);
            //print_r($page_data["regiones"]);
            $page_data["links"] = $this->pagination->create_links();


            if($option == "add"){

                 $Muser = $this->input->post('username');
                 $raw_password = $this->input->post('password');
                 $saltlen = 10;
                 $acctype = 1; // siempre usuario comun
                 $salt = $this->Admin_model->generateRandomString($saltlen,0);
                 $password = sha1($raw_password.$salt);
                 $data = array(
                                "username" => $Muser,
                                "password" => $password,
                                "salt" => $salt,
                                "enabled" => 1,
                                "usertype" => $acctype
                              );
                $this->Admin_model->table_insert($tablename,$data);
                $idacc = $this->db->insert_id();
                $this->Admin_model->table_insert("company",array('idaccount_fk' => $idacc, "contact_mail" => $Muser));


                $email_sub = "Creación de Cuenta";
               	$usertype = ($acctype == "0")?ADMIN:EMPRESA;
                $result = $this->Email_model->sendCredentials($Muser,$email_sub,$usertype,$raw_password);
                //$this->load->view('index', $page_data);
                //redirect(base_url()."?".$usrtype."/cuentas",'refresh');
                $msg_result = ($result== true)?SUCCESS_MSG_ADD." Se ha enviado informacion al correo indicado.":ERR_MSG_ADD;
                $page_data["cuentas_info"] = $this->Admin_model->fetch_tabla_empresa_all($enabled);
                $return = array("msg" => $msg_result, "tabla" => $page_data["cuentas_info"],
                "num_disabled_accs" => "-1",
                "num_catalogos" => "-1");
                echo json_encode($return);
            }

            else if($option == "upd" && $id > 0){

                if($mode == "commit"){  //efectuar update
                	$acctype = $this->Admin_model->get_datafield_by_id($tablename, $id, "usertype");
                    $Muser = $this->input->post('username');
                    $raw_password = $this->input->post('password');
                    $saltlen = 10;
                    $salt = $this->Admin_model->generateRandomString($saltlen);
                    $password = sha1($raw_password.$salt);
                    $data = array(
                                "username" => $Muser,
                                "password" => $password,
                                "salt" => $salt

                              );
                    $this->Admin_model->table_update($tablename,$id,$data);
                    //$this->Admin_model->table_update("company",$id,$data);
                	//"contact_mail" => $Muser
                	$email_sub = "Recuperación de Cuenta";
	                $usertype = ($acctype == "0")?ADMIN:EMPRESA;
	                $result = $this->Email_model->sendCredentials($Muser,$email_sub,$usertype,$raw_password);

                    //redirect(base_url()."?".$usrtype."/cuentas",'refresh');
                    $msg_result = ($result== true)?SUCCESS_MSG_UPD:ERR_MSG_UPD;
                    $page_data["cuentas_info"] = $this->Admin_model->fetch_tabla_empresa_all($enabled);
                    $return = array("msg" => $msg_result, "tabla" => $page_data["cuentas_info"],
                    "num_disabled_accs" => "-1",
                    "num_catalogos" => "-1");
                    echo json_encode($return);

                }
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'cuentas','Cuentas');
                $this->load->view('index', $page_data);
            }
            if($option == "del" && $id > 0){


                $this->Admin_model->delete_by_id($tablename,$id);
                redirect(base_url()."?".$usrtype."/cuentas",'refresh');
            }
            if($option == "hab" && $id > 0){

                //$this->Admin_model->delete_by_id($tabletype,array('idaccount' => $idacc));
                //$this->Admin_model->delete_by_id("empresa",array('idaccount' => $idacc));
                //$this->Generic_model->table_update_by_id('account',$id,'enabled',1);
                //redirect(base_url()."?".$usrtype."/cuentas",'refresh');
                $result = $this->Generic_model->table_update_by_id_field('account',$id,'enabled',1);
                $msg_result = ($result== true)?SUCCESS_MSG_UPD:ERR_MSG_UPD;
                $page_data["cuentas_info"] = $this->Admin_model->fetch_tabla_empresa_all($enabled);
                $disabled_accs = $this->Generic_model->get_num_cuentas(0);
                $return = array("msg" => $msg_result, "tabla" => $page_data["cuentas_info"],
                "num_disabled_accs" => $disabled_accs,
                "num_catalogos" => "-1");
                echo json_encode($return);
                //redirect(base_url()."?".$usrtype."/hab_cuentas",'refresh');
            }
            if($option == "prof" && $id > 0){

                $name_legal_rep = $this->input->post('name_legal_rep');
                $rut_legal_rep = $this->input->post('rut_legal_rep');
                $business_name = $this->input->post('business_name');
                $rut = $this->input->post('rut');
                $company_name = $this->input->post('company_name');
                $line_of_business = $this->input->post('line_of_business');
                $contact_phone = $this->input->post('contact_phone');
                $city_state = $this->input->post('city_state');
                $position = $this->input->post('position');
                $data = array(
                            "business_name" => $business_name,
                            "RUT" => $rut,
                            "company_name" => $company_name,
                            "line_of_business" => $line_of_business,
                            "contact_phone" => $contact_phone,
                            "city_state" => $city_state,
                            "position" => $position,
                            "name_legal_rep" => $name_legal_rep,
                            "RUT_legal_rep" => $rut_legal_rep,
                            "idaccount_fk" => $id
                        );


                $result = $this->Generic_model->table_update($table["empresa"]["name"],$id,$data);
                $msg_result = ($result== true)?SUCCESS_MSG_UPD:ERR_MSG_UPD;
                $page_data["cuentas_info"] = $this->Admin_model->fetch_tabla_empresa_all($enabled);
                $return = array("msg" => $msg_result, "tabla" => $page_data["cuentas_info"],
                "num_disabled_accs" => "-1",
                "num_catalogos" => "-1");
                echo json_encode($return);
                //redirect(base_url()."?".$usrtype."/hab_cuentas",'refresh');
            }

            if($option == "show"){
              $page_data["cuentas_info"] = $this->Admin_model->fetch_tabla_empresa_all($enabled);
            	$page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'cuentas','Cuentas');
              $this->load->view('index', $page_data);
            }

        }


    }




    /*
    * ARCHIVOS
    */

      function old_archivos($action="none", $id = 0)
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $tbls = json_decode(_TABLES);
            $tbl = json_decode(_TABLE, true);


            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);
            $tableName = $tbl["catalogo"]["name"];
            $view = "archivos"; $viewTitle = "Gestionar Archivos";
            $upload_path_url = 'uploads/tmp/';
            $consolidated_path = 'uploads/';
            $olds_path = 'uploads/olds/';
            $deleteds_path = 'uploads/deletes/';

            $page_data["categorias"] = $this->Admin_model->fetch_tabla($tbl["categoria"]["name"]);
            if($action == "upload"){
                //print_r($_FILES["userfile"]);
                //$upload_path_url = base_url().'/uploads/';


                $config['upload_path']          = $upload_path_url;
                $config['allowed_types']        = 'pdf|rar';//'gif|jpg|png';
                $config['max_size']             = 150*1024*1024; // 150.000 KB
                $config['remove_spaces']             = false; // Remover espacios por _
                $idcategory = $this->input->post("category");
                $name_cat = $this->Generic_model->get_field_by_id($tbl["categoria"]["name"],$idcategory,"name")->name;
                $config['file_name'] = $name_cat;
                $pathfile = $upload_path_url . $name_cat.".pdf";
                $pathfile2 = $upload_path_url . $name_cat.".rar";
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;
                $msg_upd ="";
                $return = "";
                //$file = $_FILES["userfile"];
                //$return = $file;
                if(file_exists($pathfile)) unlink($pathfile); // borrar de tmp   *.pdf
                if(file_exists($pathfile2)) unlink($pathfile2); // borrar de tmp *.rar

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                    $error =  $this->upload->display_errors();
                    $page_data["error"] = $error;
                }
                else
                {
                    //se sube a uploads/tmp
                    $data = array('upload_data' => $this->upload->data());
                    $filename_ext = $data["upload_data"]["file_name"];
                    $extension = $data["upload_data"]["file_ext"];
                    $column_data = ($extension == ".pdf")? "has_pdf": "has_rar"; //asociado a catalogo
                    $return += $data;
                    $title = $this->input->post("title");
                    $description = $this->input->post("description");
                    $size = $this->input->post("size_catalog");
                    $data_catalog = array("title" => $title
                                        ,"description" => $description
                                        ,"size" => $size
                                        ,$column_data => 1
                                        ,"idcategory_fk" => $idcategory);

                    // si ya existe lo cambia a olds, sino solo mueve desde uploads/tmp a uploads/
                    if (file_exists($consolidated_path.$data["upload_data"]["file_name"]) ) {
                        //rename($consolidated_path.$filename_ext,$olds_path.uniqid().'-'.$filename_ext);// se mueve a olds
                        unlink($consolidated_path.$filename_ext);
                        $msg_upd = "Archivo existente fue reemplazado";
                    }
                    rename($upload_path_url.$filename_ext,$consolidated_path.$filename_ext);
                    unlink($upload_path_url.$filename_ext);

                    if($id > 0){ // UPDATE

                        //$return += array("fname" => $consolidated_path.$data["upload_data"]["file_name"]);
                        $result = $this->Admin_model->table_update($tableName,$id,$data_catalog);
                        $msg_result = ($result== true)?SUCCESS_MSG_UPD:ERR_MSG_UPD;
                        //$this->Generic_model->table_update_by_id_field($tableName,$id,$column_data,1);
                    }else{ //CREATE

                        $result = $this->Admin_model->table_insert($tableName,$data_catalog);
                        //$id = $this->db->insert_id();

                        $msg_result = ($result== true)?SUCCESS_MSG_ADD:ERR_MSG_ADD;
                    }


                    $page_data["result"] = $this->Generic_model->catalog_get_all(  );
                    $num_catalogos = $this->Generic_model->get_num_filas("catalog");
                    $return += array("msg" => $msg_result.$msg_upd, "tabla" => $page_data["result"],
                    "num_disabled_accs" => "-1",
                    "num_catalogos" => $num_catalogos);
                    echo json_encode($return);

                    /*$idcatalog = $this->db->insert_id();
                    $all_prods = json_decode($this->input->post('all_products'), true);
                    $data_batch = array();
                    foreach ($all_prods as $key => $v) {
                        $name = $v["name"];
                        $mark = $v["mark"];
                        print_r("name:" .$name);
                        print_r("mark:" .$mark);

                        $data_batch[] = array("name" => $name, "mark" => $mark, "idcatalog_fk" => $idcatalog, "idcategory_fk" => $idcategory);
                    }
                    $this->db->insert_batch($tbl["producto"]["name"],$data_batch);
                    print_r($all_prods);
                    */
                    //$page_data["success"] = "Exito";
                }

            }
            if($action=="del")
            {
                $idcategory = $this->Generic_model->get_field_by_id($tbl["catalogo"]["name"],$id,"idcategory_fk")->idcategory_fk;
                $name_cat = $this->Generic_model->get_field_by_id($tbl["categoria"]["name"],$idcategory,"name")->name;
                $this->Admin_model->delete_by_id($tbl["catalogo"]["name"],$id);
                //unlink($upload_path_url.$name_cat.".pdf");
                //rename($upload_path_url.$name_cat.".pdf",$upload_path_url."deletes/".$name_cat.".pdf");
                if (file_exists($consolidated_path.$name_cat.".pdf") ) {
                    //rename($consolidated_path.$name_cat.".pdf",$deleteds_path.uniqid().'-'.$name_cat.".pdf");// se mueve a deletes
                    unlink($consolidated_path.$name_cat.".pdf");
                }
                if (file_exists($consolidated_path.$name_cat.".rar") ) {
                    //rename($consolidated_path.$name_cat.".rar",$deleteds_path.uniqid().'-'.$name_cat.".rar");// se mueve a deletes
                    unlink($consolidated_path.$name_cat.".rar");
                }

                redirect(base_url()."?".$usrtype."/".$view,"refresh");
            }
            if($action =="none")
            {
                $page_data["result"] = $this->Generic_model->catalog_get_all(  );
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,$view, $viewTitle);
                $this->load->view('index', $page_data);

            }

        }


    }


      /*
    * CATALOGO
    */

      function catalogo($action="add", $id = 0)
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $tbls = json_decode(_TABLES);
            $tbl = json_decode(_TABLE, true);


            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);
            $tableName = $tbl["catalogo"]["name"];
            $view = "archivos"; $viewTitle = "Gestionar Archivos";
            $upload_path_url = 'uploads/tmp/';
            $consolidated_path = 'uploads/';
            $olds_path = 'uploads/olds/';
            $deleteds_path = 'uploads/deletes/';

            $page_data["categorias"] = $this->Admin_model->fetch_tabla($tbl["categoria"]["name"]);
            if($action == "add"){
                
                $title = $this->input->post("title");
                $description = $this->input->post("description");
                $idcategory = $this->input->post("category");
                $size = $this->input->post("size_catalog");
                $size_rar = $this->input->post("size_rar_catalog");
                $column_pdf = ($size > 0)?1:0;
                $column_rar = ($size_rar > 0)?1:0;
                $data_catalog = array("title" => $title
                                    ,"description" => $description
                                    ,"size" => $size
                                    ,"size_rar" => $size_rar
                                    ,"has_rar" => $column_rar                                    
                                    ,"has_pdf" => $column_pdf
                                    ,"idcategory_fk" => $idcategory);

               
                if($id > 0){ // UPDATE

                    //$return += array("fname" => $consolidated_path.$data["upload_data"]["file_name"]);
                    $result = $this->Admin_model->table_update($tableName,$id,$data_catalog);
                    $msg_result = ($result== true)?SUCCESS_MSG_UPD:ERR_MSG_UPD;
                    //$this->Generic_model->table_update_by_id_field($tableName,$id,$column_data,1);
                }else{ //CREATE

                    $result = $this->Admin_model->table_insert($tableName,$data_catalog);
                    //$id = $this->db->insert_id();

                    $msg_result = ($result== true)?SUCCESS_MSG_ADD:ERR_MSG_ADD;
                }

                redirect(base_url()."?".$usrtype."/".$view,'refresh');
                /*$page_data["result"] = $this->Generic_model->catalog_get_all(  );
                $num_catalogos = $this->Generic_model->get_num_filas("catalog");
                $return += array("msg" => $msg_result.$msg_upd, "tabla" => $page_data["result"],
                "num_disabled_accs" => "-1",
                "num_catalogos" => $num_catalogos);
                echo json_encode($return);
                */
                /*$idcatalog = $this->db->insert_id();
                $all_prods = json_decode($this->input->post('all_products'), true);
                $data_batch = array();
                foreach ($all_prods as $key => $v) {
                    $name = $v["name"];
                    $mark = $v["mark"];
                    print_r("name:" .$name);
                    print_r("mark:" .$mark);

                    $data_batch[] = array("name" => $name, "mark" => $mark, "idcatalog_fk" => $idcatalog, "idcategory_fk" => $idcategory);
                }
                $this->db->insert_batch($tbl["producto"]["name"],$data_batch);
                print_r($all_prods);
                */
                //$page_data["success"] = "Exito";
            

            }
            
            if($action=="del")
            {
                $idcategory = $this->Generic_model->get_field_by_id($tbl["catalogo"]["name"],$id,"idcategory_fk")->idcategory_fk;
                $name_cat = $this->Generic_model->get_field_by_id($tbl["categoria"]["name"],$idcategory,"name")->name;
                $this->Admin_model->delete_by_id($tbl["catalogo"]["name"],$id);
                //unlink($upload_path_url.$name_cat.".pdf");
                //rename($upload_path_url.$name_cat.".pdf",$upload_path_url."deletes/".$name_cat.".pdf");
                if (file_exists($consolidated_path.$name_cat.".pdf") ) {
                    //rename($consolidated_path.$name_cat.".pdf",$deleteds_path.uniqid().'-'.$name_cat.".pdf");// se mueve a deletes
                    unlink($consolidated_path.$name_cat.".pdf");
                }
                if (file_exists($consolidated_path.$name_cat.".rar") ) {
                    //rename($consolidated_path.$name_cat.".rar",$deleteds_path.uniqid().'-'.$name_cat.".rar");// se mueve a deletes
                    unlink($consolidated_path.$name_cat.".rar");
                }

                redirect(base_url()."?".$usrtype."/".$view,"refresh");
            }

            if($action =="none")
            {
                $page_data["result"] = $this->Generic_model->catalog_get_all(  );
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,$view, $viewTitle);
                $this->load->view('index', $page_data);

            }

        }


    }


        /*
        * ARCHIVOS
        */

       function archivos($action="none", $id = 0)
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $tbls = json_decode(_TABLES);
            $tbl = json_decode(_TABLE, true);


            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);
            $tableName = $tbl["catalogo"]["name"];
            $view = "archivos"; $viewTitle = "Gestionar Archivos";
            $upload_path_url = 'uploads/tmp/';
            $consolidated_path = 'uploads/';
            $olds_path = 'uploads/olds/';
            $deleteds_path = 'uploads/deletes/';

            $page_data["categorias"] = $this->Admin_model->fetch_tabla($tbl["categoria"]["name"]);
            
            if($action== "upload"){
                /**
                 * upload.php
                 *
                 * Copyright 2013, Moxiecode Systems AB
                 * Released under GPL License.
                 *
                 * License: http://www.plupload.com/license
                 * Contributing: http://www.plupload.com/contributing
                 */

                #!! IMPORTANT:
                #!! this file is just an example, it doesn't incorporate any security checks and
                #!! is not recommended to be used in production environment as it is. Be sure to
                #!! revise it and customize to your needs.


                // Make sure file is not cached (as it happens for example on iOS devices)
                header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                header("Cache-Control: no-store, no-cache, must-revalidate");
                header("Cache-Control: post-check=0, pre-check=0", false);
                header("Pragma: no-cache");

                /*
                // Support CORS
                header("Access-Control-Allow-Origin: *");
                // other CORS headers if any...
                if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
                    exit; // finish preflight CORS requests here
                }
                */

                // 5 minutes execution time
                @set_time_limit(5 * 60);

                // Uncomment this one to fake upload time
                // usleep(5000);

                // Settings
                //$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
                $targetDir = '../code/uploads';
                $cleanupTargetDir = true; // Remove old files
                $maxFileAge = 5 * 3600; // Temp file age in seconds


                // Create target dir
                if (!file_exists($targetDir)) {
                    @mkdir($targetDir);
                }

                // Get a file name
                if (isset($_REQUEST["name"])) {
                    $fileName = $_REQUEST["name"];
                } elseif (!empty($_FILES)) {
                    $fileName = $_FILES["file"]["name"];
                } else {
                    $fileName = uniqid("file_");
                }

                $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

                // Chunking might be enabled
                $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
                $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


                // Remove old temp files
                if ($cleanupTargetDir) {
                    if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
                    }

                    while (($file = readdir($dir)) !== false) {
                        $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                        // If temp file is current file proceed to the next
                        if ($tmpfilePath == "{$filePath}.part") {
                            continue;
                        }

                        // Remove temp file if it is older than the max age and is not the current file
                        if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                            @unlink($tmpfilePath);
                        }
                    }
                    closedir($dir);
                }


                // Open temp file
                if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
                    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
                }

                if (!empty($_FILES)) {
                    if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
                    }

                    // Read binary input stream and append it to temp file
                    if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                    }
                } else {
                    if (!$in = @fopen("php://input", "rb")) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                    }
                }

                while ($buff = fread($in, 4096)) {
                    fwrite($out, $buff);
                }

                @fclose($out);
                @fclose($in);

                // Check if file has been uploaded
                if (!$chunks || $chunk == $chunks - 1) {
                    // Strip the temp .part suffix off
                    rename("{$filePath}.part", $filePath);
                }

                // Return Success JSON-RPC response
                die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');

            }

            if($action =="none")
            {
                $page_data["result"] = $this->Generic_model->catalog_get_all(  );
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,$view, $viewTitle);
                $this->load->view('index', $page_data);

            }

        }


    }



    function download($idcategoria, $idcatalogo = 0, $extension="pdf")
    {
        $tbls = json_decode(_TABLES);
        $tbl = json_decode(_TABLE, true);
        //actualizar num descarga

        $file_name = $this->Generic_model->get_field_by_id($tbl["categoria"]["name"],$idcategoria,"name")->name;
        //$name = "uploads/".$path;
        //force_download($name, NULL);
        //load the download helper
        $this->load->helper('download');
        //Get the file from whatever the user uploaded (NOTE: Users needs to upload first), @See http://localhost/CI/index.php/upload
        $data = file_get_contents("uploads/".$file_name.".".$extension);
        //Read the file's contents
        //$name = 'niceupload.'.$extension;
        $name = $file_name.".".$extension;
        force_download($name, $data);


    }
    /*
    FAMILIAS
    */
    function familias($action="none", $id = 0)
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $tbls = json_decode(_TABLES);
            $tbl = json_decode(_TABLE, true);
            $tableName = $tbl["familia"]["name"];
            $view = "familias"; $viewTitle = "Gestionar Familias";
            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);

            if($action=="add")
            {
                $name = $this->input->post('name');
                $data = array("name" => $name);
                $result = $this->Generic_model->table_insert($tableName, $data);
                $msg_result = ($result== true)?SUCCESS_MSG_ADD:ERR_MSG_ADD;

                $page_data["result"] = $this->Admin_model->fetch_tabla( $tbl["familia"]["name"] );
                $return = array("msg" => $msg_result, "tabla" => $page_data["result"],
                "num_disabled_accs" => "-1",
                "num_catalogos" => "-1");
                echo json_encode($return);

                //redirect(base_url()."?".$usrtype."/".$view,'refresh');

            }
            else if($action=="upd")
            {
                $name = $this->input->post('name');
                $data = array("name" => $name);
                $result = $this->Generic_model->table_update_by_id_field($tableName,$id,"name",$name);

                $msg_result = ($result== true)?SUCCESS_MSG_UPD:ERR_MSG_UPD;
                $page_data["result"] = $this->Admin_model->fetch_tabla( $tbl["familia"]["name"] );
                $return = array("msg" => $msg_result, "tabla" => $page_data["result"],
                "num_disabled_accs" => "-1",
                "num_catalogos" => "-1");
                echo json_encode($return);
                //redirect(base_url()."?".$usrtype."/".$view,'refresh');

            }
            else if($action=="del")
            {
                 $this->Generic_model->delete_by_id($tableName,$id);
                redirect(base_url()."?".$usrtype."/".$view,'refresh');
            }

            if($action=="none"){
                $page_data["result"] = $this->Admin_model->fetch_tabla( $tbl["familia"]["name"] );
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,$view, $viewTitle);
                $this->load->view('index', $page_data);
            }


        }


    }

    /*
    * CATEGORIAS
    */

    function categorias($action="none", $id = 0)
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $tbls = json_decode(_TABLES);
            $tbl = json_decode(_TABLE, true);
            $tableName = $tbl["categoria"]["name"];
            $view = "categorias"; $viewTitle = "Gestionar Categorias";
            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Admin_model->account_get_id_by_type($idAcc,$usrtype);
            $page_data["familias"] = $this->Admin_model->fetch_tabla( $tbl["familia"]["name"] );
            if($action=="add")
            {
                $family = $this->input->post('family');
                $name = $this->input->post('name');
                $data = array("name" => $name, "idfamily_fk" => $family);

                $result = $this->Generic_model->table_insert($tableName, $data);
                $msg_result = ($result== true)?SUCCESS_MSG_ADD:ERR_MSG_ADD;

                $page_data["result"] = $this->Generic_model->category_get_all(  );
                $return = array("msg" => $msg_result, "tabla" => $page_data["result"],
                "num_disabled_accs" => "-1",
                "num_catalogos" => "-1");
                echo json_encode($return);

                //$this->Generic_model->table_insert($tableName, $data);
                //redirect(base_url()."?".$usrtype."/".$view,'refresh');

            }
            else if($action=="upd")
            {
                $family = $this->input->post('family');
                $name = $this->input->post('name');
                $data = array("name" => $name, "idfamily_fk" => $family);

                $result = $this->Generic_model->table_update($tableName,$id,$data);

                $msg_result = ($result== true)?SUCCESS_MSG_UPD:ERR_MSG_UPD;
                $page_data["result"] = $this->Generic_model->category_get_all(  );
                $return = array("msg" => $msg_result, "tabla" => $page_data["result"],
                "num_disabled_accs" => "-1",
                "num_catalogos" => "-1");
                echo json_encode($return);
                //redirect(base_url()."?".$usrtype."/".$view,'refresh');

            }
            else if($action=="del")
            {
                 $this->Generic_model->delete_by_id($tableName,$id);
                redirect(base_url()."?".$usrtype."/".$view,'refresh');
            }

            if($action=="none"){
                $page_data["result"] = $this->Generic_model->category_get_all(  );
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,$view, $viewTitle);
                $this->load->view('index', $page_data);
            }


        }


    }




    function services_to_excel()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $page_data['page_title'] = 'Services to Excel';
            $page_data['page_name']  = 'services_to_excel';
            $total = $this->Admin_model->get_num_filas('service');
            $limit = 20;
            $start = 0;
            $finalresult = array();

            for($start; $start <= $total; $start += $limit){
                $result = $this->Admin_model->fetch_tabla('service',$limit,$start);
                if ($result != false)
                    foreach($result as $res)
                        $finalresult[] = $res;

            }

            $page_data["services"] = $finalresult;
            $this->load->view('admin/services_to_excel', $page_data);
        }

    }
    function services_to_xml()
    {
        if ($this->session->userdata('admin_login') != 1){
            redirect(base_url(), 'refresh');
        }else{
            $page_data['page_title'] = 'Services to XML';
            $page_data['page_name']  = 'services_to_xml';
            $total = $this->Admin_model->get_num_filas('service');
            $limit = 50;
            $start = 0;
            $finalresult = array();

            for($start; $start <= $total; $start += $limit){
                $result = $this->Admin_model->fetch_tabla('service',$limit,$start);
                if ($result != false)
                    foreach($result as $res)
                        $finalresult[] = $res;

            }

            $page_data["services"] = $finalresult;
            //$page_data["output"] = $output;
            $this->load->view('admin/services_to_xml', $page_data);
        }

    }


/*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup($operation = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $tablenames = $this->db->list_tables();
        $page_data['nservices'] = $this->Admin_model->service_get_num_filas(true);
        $page_data['nservicesforapproval'] = $this->Admin_model->service_get_num_filas(false);
        $page_data['nusers'] = $this->Admin_model->get_num_filas('account')+1;

        if ($operation == 'backup') {
            $type = $this->input->post('table');
            $this->Admin_model->create_backup($type);
        }
        if ($operation == 'restore') {
            //print_r($_FILES['userfile']['tmp_name']);
            $this->Admin_model->restore_backup();
            //$this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?Admin/backup_restore/', 'refresh');
        }


        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['tables'] = $tablenames;
        $page_data['page_title'] = 'Backup and Restore Data';
        $this->load->view('index', $page_data);
    }



      /*******LOGOUT FUNCTION *******/
    function logout()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url().'?Login' , 'refresh');
    }


     /***DEFAULT NOT FOUND PAGE*****/
    function four_zero_four()
    {
        $page_data['page_title'] = '404NotFound';
        $page_data['page_name']  = 'four_zero_four';
        $this->load->view('index',$page_data);
    }



}
