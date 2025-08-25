<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends MY_Controller {

    function __construct()
    {
        parent::__construct();  
        $this->load->model('M_Divisi', 'mDivisi');
    }

    function index(){
        if($this->input->post()){
            redirect(base_url('client/dashboard/'.$this->input->post('form_karyawan')));
        }else{
            $data['title'] = "Skrining Sekolah Teladan";
            $data['divisi'] = $this->mDivisi->showAll();
            $this->blade->render('client', $data);
        }
    }
}