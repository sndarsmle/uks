<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dcu extends Middleware {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Login', 'mLogin');
        $this->load->model('dcu/M_DCU', 'mDCU');
        $this->load->model('siswa/M_Siswa', 'mSiswa');
        $this->load->helper('jenjang');
    }

    function index(){

    }

    function step1Awal($dcuID){
        $dcu = $this->mDCU->findById($dcuID);
        $form = $this->input->post();
        if($form && $dcu){
            $data['siswa'] = $this->mSiswa->findById($dcu->siswa_id);
            $born_date = new DateTime($data['siswa']->siswa_tgl_lahir);
            $selected_date = new DateTime($form['form_tgl']);
            $interval_date = $born_date->diff($selected_date);

            $form['form_id'] = $dcuID;
            $form['form_periode'] = $dcu->periode_id;
            $form['form_siswa'] = $dcu->siswa_id;
            $form['form_lokasi'] = $dcu->dcu_location;
            $form['form_tahun'] = $interval_date->y;
            $form['form_bulan'] = $interval_date->m;
            $form['form_code'] = $dcu->dcu_code;

            $result = $this->mDCU->updateRow($form);
            if($result){
                redirect(base_url('dcu/step1/'.$dcuID));
            }
        }else{
            $data['title'] = "Step 1";
            $data['menu']  = 'MCU';
            $data['smenu'] = '';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();
            $data['dcu'] = $dcu;
            $data['siswa'] = $this->mSiswa->findById($dcu->siswa_id);
            $data['listdiagnose'] = $this->mDCUDiag->listOptionDiagnose();
            $data['diagnosis'] = $this->mDCUDiag->showByParentId($dcuID);
            $this->blade->render('dcu_step1', $data);
        }
    }

    function step1($dcuID){
        $this->load->model('dcu/M_DCUDiag', 'mDCUDiag');
        $dcu = $this->mDCU->findById($dcuID);

        $form = $this->input->post();
        if($form){
            $result = $this->mDCUDiag->createRow($form, $dcuID);
            if($result){
                redirect(base_url('dcu/step1/'.$dcuID));
            }
        }else{
            $data['title'] = "Step 1";
            $data['menu']  = 'MCU';
            $data['smenu'] = '';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();
            $data['dcu'] = $dcu;
            $data['siswa'] = $this->mSiswa->findById($dcu->siswa_id);
            $data['listdiagnose'] = $this->mDCUDiag->listOptionDiagnose();
            $data['diagnosis'] = $this->mDCUDiag->showByParentId($dcuID);
            $this->blade->render('dcu_step1', $data);
        }
    }

    function step2($dcuID){
        $this->load->model('dcu/M_DCUDetail', 'mDCUDetail');
        $dcu = $this->mDCU->findById($dcuID);

        $form = $this->input->post();
        $dcuDetail = $this->mDCUDetail->findByParentId($dcuID);

        if($form){
            $form['form_id'] = $dcuID;

            if(!$dcuDetail){
                $result = $this->mDCUDetail->createRow($form);
                if($result){
                    redirect(base_url('dcu/step2/'.$dcuID));
                }
            }else{
                $result = $this->mDCUDetail->updateRow($form);
                if($result){
                    redirect(base_url('dcu/step2/'.$dcuID));
                }
            }
        }else{
            if($dcuDetail){
                $data['dcuDetail'] = $dcuDetail;
            }else{
                $data['dcuDetail'] = (object) [
                    'dcu_id' => "",
                    'dcuDetail_oklusi' => "",
                    'dcuDetail_muklosa' => "",
                    'dcuDetail_d' => "",
                    'dcuDetail_m' => "",
                    'dcuDetail_f' => "",
                    'dcuDetail_freq_sikat' => "",
                    'dcuDetail_waktu_sikat' => "",
                    'dcuDetail_pasta' => "",
                    'dcuDetail_manis' => "",
                    'dcuDetail_di' => "",
                    'dcuDetail_di1' => "",
                    'dcuDetail_di2' => "",
                    'dcuDetail_di3' => "",
                    'dcuDetail_di4' => "",
                    'dcuDetail_di5' => "",
                    'dcuDetail_di6' => "",
                    'dcuDetail_ci' => "",
                    'dcuDetail_ci1' => "",
                    'dcuDetail_ci2' => "",
                    'dcuDetail_ci3' => "",
                    'dcuDetail_ci4' => "",
                    'dcuDetail_ci5' => "",
                    'dcuDetail_ci6' => "",
                    'dcuDetail_ohis' => "",
                    'dcuDetail_ohis_status' => "",
                    'dcuDetail_Kettambahan' => "",
                ];
            }

            $data['title'] = "Step 2";
            $data['menu']  = 'MCU';
            $data['smenu'] = '';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();
            $data['dcu'] = $dcu;
            $data['siswa'] = $this->mSiswa->findById($dcu->siswa_id);
            $this->blade->render('dcu_step2', $data);
        }
    }

    function step3($dcuID){
        $dcu = $this->mDCU->findById($dcuID);

        if ($this->input->post()) {
            $form['form_id'] = $dcuID;
            $form['form_admin'] = $this->mLogin->getUserID();

            if($this->mDCU->UpdateStatusFinish($form)){
                redirect("mcu");  
            }
        }else{
            $data['title'] = "Step 3";
            $data['menu']  = 'MCU';
            $data['smenu'] = '';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();
            $data['dcu'] = $dcu;
            $data['siswa'] = $this->mSiswa->findById($dcu->siswa_id);
            $this->blade->render('dcu_step3', $data);
        }
    }
}