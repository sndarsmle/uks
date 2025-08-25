<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Reservasi extends Middleware {

    function __construct(){
        parent::__construct();

        $this->load->model('M_Login', 'mLogin');
        $this->load->model('thakademik/M_Periode', 'mPeriode');
        $this->load->model('mcu/M_MCU', 'mMCU');
        $this->load->model('dcu/M_DCU', 'mDCU');
        $this->load->model('siswa/M_Siswa', 'mSiswa');
        $this->load->helper('kegiatan');
    }



    function index(){
        $kegiatan = $this->mPeriode->findByActive();
        $key = $this->input->get('key');

        //check if post method
        if ($this->input->post()) {
            $form = $this->input->post();

            $siswa = $this->mSiswa->findById($form['form_siswa']);
            $periode = $this->mPeriode->findById($form['form_periode']);

            //count student age
            $tglLahir = new DateTime($siswa->siswa_tgl_lahir);
            $tglPeriksa = new DateTime($form['form_tgl']);
            $umur = $tglPeriksa->diff($tglLahir);

            //add extra field to form
            $form['form_tahun'] = $umur->y;
            $form['form_bulan'] = $umur->m;
            $form['form_code'] = $periode->periode_name.'/'.str_replace("-", "",$form['form_tgl']).'/'.($this->mMCU->countRowByDate($form['form_tgl'])+1);

            //check type of checkup
            if($periode->periode_name == "DCU"){
                //should check before create
                if($this->mDCU->isExist($form)){
                    echo "Student Already Registered At This Check Up";
                }else{
                    //create DCU if not exist 
                    if ($this->mDCU->createRow($form)) {
                        $dcuID = $this->mDCU->getRowId($form);
                        redirect('dcu/step1/'.$dcuID);
                    }
                };
            }else if($periode->periode_name == "MCU" || $periode->periode_name == "SCR"){
                //should check before create
                if($this->mMCU->isExist($form)){
                    echo "Student Already Registered At This Check Up";
                }else{
                    //create MCU if not exist
                    if ($this->mMCU->createRow($form)) {
                        $mcuID = $this->mMCU->getRowId($form);
                        if($key == 44){
                            redirect('mcu/SMP/step1/'.$mcuID);
                        }elseif($key == 33){
                            redirect('mcu/SD/step1/'.$mcuID);
                        }elseif($key == 22){
                            redirect('mcu/dckbtk/step1/'.$mcuID);
                        } elseif ((int)$key === 55) {
                            redirect('mcu/SMA/step1/'.$mcuID);
                        }
                    }
                }
            }
        }else{
            //get the match title
            if($key == 44){
                $data['title'] = "Buat Daftar Tunggu UKS - SMP Teladan";
            }elseif($key == 33){
                $data['title'] = "Buat Daftar Tunggu UKS - SD Teladan";
            }elseif($key == 22){
                $data['title'] = "Buat Daftar Tunggu UKS - DCKBTK Teladan";
            } elseif ((int)$key === 55) {
                $data['title'] = "Buat Daftar Tunggu UKS - SMA Teladan";
            }

            $data['menu']  = 'D00';
            $data['smenu'] = '';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();
            $data['key'] = $key;
            $data['kegiatan'] = $kegiatan;
            $data['result'] = $this->session->flashdata('result');
            $this->blade->render('reservasi', $data);
            $this->session->set_flashdata('result',2);
        }

    }

    function proses($waitingID){
        $this->load->model('siswa/M_Siswa', 'mSiswa');
        $this->load->model('M_WaitingList', 'mWaitingList');

        //get extra data
        $waitingData = $this->mWaitingList->findById($waitingID);
        $siswa = $this->mSiswa->findById($waitingData->siswa_id);
        $jenjang = $siswa->siswa_jenjang;

        //redirect to match location
        if($waitingData->waiting_type == "DCU"){
            redirect('dcu/step1/'.$waitingID);
        }else if($waitingData->waiting_type == "MCU"){
            if($jenjang == 33){
                redirect('mcu/SD/step1/'.$waitingID);
            }else if($jenjang == 44){
                redirect('mcu/SMP/step1/'.$waitingID);
            } elseif((int)$jenjang === 55) {
                redirect('mcu/SMA/step1/'.$waitingID);
            } else{
                redirect('mcu/dckbtk/step1/'.$waitingID);   
            }
        }
    }
} 