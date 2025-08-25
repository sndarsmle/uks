<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vip extends Middleware {

    function __construct(){
        parent::__construct();
        $this->load->model('M_APIControl', 'mControl');
    }

    function index(){
        $post = $this->input->post();
        if ($post) {
            $Form = $this->input->post();
            if($this->mControl->createRow($Form)){
                redirect(base_url('vip'));
            }
        }else{
            $data['title'] = "Manajemen API";
            $data['menu'] = 'VIP';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();
            $data['api'] = $this->mControl->showAll();
            $this->blade->render('vip', $data);
        }
    }

    function detail($clientID){
        $post = $this->input->post();
        if($post) {
            $result = $this->mControl->updateRow($post, $clientID);
            if($result){
                redirect(base_url('vip/detail/'.$clientID));
            }
        }else{
            $api = $this->mControl->findById($clientID);
            $data['title'] = "Open API SIA Sekolah Teladan Yogyakarta";
            $data['menu'] = 'VIP';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();
            $data['api'] = $api;
            $this->blade->render('vip_detail',$data);
        }
    }

}