<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dental extends Middleware {

    function __construct()
    {
        parent::__construct();
        $this->load->model('dcu/M_DCU', 'mDCU');
        $this->load->model('dcu/M_DCUDiag', 'mDCUDiag');
        $this->load->model('M_Jadwal', 'mJadwal');
    }

    function index(){
        $data['title'] = "Data Dental Checkup";
        $data['menu']  = '-';
        $data['smenu'] = '-';
        $data['summary'] = $this->mDCU->showAll();
        $this->blade->render('dental', $data);
    }

    function detail($jadwalID){
        $jadwal = $this->mJadwal->findById($jadwalID);
        $data['title'] = "Data Dental Checkup - ".$jadwal->periode_mcu;
        $data['menu']  = 'DCU1';
        $data['smenu'] = 'DCU1';
        $data['dental'] = $this->mDCU->showByParentId($jadwalID);
        $this->blade->render('dental_detail', $data);
    }

    function detailDCU($dcuID){

    }

    function cariSiswa(){
        if($this->input->post()){
            redirect(base_url('dental/rekamDCU/'.$this->input->post('form_siswa')));
        }else{
            $data['title'] = "Dental Checkup";
            $data['menu']  = '-';
            $data['smenu'] = '-';
            $this->blade->render('dental_search', $data);
        }
    }

    function rekamDCU($siswaID){
        $this->load->model('siswa/M_Siswa', 'mSiswa');
        if($this->input->post()){
            $formGigi = $this->input->post('form_gigi');
            $formDiag = $this->input->post('form_diag');
            $formKet = $this->input->post('form_ket');
            $form = $this->input->post();
            foreach($formGigi as $i => $gigi){
                $Diagnosis[$i]['form_gigi'] = $gigi;
                $Diagnosis[$i]['form_diag'] = $formDiag[$i];
                $Diagnosis[$i]['form_ket'] = $formKet[$i];
                $i++;
            }
            $form['form_siswa'] = $siswaID;
            if($this->mDCU->createRow($form)){
                $dcuID = $this->mDCU->getID($form)->dcu_id;
                foreach ($Diagnosis as $diag) {
                    $this->mDCUDiag->createRow($diag, $dcuID);
                }
                redirect(base_url('dental/cariSiswa'));
            }
        }else{
            $data['title'] = "Dental Checkup";
            $data['menu']  = 'DCU';
            $data['smenu'] = 'DCU';
            $data['periode'] = $this->mJadwal->showAll();
            $data['siswa'] = $this->mSiswa->findById($siswaID);
            $this->blade->render('dental_rekam', $data);  
        }
    }
}