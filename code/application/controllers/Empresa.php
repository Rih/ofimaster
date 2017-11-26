<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Empresa extends CI_Controller
{






    function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('Crud_model');
        $this->load->model('Empresa_model');
        $this->load->library("pagination");
        //$this->load->library('encryption');
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    /***default functin, redirects to login page if no admin logged in yet***/


    public function index()
    {
        if ($this->session->userdata('user_login') != 1)
            redirect(base_url() . '?Login', 'refresh');
        if ($this->session->userdata('user_login') == 1){
            $usertype = $this->session->userdata('login_type');
            redirect(base_url() . '?'.$usertype.'/dashboard', 'refresh');
        }
    }


    function dashboard()
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);
            $order_by = "DESC";
            $page_data["ultimos_catalogos"] = $this->Generic_model->catalog_get_all($order_by);
            $page_data["catalogos_descargados"] = $this->Generic_model->log_catalog_get_all($order_by,$idAcc);
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'dashboard','Dashboard');
            $this->load->view('index', $page_data);

        }


    }


    function misdatos($action = "none",$mode = "none") //upd emp = empresa o rep = representante
    {
        if ($this->session->userdata('user_login') != 1){
            redirect(base_url(), 'refresh');
        }
        else{

            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);

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

                $result = $this->Empresa_model->empresa_update_by_id($idAcc,$data);
                $msg_result = ($result== true)?SUCCESS_MSG_UPD:ERR_MSG_UPD;
                $return = array("msg" => $msg_result);
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
                $return = array("msg" => $msg_result);
                echo json_encode($return);

            }
            if($action=="none"){// default
                $limit = 10;
                $page_data['mis_datos'] = $this->Empresa_model->fetch_tabla_empresa($idAcc,$limit, 0);
                $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,'misdatos','Mis Datos');
                $this->load->view('index', $page_data);
            }


        }


    }


     /*
    * ARCHIVOS
    */

      function catalogos($action="upload", $id = 0)
    {
        if ($this->session->userdata('user_login') != 1 || $this->session->userdata('enabled') != 1){
            redirect(base_url(), 'refresh');
        }
        else{
            $tbls = json_decode(_TABLES);
            $tbl = json_decode(_TABLE, true);


            $page_data = array();
            $idAcc = $this->session->userdata('userid');
            $usrtype = $this->session->userdata('login_type');
            $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);
            $tableName = $tbl["familia"]["name"];
            $view = "catalogos"; $viewTitle = "Ver Catalogos";

            $page_data["familias"] = $this->Generic_model->fetch_tabla($tbl["familia"]["name"]);
            $page_data["categorias"] = $this->Generic_model->fetch_tabla($tbl["categoria"]["name"]);



            $order_by = "none";
            $page_data["result"] = $this->Generic_model->catalog_get_all($order_by);
            $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,$view, $viewTitle);

            $this->load->view('index', $page_data);

        }


    }

    function catalogoss($action="upload", $id = 0)
  {
      if ($this->session->userdata('user_login') != 1 || $this->session->userdata('enabled') != 1){
          redirect(base_url(), 'refresh');
      }
      else{
          $tbls = json_decode(_TABLES);
          $tbl = json_decode(_TABLE, true);


          $page_data = array();
          $idAcc = $this->session->userdata('userid');
          $usrtype = $this->session->userdata('login_type');
          $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);
          $tableName = $tbl["familia"]["name"];
          $view = "catalogoss"; $viewTitle = "Ver Catalogos";

          $page_data["familias"] = $this->Generic_model->fetch_tabla($tbl["familia"]["name"]);
          $page_data["categorias"] = $this->Generic_model->fetch_tabla($tbl["categoria"]["name"]);


          $order_by = "none";
          $page_data["result"] = $this->Generic_model->catalog_get_all($order_by);
          $page_data += $this->Generic_model->fillPageDataCounters($usrtype,$idUserType,$page_data,$view, $viewTitle);

          $this->load->view('index', $page_data);

      }


  }
     function download($idcategoria, $idcatalogo = 0, $extension = "pdf")
    {
        $tbls = json_decode(_TABLES);
        $tbl = json_decode(_TABLE, true);
        //actualizar num descarga
        $idAcc = $this->session->userdata('userid');
        $usrtype = $this->session->userdata('login_type');
        $file_name = $this->Generic_model->get_field_by_id($tbl["categoria"]["name"],$idcategoria,"name")->name;
        //$name = "uploads/".$path;
        //force_download($name, NULL);
        //load the download helper
        //$this->load->helper('download');
        //Get the file from whatever the user uploaded (NOTE: Users needs to upload first), @See http://localhost/CI/index.php/upload
        //$data = file_get_contents("uploads/".$file_name.".".$extension);

        if ($file_name != ""){
          $datos = array("idaccount" => $idAcc, "idcatalog" => $idcatalogo);
          $this->Generic_model->table_insert($tbl["log_catalogo"]["name"], $datos);
          $data_return = array("filename" => $file_name.".".$extension, "path" => base_url()."uploads/".$file_name.".".$extension,"msg" => "200");
          //$data_return = array("filename" => $file_name.".pdf", "path" => "http://www.ofimaster.cl/static/003-quimicosdeaseo.pdf","msg" => "200");

        }
        else
        {
          $data_return = array("filename" => "", "path" =>"#","msg" => "-1");
        }

      //  header();
        echo json_encode($data_return);
        //Read the file's contents
        //$name = 'niceupload.pdf';
        //$name = $file_name.".".$extension;
        //force_download($name, $data);


    }

    function download_name()
    {
        $tbls = json_decode(_TABLES);
        $tbl = json_decode(_TABLE, true);
        //actualizar num descarga
        $idAcc = $this->session->userdata('userid');

        $idcategoria = $this->input->post('name');
        $file_name = $this->Generic_model->get_field_by_id($tbl["categoria"]["name"],$idcategoria,"name")->name;
        $file_ext = $this->input->post('extension');
        //$name = "uploads/".$path;
        //force_download($name, NULL);
        //load the download helper
        $this->load->helper('download');
        //Get the file from whatever the user uploaded (NOTE: Users needs to upload first), @See http://localhost/CI/index.php/upload
        $data = file_get_contents("uploads/".$file_name.".".$file_ext);
        if ($file_name != ""){

          $idcatalogo = $this->Generic_model->get_id_by_field($tbl["catalogo"]["name"],"idcategory_fk ",$idcategoria)->idcatalog;
          print_r($idcatalogo);
          $datos = array("idaccount" => $idAcc, "idcatalog" => $idcatalogo);
          $this->Generic_model->table_insert($tbl["log_catalogo"]["name"], $datos);
        }
        //Read the file's contents
        //$name = 'niceupload.pdf';
        $name = $file_name.".".$file_ext;
        force_download($name, $data);


    }


    function get_distancia($idcity1, $idcity2){

        $distancia = $this->Generic_model->get_distancia_ciudades(intval($idcity1),intval($idcity2));
        $data = array("distancia" => $distancia);
        echo json_encode($data);
    }

    function actualizaMatchs(){
         $idAcc = $this->session->userdata('userid');
        $usrtype = $this->session->userdata('login_type');
        $idUserType = $this->Account_model->account_get_id_by_type($idAcc,$usrtype);

        $resultado = $this->Engine_model->match_ofertas($usrtype,$idUserType); //incluye los match nuevos si no existe los crea.
        $data = $resultado;
        echo json_encode($data);
    }



      /*******LOGOUT FUNCTION *******/
    function logout()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url().'?Login' , 'refresh');
    }

}
