<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends Middleware
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Login', 'mLogin');
		$this->load->model('M_Profile', 'mProfile');
		$this->load->model('siswa/M_Siswa', 'mSiswa');
		$this->load->model('siswa/M_Kelas', 'mKelas');
		$this->load->model('thakademik/M_Thakademik', 'mThakademik');
		$this->load->model('cetak/M_CetakMcu', 'mCMcu');
	}

	public function index()
	{
		$this->load->helper('jenjang');
		$data['title'] = "Daftar Kelas";
		$data['menu'] = 'PS';
		$data['list_kelas'] = $this->mKelas->getListKelas();
		$this->blade->render('list_kelas', $data);
	}

	public function list_siswa($jenjang, $kelas_tingkat, $kelas_rombel)
	{
		$data['title'] = "Daftar Siswa";
		$data['menu'] = 'PS';
		$data['smenu'] = '';
		$data['user'] = $this->mLogin->getNameUser();
		$data['role'] = $this->mLogin->getUserRole();
		$data['class'] = $kelas_tingkat . urldecode($kelas_rombel);
		$data['kelas_tingkat'] = $kelas_tingkat;
		$data['kelas_rombel'] = urldecode($kelas_rombel);
		$data['jenjang'] = $jenjang;
		$param = [
				'thnAkademik_id' => $this->mThakademik->getTahunAkademikIdByActive(),
				'kelas_tingkat' => $data['kelas_tingkat'],
				'kelas_rombel' => $data['kelas_rombel'],
				'jenjang' => $data['jenjang']
		];
		$data['list_siswa'] = $this->mSiswa->getByKelas($param);
		$this->blade->render('list_siswa', $data);
	}

	public function siswa($siswa_id)
	{
		$this->load->helper('jenjang');
		$this->load->helper('kegiatan');
		$data['title'] = "Profil Siswa";
		$data['menu'] = 'PS';
		$data['smenu'] = '';
		$data['user'] = $this->mLogin->getNameUser();
		$data['role'] = $this->mLogin->getUserRole();
		$data['class'] = $this->mLogin->getUserClass();
		$data['siswa'] = $this->mSiswa->findById($siswa_id);
		$data['thnAkademik'] = $this->mThakademik->getActive();
        $data['historiesClass'] = $this->mKelas->filter(['siswa_id' => $siswa_id]);
        $currentClass = $this->mKelas->find([
            'siswa_id' => $siswa_id,
            'kelas_ta' => $data['thnAkademik']->thnAkademik_year
        ]);
        $data['studentClass'] = ($currentClass->kelas_tingkat ?? '') . ($currentClass->kelas_rombel ?? '');
		$data['profile'] = $this->mProfile->get([
				'thnAkademik_id' => $data['thnAkademik']->thnAkademik_id,
				'siswa_id' => $siswa_id
		]);
		if ($data['siswa']->siswa_jenjang == "44") {
			$data['grafik'] = $this->mCMcu->grafikSmp($siswa_id, $data['siswa']->siswa_kelamin, $data['thnAkademik']->thnAkademik_id);
		} else if ($data['siswa']->siswa_jenjang == "33") {
			$data['grafik'] = $this->mCMcu->grafikSd($siswa_id, $data['siswa']->siswa_kelamin, $data['thnAkademik']->thnAkademik_id);
		} else {
			$data['grafik'] = $this->mCMcu->grafikDCKB($siswa_id, $data['siswa']->siswa_kelamin, $data['thnAkademik']->thnAkademik_id);
		}
		$this->blade->render('siswa', $data);
	}
}