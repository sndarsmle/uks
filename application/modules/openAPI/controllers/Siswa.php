<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends RestAPI {

	function __construct()
	{
        parent::__construct();
    }

    function index(){
        $this->methodGET()->withAPI();
        $form = $this->input->get();
        $isMissing = 0;

        if(isset($_GET['id']) && isset($_GET['type'])){
            $id = $form['id'];
            $type = $form['type'];
            if($id == "" || $type == ""){
                $isMissing = 1;
            }
        }else{
            $isMissing = 1;
        }

        if($isMissing == 1){
            $this->response(400, ['status' => 400,'message' => 'Bad request, missing some field']);
        }else{
            $this->load->model("siswa/M_Siswa", "mSiswa");
            $this->load->model("M_APIMCU", "mApiMCU");
            $this->load->model("M_APIDCU", "mApiDCU");
            $response['siswa'] = $this->mSiswa->findById($id);
            if($type == 0){
                $response['mcu'] = $this->mApiMCU->showByParentId($id);
            }else if($type == 1){
                $response['dcu'] = $this->mApiDCU->showByParentId($id);
            }
            $this->response(200, ['status' => 200,'message' => 'Success load data', 'data' => $response]);
        }
    }

    function showMCU(){
        $this->methodGET();
        $form = $this->input->get();
        $isMissing = 0;

        if(isset($_GET['key']) && isset($_GET['level']) && isset($_GET['num']) && isset($_GET['id'])){
            $id = $form['id'];
            $key = $form['key'];
            $level = $form['level'];
            $num = $form['num'];
            if($id == "" || $key == "" || $level == "" || $num == ""){
                $isMissing = 1;
            }
        }else{
            $isMissing = 1;
        }

        if($isMissing == 1){
            $this->response(400, ['status' => 400,'message' => 'Bad request, missing some field']);
        }else{
            $this->load->model("M_APIOTP", "mOTP");

            $otp = $this->mOTP->findByUnique($id, $key);
            if($otp){
                if($otp->otp_range <= 2){
                    $this->load->model("siswa/M_Siswa", "mSiswa");
                    $this->load->model("mcu/M_MCU", "mMCU");
                    $this->load->model("mcu/M_Grafik", "mGrafik");
                    $this->load->model("M_Dokter", "mDokter");
                    $this->load->model("M_IMT", "mIMT");

                    $data['title'] = "Laporan Medical Check Up";
                    $data['mcu'] = $this->mMCU->findById($num);
                    $data['siswa'] = $this->mSiswa->findByIdAndParentId($id, $data['mcu']->thnAkademik_id);

                    switch ($level) {
                        case 11:
                            $data['jenjang'] = "KB";
                            break;
                        case 22:
                            $data['jenjang'] = "TK";
                            break;
                        case 33:
                            $data['jenjang'] = "SD";
                            break;
                        case 44:
                            $data['jenjang'] = "SMP";
                            break;
                        default:
                            $data['jenjang'] = "";
                    }

                    $data['dokter'] = $this->mDokter->findById($data['mcu']->dokter_id);
                    $data['imt'] = $this->mIMT->findByUnique($data['mcu']->mcu_ageY, $data['mcu']->mcu_ageM, $data['siswa']->siswa_kelamin);

                    $header_grafik = ['Umur', 'Batas Bawah', 'IMT', 'Batas Atas'];
                    $data['grafik_data'] = [ $header_grafik ];

                    if ($level == "44") {
                        $this->load->model("mcuSMP/M_LainSMP", "mLain");
                        $this->load->model("mcuSMP/M_MatatelingaSMP", "mMataTelinga");
                        $this->load->model("mcuSMP/M_MulutSMP", "mMulut");
                        $this->load->model("mcuSMP/M_GiziSMP", "mGizi");

                        $data['grafik'] = $this->mGrafik->getGraphSMP($data['siswa']->siswa_id, $data['siswa']->siswa_kelamin);
                        $view_page = 'mcu/smp';
                    } elseif ($level == "33") {
                        $this->load->model("mcuSD/M_LainSD", "mLain");
                        $this->load->model("mcuSD/M_MatatelingaSD", "mMataTelinga");
                        $this->load->model("mcuSD/M_MulutSD", "mMulut");
                        $this->load->model("mcuSD/M_GiziSD", "mGizi");

                        $data['grafik'] = $this->mGrafik->getGraphSD($data['siswa']->siswa_id, $data['siswa']->siswa_kelamin);
                        $view_page = 'mcu/sd';
                    } elseif (($level == "22") || ($level == "11")) {
                        $this->load->model("mcuDCKBTK/M_LainDckbtk", "mLain");
                        $this->load->model("mcuDCKBTK/M_MatatelingaDckbtk", "mMataTelinga");
                        $this->load->model("mcuDCKBTK/M_MulutDckbtk", "mMulut");
                        $this->load->model("mcuDCKBTK/M_GiziDckbtk", "mGizi");

                        $data['grafik'] = $this->mGrafik->getGraphDCKBTK($data['siswa']->siswa_id, $data['siswa']->siswa_kelamin);
                        $view_page = 'mcu/dckbtk';
                    }

                    $data['lain'] = $this->mLain->findByParentId($num);
                    $data['matatelinga'] = $this->mMataTelinga->findByParentId($num);
                    $data['mulut'] = $this->mMulut->findByParentId($num);
                    $data['gizi'] = $this->mGizi->findByParentId($num);
                    $count = count($data['grafik']);
                    $limit = 6 - $count;
                    $data['grafikP'] = $this->mIMT->getIMTPrediction($data['mcu']->mcu_ageY, $data['mcu']->mcu_ageM, $data['siswa']->siswa_kelamin, $limit);

                    foreach ($data['grafik'] as $value) {
                        $umur = "{$value->tahun_usia}/{$value->bulan_usia}";
                        array_push($data['grafik_data'], [ $umur, $value->batas_bawah, $value->imt, $value->batas_atas ]);
                    }

                    foreach ($data['grafikP'] as $value) {
                        $umur = "{$value->tahun_usia}/{$value->bulan_usia}";
                        array_push($data['grafik_data'], [ $umur, $value->batas_bawah, null, $value->batas_atas ]);
                    }

                    $this->blade->render($view_page, $data);
                }else{
                    $this->response(400, ['status' => 400,'message' => 'Bad request']);
                }
            }else{
                $this->response(400, ['status' => 400,'message' => 'Bad request']);
            }
        }
    }

    function showDCU(){
        $this->methodGET();
        $form = $this->input->get();
        $isMissing = 0;

        if(isset($_GET['key']) && isset($_GET['num']) && isset($_GET['id'])){
            $id = $form['id'];
            $key = $form['key'];
            $num = $form['num'];
            if($id == "" || $key == "" || $num == ""){
                $isMissing = 1;
            }
        }else{
            $isMissing = 1;
        }

        if($isMissing == 1){
            $this->response(400, ['status' => 400,'message' => 'Bad request, missing some field']);
        }else{
            $this->load->model("M_APIOTP", "mOTP");

            $otp = $this->mOTP->findByUnique($id, $key);
            if($otp){
                if($otp->otp_range <= 2){
                    $this->load->model("siswa/M_Siswa", "mSiswa");
                    $this->load->model("dcu/M_DCU", "mDCU");
                    $this->load->model("dcu/M_DCUDetail", "mDCUDetail");
                    $this->load->model("dcu/M_DCUDiag", "mDCUDiag");
                    $this->load->model("M_Dokter", "mDokter");

                    $dcu = $this->mDCU->findById($num);
                    $siswa = $this->mSiswa->findByIdAndParentId($id, $dcu->thnAkademik_id);
                    $data['title'] = "Laporan Dental Check Up";
                    $data['dcu'] = $dcu;
                    $data['siswa'] = $siswa;
                    $data['detail']    = $this->mDCUDetail->findByParentId($num);
                    $data['diagnose']   = $this->mDCUDiag->showByParentId($num);
                    $data['dokter'] = $this->mDokter->findById($dcu->dokter_id);
                    $this->blade->render('dcu/index', $data);
                }else{
                    $this->response(400, ['status' => 400,'message' => 'Bad request']);
                }
            }else{
                $this->response(400, ['status' => 400,'message' => 'Bad request']);
            }
        }
    }
}