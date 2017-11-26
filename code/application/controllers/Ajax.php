<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('Crud_model');
        $this->load->library("pagination");
        //$this->load->library('encryption');
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    
    public function foo() {

        $this->send(array('foo' => 'bar'));
    }

    function changeCountdown($counter){ //change visible or hidden the password field
        if ($this->session->userdata('playername') == 'None'){
            redirect(base_url(), 'refresh');
        }else{
            $id = $this->session->userdata("idoa");
            $result = $this->Crud_model->oa_decrease_countdown_by_id($id);
               
            echo json_encode($result);
            //redirect(base_url().'?User/myservices', 'refresh');
        }
    }

    function updateHelp($tono = 1){
        $id = $this->session->userdata("idoa");
        $result = $this->Crud_model->oa_update_inc_help_tone_by_id($id,"help_tono".strval($tono));
        echo json_encode($result);
    }

    private function send($array) {

        if (!is_array($array)) return false;

        //$send = array('token' => $this->security->get_csrf_hash()) + $array;

        if (!headers_sent()) {
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: ' . date('r'));
            header('Content-type: application/json');
        }

        exit(json_encode($send, JSON_FORCE_OBJECT));
        //echo json_encode($send);

    }

}