<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetakdoc extends Middleware {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Login', 'mLogin');
        $this->load->model('mcu/M_MCU', 'mMCU');
        $this->load->model('siswa/M_Siswa', 'mSiswa');
        $this->load->model('cetak/M_CetakMcu', 'mCMcu');
        $this->load->model('cetak/M_CetakDcu', 'mCDcu');
        $this->load->model('M_Dokter', 'mDokter');
        $this->load->model('M_Uks', 'mUKS');
        $this->load->model('M_Cetak', 'mCetak');
    }

    function index(){
        $data['title'] = "Daftar Tunggu Medical Check Up";
        $data['menu']  = 'MCU';
        $data['smenu'] = '';
        $data['user']  = $this->mLogin->getNameUser();
        $data['role']  = $this->mLogin->getUserRole();
        $data['daftarTunggu'] = $this->mMCU->showNotActiveRow();
        $this->blade->render('mcu', $data);
    } 

    function proses($mcuID){
        $this->load->model('siswa/M_Siswa', 'mSiswa');
        $mcuData = $this->mMCU->findById($mcuID);

        $siswa = $this->mSiswa->findById($mcuData->siswa_id);
        $jenjang = $siswa->siswa_jenjang;
        if($jenjang == 33){
            redirect('mcu/SD/step1/'.$mcuID);
        }else if($jenjang == 44){
            redirect('mcu/SMP/step1/'.$mcuID);
        }else if($jenjang == 55){
            redirect('mcu/SMA/step1/'.$mcuID);
        }else{
            redirect('mcu/dckbtk/step1/'.$mcuID);   
        }
    }
    function Kunjungan()
    {

      
            # code...
        $data['title']      = "Cetak Laporan Kunjungan UKS Bulanan";
        $data['menu']       = 'CMCU';
        $data['smenu']      = '';
        
        $data['content']    = $this->mCetak->getKunjunganMonthly();
        //var_dump($data['content']);      
        $this->blade->render('kunjunganbulanan',$data);
        // $this->blade->render('skreening', $data);
        // $this->blade->render('skreening', $data);
        

   }
    function cariSIswaMcu()
   {

            $data['title'] = "Pilih Nama yang akan dicetak";
            $data['menu']  = 'Cetak MCU';
            $data['smenu'] = '';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();

        //$data['content'] = $this->mUKS->getAllBasicSiswa();
       //var_dump($data);
        $this->blade->render('pnmcu', $data);

   }
   function pdmcu()
   {
        $data['title'] = "Pilih data yang akan dicetak";
        $data['menu']  = 'Cetak MCU';
        $data['smenu'] = '';
        $data['user']  = $this->mLogin->getNameUser();
        $data['role']  = $this->mLogin->getUserRole();
        $idsiswa            = $this->input->post('siswa');
        $siswa_jenjang =    $this->input->post('jenjang');
        
        $data['nama']       = $this->mCMcu->getNama($idsiswa); 
        $data['jadwal']    = $this->mCMcu->getdatemcu($idsiswa);       
        $this->blade->render('pdmcu',$data);
        
    }

    function precetakmcu($mcu_id)
    {
        $this->load->model("siswa/M_Siswa", "mSiswa");
        $this->load->model("mcu/M_MCU", "mMCU");
        $this->load->model("mcu/M_Grafik", "mGrafik");
        $this->load->model("M_Dokter", "mDokter");
        $this->load->model("M_IMT", "mIMT");

        $data['title'] = "Pracetak Medical Check Up";
        $data['menu']  = 'Cetak MCU';
        $data['smenu'] = '';

        $data['mcu'] = $this->mMCU->findById($mcu_id);
        $data['siswa'] = $this->mSiswa->findByIdAndParentId($data['mcu']->siswa_id, $data['mcu']->thnAkademik_id);

        switch ($data['siswa']->siswa_jenjang) {
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
            case 55:
                $data['jenjang'] = "SMA";
                break;
            default:
                $data['jenjang'] = "";
        }

        $data['dokter'] = $this->mDokter->findById($data['mcu']->dokter_id);
        $data['imt'] = $this->mIMT->findByUnique($data['mcu']->mcu_ageY, $data['mcu']->mcu_ageM, $data['siswa']->siswa_kelamin);

        $header_grafik = ['Umur', 'Batas Bawah', 'IMT', 'Batas Atas'];
        $data['grafik_data'] = [ $header_grafik ];

        if ($data['siswa']->siswa_jenjang == "44") {
            $this->load->model("mcuSMP/M_LainSMP", "mLain");
            $this->load->model("mcuSMP/M_MatatelingaSMP", "mMataTelinga");
            $this->load->model("mcuSMP/M_MulutSMP", "mMulut");
            $this->load->model("mcuSMP/M_GiziSMP", "mGizi");

            $data['grafik'] = $this->mGrafik->getGraphSMP($data['siswa']->siswa_id, $data['siswa']->siswa_kelamin);
            $view_page = 'pracetakmcusmp';
        } elseif ($data['siswa']->siswa_jenjang == "55") {
            $this->load->model("mcuSMA/M_LainSMA", "mLain");
            $this->load->model("mcuSMA/M_MatatelingaSMA", "mMataTelinga");
            $this->load->model("mcuSMA/M_MulutSMA", "mMulut");
            $this->load->model("mcuSMA/M_GiziSMA", "mGizi");

            $data['grafik'] = $this->mGrafik->getGraphSMA($data['siswa']->siswa_id, $data['siswa']->siswa_kelamin);
            $view_page = 'pracetakmcusma';
        } elseif ($data['siswa']->siswa_jenjang == "33") {
            $this->load->model("mcuSD/M_LainSD", "mLain");
            $this->load->model("mcuSD/M_MatatelingaSD", "mMataTelinga");
            $this->load->model("mcuSD/M_MulutSD", "mMulut");
            $this->load->model("mcuSD/M_GiziSD", "mGizi");

            $data['grafik'] = $this->mGrafik->getGraphSD($data['siswa']->siswa_id, $data['siswa']->siswa_kelamin);
            $view_page = 'pracetakmcusd';
        } elseif (($data['siswa']->siswa_jenjang == "22") || ($data['siswa']->siswa_jenjang == "11")) {
            $this->load->model("mcuDCKBTK/M_LainDckbtk", "mLain");
            $this->load->model("mcuDCKBTK/M_MatatelingaDckbtk", "mMataTelinga");
            $this->load->model("mcuDCKBTK/M_MulutDckbtk", "mMulut");
            $this->load->model("mcuDCKBTK/M_GiziDckbtk", "mGizi");

            $data['grafik'] = $this->mGrafik->getGraphDCKBTK($data['siswa']->siswa_id, $data['siswa']->siswa_kelamin);
            $view_page = 'pracetakmcudckb';
        }

        $data['lain'] = $this->mLain->findByParentId($mcu_id);
        $data['matatelinga'] = $this->mMataTelinga->findByParentId($mcu_id);
        $data['mulut'] = $this->mMulut->findByParentId($mcu_id);
        $data['gizi'] = $this->mGizi->findByParentId($mcu_id);
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
    }

    function precetakdcu($dcu_id){
        $this->load->model('dcu/M_DCU', 'mDCU');

        $data['title'] = "Pracetak Dental Check Up";
        $data['menu'] = 'Cetak DCU';
        $data['smenu'] = '';

        $data['dcu'] = $this->mDCU->findById($dcu_id);
        $data['siswa'] = $this->mSiswa->findByIdAndParentId($data['dcu']->siswa_id, $data['dcu']->thnAkademik_id);
        $data['siswa']->siswa_kelas = "{$data['siswa']->kelas_tingkat}{$data['siswa']->kelas_rombel}";

        $data['jenjang'] = $data['siswa']->siswa_jenjang;
        $data['tanggal_lhr'] = $this->mUKS->tgl_indo($data['siswa']->siswa_tgl_lahir);
        $data['content'] = $this->mCDcu->getOneDcuKode($dcu_id);
        $data['diagnose'] = $this->mCDcu->getDiagnose($dcu_id);
        $data['dokter'] = $this->mDokter->findById($data['content'][0]->dokter_id);
        $data['tanggal_dcu'] = $this->mUKS->tgl_indo($data['content'][0]->dcu_date);
        
        $this->blade->render('pracetakdcu',$data);
    }

    function cariSIswaDcu()
   {

            $data['title'] = "Pilih Nama yang akan dicetak";
            $data['menu']  = 'Cetak MCU';
            $data['smenu'] = '';
            $data['user']  = $this->mLogin->getNameUser();
            $data['role']  = $this->mLogin->getUserRole();

        //$data['content'] = $this->mUKS->getAllBasicSiswa();
       //var_dump($data);
        $this->blade->render('pndcu', $data);

   }
    function pddcu()
   {
        $data['title'] = "Pilih data yang akan dicetak";
        $data['menu']  = 'Cetak MCU';
        $data['smenu'] = '';
        $data['user']  = $this->mLogin->getNameUser();
        $data['role']  = $this->mLogin->getUserRole();
        $idsiswa            = $this->input->post('siswa');
        $siswa_jenjang =    $this->input->post('jenjang');
        
        $data['nama']       = $this->mCDcu->getNama($idsiswa); 
        $data['jadwal']    = $this->mCDcu->getdatedcu($idsiswa);       
        $this->blade->render('pddcu',$data);
        
   }

} 