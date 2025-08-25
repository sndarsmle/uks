<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Followup extends Middleware {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Login', 'mLogin');
        $this->load->model('followup/M_ListFollowUp', 'mListFollowUp');
        $this->load->model('followup/M_FollowUp', 'mFollowUp');
        $this->load->model('followup/M_FollowUpDetail', 'mFollowUpDetail');
    }

    function index(){
        $post = $this->input->post();
        if($post){
            if (isset($post['withFileCheck']) && $post['withFileCheck'] == 1) {
                $post['form_url'] = '-';
                $result = $this->mFollowUp->createRow($post);
                if($result){
                    $followUpID = $this->mFollowUp->getRowId($post);
                    redirect(base_url('wali/followup/detail/'.$followUpID));
                }
            } else {
                echo var_dump($post);
                $ekstensi_diperbolehkan	= array('pdf','jpg', 'jpeg');
                $nama = $_FILES['file']['name'];
                $x = explode('.', $nama);
                $ekstensi = strtolower(end($x));
                $ukuran	= $_FILES['file']['size'];
                $file_tmp = $_FILES['file']['tmp_name'];
                if(in_array($ekstensi, $ekstensi_diperbolehkan) == true){
                    if($ukuran < 5044070){
                        if(!move_uploaded_file($file_tmp, 'rujukan/'.$post['form_id'].'.'.$ekstensi)){
                            print_r($_FILES);
                        }else{
                            $post['form_url'] = 'rujukan/'.$post['form_id'].'.'.$ekstensi;
                            $result = $this->mFollowUp->createRow($post);
                            if($result){
                                $followUpID = $this->mFollowUp->getRowId($post);
                                redirect(base_url('wali/followup/detail/'.$followUpID));
                            }
                        }
                    }else{
                        echo 'UKURAN FILE TERLALU BESAR';
                    }
                }
            }
        }else{
            $class = $this->mLogin->getUserClass();
            $data['title'] = "Follow Up / Rujukan Pemeriksaan";
            $data['menu']  = 'FLP';
            $data['smenu'] = '';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();
            $data['class'] = $class;
            $data['followup'] = $this->mListFollowUp->showByClass($class);
            $this->blade->render('rujukan/followup', $data);
        }
    } 

    function detail($followup_id)
    {
        if($this->input->post()){
            if($this->input->post()['typeSubmit'] == 'insert') {
                $message = setMessage($this->mFollowUpDetail->insert($this->input->post()), "Menambahkan");
                $this->session->set_flashdata('message', $message['message']);
                redirect(base_url('wali/followup/detail/'.$followup_id));
            }
            else if($this->input->post()['typeSubmit'] == 'update') {
                $message = setMessage($this->mFollowUpDetail->update($this->input->post()), "Mengubah");
                $this->session->set_flashdata('message', $message['message']);
                redirect(base_url('wali/followup/detail/'.$followup_id));
            }
            else if($this->input->post()['typeSubmit'] == 'delete') {
                $message = setMessage($this->mFollowUpDetail->delete($this->input->post()), "Menghapus");
                $this->session->set_flashdata('message', $message['message']);
                redirect(base_url('wali/followup/detail/'.$followup_id));
            }
        } else {
            $class = $this->mLogin->getUserClass();
            $data['title'] = "Detail Follow Up / Rujukan Pemeriksaan";
            $data['menu']  = 'FLP';
            $data['smenu'] = '';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();
            $data['class'] = $class;
            $data['followup'] = $this->mFollowUp->get($followup_id);
            $data['followup_detail'] = $this->mFollowUpDetail->getAll($followup_id);
            $this->blade->render('rujukan/detail', $data);
        }
    }
} 