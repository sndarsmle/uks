<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dckbtk extends Middleware {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Login', 'mLogin');
        $this->load->model('mcu/M_MCU', 'mMCU');
        $this->load->model('M_Uks', 'mUKS');
        $this->load->model('siswa/M_Siswa', 'mSiswa');
    }

    function step1($mcuID){ //Gizi
        
        $this->load->helper('jenjang');
        $this->load->model('mcuDCKBTK/M_GiziDckbtk', 'mGiziDckbtk');
        $role = $this->mLogin->getUserRole();
        $mcuData = $this->mMCU->findById($mcuID);
        $giziData = $this->mGiziDckbtk->findByParentID($mcuData->mcu_id);

        if($this->input->post()){
            $form = $this->input->post();
            $form['form_id'] = $mcuData->mcu_id;

            if($giziData) {
                $this->mGiziDckbtk->updateRow($form);
            } else {
                $this->mGiziDckbtk->createRow($form);
            }

            if (isset($form['form_tgl']) && $mcuData) {
                $data['siswa'] = $this->mSiswa->findById($mcuData->siswa_id);
                $born_date = new DateTime($data['siswa']->siswa_tgl_lahir);
                $selected_date = new DateTime($form['form_tgl']);
                $interval_date = $born_date->diff($selected_date);

                $form['form_periode'] = $mcuData->periode_id;
                $form['form_siswa'] = $mcuData->siswa_id;
                $form['form_lokasi'] = $mcuData->mcu_location;
                $form['form_tahun'] = $interval_date->y;
                $form['form_bulan'] = $interval_date->m;
                $form['form_code'] = $mcuData->mcu_code;

                $this->mMCU->updateRow($form);
            }

            if($role == 2) {
                redirect("mcu/reservasi?key=22");
            } else {
                redirect("mcu/dckbtk/step2/".$mcuData->mcu_id);
            }
        }else{
            $data['title'] = "Step 1";
            $data['menu']  = 'MCU DC KB TK';
            $data['smenu'] = '';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();
            $data['siswa'] = $this->mSiswa->findById($mcuData->siswa_id);
            $data['mcu'] = $mcuData;
            $mcuData = $this->mMCU->findById($mcuID);    
            $data['mcu'] = $mcuData;
            $jk                 = $data['siswa']->siswa_kelamin;
            if ($jk=="L") 
            {
                $data ['imtdbb']       = $this->mUKS->getIMTLaki();
            }
             else 
            {
                $data ['imtdbb']       = $this->mUKS->getIMTPerempuan();
            }

            if($giziData){
                $data['gizi'] = $giziData;
            }else{
                $data['gizi'] = (object) [
                    'bb' => '',
                    'tb' => '',
                    'lk' => '',
                    'lla' => '',
                    'lp' => '',
                    'pimt' => '',
                    'status_gizi' => '',
                    'bbperu' => '',
                    'anemia' => '',
                ];
            }
            //var_dump($data['imtdbb']);
            //var_dump($data['siswa']);
            $this->blade->render('dckbtk/mcu_step1', $data);
        }


    }

    function step2($mcuID){ //Umum
        $this->load->helper('jenjang');
        $this->load->model('mcuDCKBTK/M_UmumDckbtk', 'mUmumDckbtk');

        $mcuData = $this->mMCU->findById($mcuID);
        $umumData = $this->mUmumDckbtk->findByParentID($mcuData->mcu_id);

        if($this->input->post()){
            $form = $this->input->post();
            $form['form_id'] = $mcuData->mcu_id;

            if($umumData){
                if($this->mUmumDckbtk->updateRow($form)) {
                    redirect("mcu/dckbtk/step3/".$mcuData->mcu_id);
                }
            }else{
                if($this->mUmumDckbtk->createRow($form)) {
                    redirect("mcu/dckbtk/step3/".$mcuData->mcu_id);
                }
            }
        }else{
            $data['title'] = "Step 2";
            $data['menu']  = 'MCU';
            $data['smenu'] = '';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();
            $data['siswa'] = $this->mSiswa->findById($mcuData->siswa_id);
            $data['mcu'] = $mcuData;
            $mcuData = $this->mMCU->findById($mcuID);    
            $data['mcu'] = $mcuData;
            

            if($umumData){
                $data['umum'] = $umumData;
            }else{
                $data['umum'] = (object) [
                    'mata' => '',
                    'ket_mata' => '',
                    'hidung' => '',
                    'ket_hidung' => '',
                    'rongga_mulut' => '',
                    'ket_rongga_mulut' => '',
                    'jantung' => '',
                    'ket_jantung' => '',
                    'paru' => '',
                    'ket_paru' => '',
                    'neurologi' => '',
                    'rambut' => '',
                    'ket_rambut' => '',
                    'kulit' => '',
                    'ket_kulit' => '',
                    'kuku' => '',
                    'ket_kuku' => '',
                ];
            }
            //var_dump($data['imtdbb']);
            //var_dump($data['siswa']);
            $this->blade->render('dckbtk/mcu_step2', $data);
        }



        
    }
    function step3($mcuID){ //gigi dan mulut
        $this->load->helper('jenjang');
        $this->load->model('mcuDCKBTK/M_MulutDckbtk', 'mMulutDckbtk');

        $mcuData = $this->mMCU->findById($mcuID);
        $mulutData = $this->mMulutDckbtk->findByParentID($mcuData->mcu_id);

        if($this->input->post()){
            $form = $this->input->post();
            $form['form_id'] = $mcuData->mcu_id;

            if($mulutData){
                if($this->mMulutDckbtk->updateRow($form)) {
                    redirect("mcu/dckbtk/step4/".$mcuData->mcu_id);
                    
                }
            }else{
                if($this->mMulutDckbtk->createRow($form)) {
                    redirect("mcu/dckbtk/step4/".$mcuData->mcu_id);
                }
            }
        }else{
            $data['title'] = "Step 3";
            $data['menu']  = 'MCU';
            $data['smenu'] = '';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();
            $data['siswa'] = $this->mSiswa->findById($mcuData->siswa_id);
            $data['mcu'] = $mcuData;
            $mcuData = $this->mMCU->findById($mcuID);    
            $data['mcu'] = $mcuData;
            

            if($mulutData){
                $data['mulut'] = $mulutData;
            }else{
                $data['mulut'] = (object) [
            'bibir' => '',
            'sudut_mulut' => '',
            'sariawan' => '',
            'lidah' => '',
            'luka_lain' => '',
            'ket_masalah_lain_rongga_mulut' => '',
            'caries' => '',
            'ket_caries' => '',
            'gigi_dep' => '',
            'ket_masalah_lain_gigi_gusi' => '',
                    
                    
                ];
            }
            //var_dump($data['imtdbb']);
            //var_dump($data['siswa']);
            $this->blade->render('dckbtk/mcu_step3', $data);
        }



        
    }
    function step4($mcuID){ //Mata dan telinga
        $this->load->helper('jenjang');
        $this->load->model('mcuDCKBTK/M_MatatelingaDckbtk', 'mMataDckbtk');

        $mcuData = $this->mMCU->findById($mcuID);
        $mataData = $this->mMataDckbtk->findByParentID($mcuData->mcu_id);

        if($this->input->post()){
            $form = $this->input->post();
            $form['form_id'] = $mcuData->mcu_id;

            if($mataData){
                if($this->mMataDckbtk->updateRow($form)) {
                    redirect("mcu/dckbtk/step5/".$mcuData->mcu_id);
                }
            }else{
                if($this->mMataDckbtk->createRow($form)) {
                    redirect("mcu/dckbtk/step5/".$mcuData->mcu_id);
                }
            }
        }else{
            $data['title'] = "Step 4";
            $data['menu']  = 'MCU';
            $data['smenu'] = '';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();
            $data['siswa'] = $this->mSiswa->findById($mcuData->siswa_id);
            $data['mcu'] = $mcuData;
            $mcuData = $this->mMCU->findById($mcuID);    
            $data['mcu'] = $mcuData;
            

            if($mataData){
                $data['matatelinga'] = $mataData;
            }else{
                $data['matatelinga'] = (object) [
                    'mata_luar' => '',
                    'ket_mata_luar' => '',
                    'penglihatan' => '',
                    'ket_penglihatan' =>'',
                    'kacamata' => '',
                    'ket_kacamata' => '',
                    'inf_mata' => '',
                    'ket_inf_mata' => '',
                    'ket_masalah_lain_penglihatan' => '',
                    'telinga' => '',
                    'ket_telinga' => '',
                    'kot_telinga' => '',
                    'ket_kot_telinga' =>'',
                    'inf_telinga' => '',
                    'ket_inf_telinga' => '',
                    'tajam_pendengaran' => '',
                    'ket_tajam_pendengaran' => '',
                    'ket_masalah_lain_pendengaran' => '',
                ];
            }
            //var_dump($data['imtdbb']);
            //var_dump($data['siswa']);
            $this->blade->render('dckbtk/mcu_step4', $data);
        }



        
    }
    function step5($mcuID){ //Lainnya
        $this->load->helper('jenjang');
        $this->load->model('mcuDCKBTK/M_LainDckbtk', 'mLain');

        $role = $this->mLogin->getUserRole();
        $mcuData = $this->mMCU->findById($mcuID);
        $lainData = $this->mLain->findByParentID($mcuData->mcu_id);

        if($this->input->post()){
            $form = $this->input->post();
            $form['form_id'] = $mcuData->mcu_id;

            if($lainData){
                if($this->mLain->updateRow($form)) {
                    if($role == 3){
                        redirect("mcu/dckbtk/evaluasi/".$mcuData->mcu_id);
                    }else{
                        redirect("mcu/dckbtk/step5/".$mcuData->mcu_id);
                    }
                }
            }else{
                if($this->mLain->createRow($form)) {
                    if($role == 3){
                        redirect("mcu/dckbtk/evaluasi/".$mcuData->mcu_id);
                    }else{
                        redirect("mcu/dckbtk/step5/".$mcuData->mcu_id);
                    }
                }
            }
        }else{
            $data['title'] = "Step 5";
            $data['menu']  = 'MCU';
            $data['smenu'] = '';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();
            $data['siswa'] = $this->mSiswa->findById($mcuData->siswa_id);
            //$data['mcu'] = $mcuData;
            $mcuData = $this->mMCU->findById($mcuID);    
            $data['mcu'] = $mcuData;


            if($lainData){
                $data['lain'] = $lainData;
            }else{
                $data['lain'] = (object) [
                    'mental' => '',
                    'saran' => '',
                    'kesimpulan' => '',
                    'followup' => '',
                                      
                    
                ];
            }

            $this->blade->render('dckbtk/mcu_step5', $data);
            //var_dump($data);
        }

        
    }
    function evaluasi($mcuID)
    {
       
        $this->load->helper('jenjang');
        $this->load->helper('date');
        $mcuData = $this->mMCU->findByIdAllDataDckbtk($mcuID);
        //$lainData = $this->mLain->findByParentID($mcuData->mcu_id);

        if($this->input->post()){
            // $form = $this->input->post();
            $form['form_id'] = $mcuData->mcu_id;
            $form['form_admin'] = $this->mLogin->getUserID();
            {
                $this->mMCU->UpdateStatusFinish($form);
                //$this->mLain->updateRow($form); 
                redirect("mcu");  
            }
        }else{
        $data['title'] = "Evaluasi";
        $data['menu']  = 'MCU';
        $data['smenu'] = '';
        $data['user']  = $this->mLogin->getNameUser();
        $data['role']  = $this->mLogin->getUserRole();
        $data['siswa'] = $this->mSiswa->findById($mcuData->siswa_id);
        $data['mcu'] = $mcuData;
        $this->blade->render('dckbtk/mcu_evaluasi', $data);
        }     
        
    }

}
