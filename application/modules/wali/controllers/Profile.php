<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Middleware {

    public function __construct()
    {
	    parent::__construct();
        $this->load->model('M_Login', 'mLogin');
        $this->load->model('M_Profile', 'mProfile');
        $this->load->model('siswa/M_Siswa', 'mSiswa');
        $this->load->model('thakademik/M_Thakademik', 'mThakademik');
        $this->load->model('cetak/M_CetakMcu', 'mCMcu');
    }

	public function index(){
        $data['title'] = "Daftar Siswa";
        $data['menu']  = 'PS';
        $data['smenu'] = '';
        $data['user']  = $this->mLogin->getNameUser();
        $data['role']  = $this->mLogin->getUserRole();
        $data['class'] = $this->mLogin->getUserClass();
        $data['kelas_tingkat'] = $this->session->userdata('kelas_tingkat');
        $data['kelas_rombel'] = $this->session->userdata('kelas_rombel');
        $data['jenjang'] = $this->session->userdata('jenjang');
        $param = [
            'thnAkademik_id' => $this->mThakademik->getTahunAkademikIdByActive(),
            'kelas_tingkat' => $data['kelas_tingkat'],
            'kelas_rombel' => $data['kelas_rombel'],
            'jenjang' => $data['jenjang']
        ];
        $data['list_siswa'] = $this->mSiswa->getByKelas($param);
        $this->blade->render('profile/list_siswa', $data);
    }

	public function siswa($siswa_id){
        $this->load->helper('jenjang');
        $this->load->helper('kegiatan');
        $data['title'] = "Profil Siswa";
        $data['menu']  = 'PS';
        $data['smenu'] = '';
        $data['user']  = $this->mLogin->getNameUser();
        $data['role']  = $this->mLogin->getUserRole();
        $data['class'] = $this->mLogin->getUserClass();
        $data['siswa'] = $this->mSiswa->findById($siswa_id);
        $data['thnAkademik_id'] = $this->mThakademik->getTahunAkademikIdByActive();
        $data['profile'] = $this->mProfile->get([
            'thnAkademik_id' => $data['thnAkademik_id'],
            'siswa_id' => $siswa_id
        ]);
        if ($data['siswa']->siswa_jenjang == "44") {
            $data['grafik'] = $this->mCMcu->grafikSmp($siswa_id, $data['siswa']->siswa_kelamin, $data['thnAkademik_id']);
        }
        else if ($data['siswa']->siswa_jenjang == "33") {
            $data['grafik'] = $this->mCMcu->grafikSd($siswa_id, $data['siswa']->siswa_kelamin, $data['thnAkademik_id']);
        }
        else {
            $data['grafik'] = $this->mCMcu->grafikDCKB($siswa_id, $data['siswa']->siswa_kelamin, $data['thnAkademik_id']);
        }
        $this->blade->render('profile/siswa', $data);
    }
}