<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Uks extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Login', 'mUks');
		$this->load->model('M_Uks', 'mUKS');
		$this->load->model('M_Jadwalscreening', 'mJadwalS');
		$this->load->model('siswa/M_Siswa', 'mSiswa');
	}

	public function index()
	{
		if ($this->mUks->isLogin()) {
			redirect(base_url('dashboard'));
		} else {
			$data['hasil'] = "2";
			$data['title'] = "Login Admin UKS";
			if ($this->input->post()) {
				$login = $this->mUks->login($this->input->post());
				if ($login) {
					redirect('dashboard');
				} else {
					$data['hasil'] = "0";
				}
			} else {
				$data['hasil'] = "2";

			}
			$this->blade->render('login', $data);
		}
	}

	public function logout()
	{
		$this->mLogin->logout();
		redirect(base_url());
	}

	public function skreening()
	{
		if ($this->mUks->isLogin()) {
			$data['title'] = "Skrining";
			$data['menu'] = 'MCU';
			$data['smenu'] = '';
			$idsiswa = $this->input->post('siswa');
			//$data['limitjadwal']= $this->mUKS->limitPeriodeMcu($idsiswa);
			$data['content'] = $this->mSiswa->findById($idsiswa);
			$jk = $data['content']->jenis_kelamin;
			if ($jk == "L") {
				$data ['imtdbb'] = $this->mUKS->getIMTLaki();
			} else {
				$data ['imtdbb'] = $this->mUKS->getIMTPerempuan();
			}
			//$data ['jadwal']     = $this->mJadwalS->getAktif();
			$data ['jadwal'] = $this->mUKS->getJadwalMcu();

			$this->blade->render('skreening', $data);
			// $this->blade->render('skreening', $data);
			// $this->blade->render('skreening', $data);
		} else {
			$data['title'] = "Login";
			$data['hasil'] = '2';
			$data['smenu'] = '';
			$this->blade->render('login', $data);
		}
		//    $this->mSiswa->getOne();


	}

	public function inputScreening()
	{
		$kode_periksa_skreening = $this->input->post('idsiswa') . $this->input->post('jadwal_screening');


		$dataa = array(
				'idsiswa' => $this->input->post('idsiswa'),
				'nis' => $this->input->post('nis'),
				'jadwal_screening' => $this->input->post('jadwal_screening'),
			// 'usia_periksa' => $this->input->post('tahun'),
				'usia_tahun' => $this->input->post('tahun_usia'),
				'usia_bulan' => $this->input->post('bulan_usia'),
				'kode_periksa_skreening' => $kode_periksa_skreening,
				'berat_badan_s' => $this->input->post('bb'),
				'tinggi_badan_s' => $this->input->post('tb'),
				'lingkar_kepala_s' => $this->input->post('lk'),
				'lingkar_lengan_atas_s' => $this->input->post('lla'),
				'lingkar_perut_s' => $this->input->post('lp'),
				'imt_s' => $this->input->post('pimt'),
				'status_gizi_s' => $this->input->post('sg'),
				'stuning_s' => $this->input->post('stun'),
				'bbperu_s' => $this->input->post('bbper_u'),
				'tanda_klinis_anemi_s' => $this->input->post('anemia'),
				'ket_tanda_anemia_s' => $this->input->post('ket_anemia'),
				'mata_s' => $this->input->post('mata'),
				'ket_mata_s' => $this->input->post('ket_mata'),
				'hidung_s' => $this->input->post('hidung'),
				'ket_hidung_s' => $this->input->post('ket_hidung'),
				'rongga_mulut_s' => $this->input->post('mulut'),
				'ket_rongga_mulut_s' => $this->input->post('ket_mulut'),
				'jantung_s' => $this->input->post('jantung'),
				'ket_jantung_s' => $this->input->post('ket_jantung'),
				'paru_s' => $this->input->post('paru'),
				'ket_paru_s' => $this->input->post('ket_paru'),
				'ket_neurologi_s' => $this->input->post('ket_neurologi'),
				'rambut_s' => $this->input->post('rambut'),
				'ket_rambut_s' => $this->input->post('ket_rambut'),
				'kulit_s' => $this->input->post('kulit'),
				'ket_kulit_s' => $this->input->post('ket_kulit'),
				'kuku_s' => $this->input->post('kuku'),
				'ket_kuku_s' => $this->input->post('ket_kuku'),
				'celah_bibir_s' => $this->input->post('bibir'),
				'ket_celah_bibir_s' => $this->input->post('ket_bibir'),
				'luka_sudut_mulut_s' => $this->input->post('sudut_mulut'),
				'ket_luka_sudut_mulut_s' => $this->input->post('ket_sudut_mulut'),
				'sariawan_s' => $this->input->post('sariawan'),
				'ket_sariawan_s' => $this->input->post('ket_sariawan'),
				'lidah_kotor_s' => $this->input->post('lidah'),
				'ket_lidah_kotor_s' => $this->input->post('ket_lidah'),
				'luka_lainnya_s' => $this->input->post('luka_lain'),
				'ket_luka_lainnya_s' => $this->input->post('ket_luka_lain'),
				'ket_masalah_lain_rongga_mulut_s' => $this->input->post('ket_masalah_lain_rongga_mulut'),
				'caries_s' => $this->input->post('caries'),
				'ket_caries_s' => $this->input->post('ket_caries'),
				'gigi_dep_beraturan_s' => $this->input->post('gigi_dep'),
				'ket_gigi_dep_beraturan_s' => $this->input->post('ket_gigi_dep'),
				'ket_masalah_lain_gigi_gusi_s' => $this->input->post('ket_masalah_lain_gigi_gusi'),
				'mata_luar_s' => $this->input->post('mata_luar'),
				'ket_mata_luar_s' => $this->input->post('ket_mata_luar'),
				'tajam_penglihatan_s' => $this->input->post('penglihatan'),
				'ket_tajam_penglihatan_s' => $this->input->post('ket_penglihatan'),
				'kacamata_s' => $this->input->post('kacamata'),
				'ket_kacamata_s' => $this->input->post('ket_kacamata'),
				'infeksi_mata_s' => $this->input->post('inf_mata'),
				'ket_infeksi_mata_s' => $this->input->post('ket_inf_mata'),
				'ket_masalah_lain_penglihatan_s' => $this->input->post('ket_masalah_lain_penglihatan'),
				'telinga_luar_s' => $this->input->post('telinga'),
				'ket_telinga_luar_s' => $this->input->post('ket_telinga'),
				'kotoran_telinga_s' => $this->input->post('kot_telinga'),
				'ket_kotoran_telinga_s' => $this->input->post('ket_kot_telinga'),
				'infeksi_telinga_s' => $this->input->post('inf_telinga'),
				'ket_infeksi_telinga_s' => $this->input->post('ket_inf_telinga'),
				'tajam_pendengaran_s' => $this->input->post('tajam_pendengaran'),
				'ket_tajam_pendengaran_s' => $this->input->post('ket_tajam_pendengaran'),
				'ket_masalah_lain_pendengaran_s' => $this->input->post('ket_masalah_lain_pendengaran'),
				'gangguan_mental_s' => $this->input->post('mental'),
				'kesimpulan_s' => $this->input->post('kesimpulan'),
				'kesimpulan_akr_s' => $this->input->post('kesimpulan_akr'),
				'saran_s' => $this->input->post('saran'),
				'lokasi_s' => $this->input->post('lokasi'),
				'tgl_periksa_s' => $this->input->post('tanggal'),
				'dokter_s' => $this->input->post('dokter')
		);

		$this->mUKS->saveScreening($dataa);
		echo "<script type='text/javascript'>alert('Data Berhasil Disimpan');</script>";
		$this->pilihScreening();

	}

	public function pilihScreening()
	{
		$data['title'] = "Skrining";
		$data['menu'] = 'D00';
		$data['smenu'] = '';

		$data['content'] = $this->mUKS->getAllBasicSiswa();
		//var_dump($data);
		$this->blade->render('pilihscreening', $data);

	}

	public function kunjungan()
	{
		$data['title'] = "Skrining";
		$data['menu'] = 'D00';
		$data['smenu'] = '';

		$this->blade->render('kunjungan', $data);
	}

	public function pilihMcu()
	{
		$data['title'] = "Skrining";
		$data['menu'] = 'D00';
		$data['smenu'] = '';
		$data['content'] = $this->mUKS->getAllBasicSiswa();
		$this->blade->render('pilihmcu', $data);
	}

	public function mcu()
	{
		if ($this->mUks->isLogin()) {
			$data['title'] = "Skrining";
			$data['menu'] = 'MCU';
			$data['smenu'] = '';
			$idsiswa = $this->input->post('siswa');
			$data['limitjadwal'] = $this->mUKS->limitPeriodeMcu($idsiswa);
			$data['content'] = $this->mSiswa->findById($idsiswa);
			$jk = $data['content']->jenis_kelamin;
			if ($jk == "L") {
				$data ['imtdbb'] = $this->mUKS->getIMTLaki();
			} else {
				$data ['imtdbb'] = $this->mUKS->getIMTPerempuan();
			}


			$data ['jadwal'] = $this->mUKS->getJadwalMcu();
			//$data ['imtdb']       = $this->mUKS->getIMT();
			$this->blade->render('mcu', $data);
		} else {
			redirect(base_url('admin'));
		}
	}

	public function inputmcu()
	{
		$kode_periksa_mcu = $this->input->post('nis') . $this->input->post('jadwal_screening');
		$dataa = array(
				'idsiswa' => $this->input->post('idsiswa'),
				'nis' => $this->input->post('nis'),
				'jadwal_mcu' => $this->input->post('jadwal_screening'),
			// 'usia_periksa' => $this->input->post('tahun'),
				'usia_tahun' => $this->input->post('tahun_usia'),
				'usia_bulan' => $this->input->post('bulan_usia'),
				'kode_periksa_mcu' => $kode_periksa_mcu,
				'tekanan_darah' => $this->input->post('tekanan_darah'),
				'denyut_nadi' => $this->input->post('denyut_nadi'),
				'f_pernafasan' => $this->input->post('f_pernafasan'),
				'suhu' => $this->input->post('suhu'),
				'bising_jantung' => $this->input->post('bising_jantung'),
				'bising_paru' => $this->input->post('bising_paru'),
				'berat_badan' => $this->input->post('bb'),
				'tinggi_badan' => $this->input->post('tb'),
				'lingkar_kepala' => $this->input->post('lk'),
				'lingkar_lengan_atas' => $this->input->post('lla'),
				'lingkar_perut' => $this->input->post('lp'),
				'imt' => $this->input->post('pimt'),
				'status_gizi' => $this->input->post('sg'),
				'stuning' => $this->input->post('stun'),
				'bbperu' => $this->input->post('bbper_u'),
				'tanda_klinis_anemi' => $this->input->post('anemia'),
				'ket_tanda_anemia' => $this->input->post('ket_anemia'),
				'mata' => $this->input->post('mata'),
				'ket_mata' => $this->input->post('ket_mata'),
				'hidung' => $this->input->post('hidung'),
				'ket_hidung' => $this->input->post('ket_hidung'),
				'rongga_mulut' => $this->input->post('mulut'),
				'ket_rongga_mulut' => $this->input->post('ket_mulut'),
				'jantung' => $this->input->post('jantung'),
				'ket_jantung' => $this->input->post('ket_jantung'),
				'paru' => $this->input->post('paru'),
				'ket_paru' => $this->input->post('ket_paru'),
				'ket_neurologi' => $this->input->post('ket_neurologi'),
				'rambut' => $this->input->post('rambut'),
				'ket_rambut' => $this->input->post('ket_rambut'),
				'kulit' => $this->input->post('kulit'),
				'ket_kulit' => $this->input->post('ket_kulit'),
				'kulit_sisik' => $this->input->post('kulit_sisik'),
				'kulit_memar' => $this->input->post('kulit_memar'),
				'kulit_sayatan' => $this->input->post('kulit_sayatan'),
				'kulit_koreng' => $this->input->post('kulit_koreng'),
				'kulit_koreng_sukar' => $this->input->post('kulit_koreng_sukar'),
				'kulit_suntik' => $this->input->post('kulit_suntik'),
				'kuku' => $this->input->post('kuku'),
				'ket_kuku' => $this->input->post('ket_kuku'),
				'celah_bibir' => $this->input->post('bibir'),
				'ket_celah_bibir' => $this->input->post('ket_bibir'),
				'luka_sudut_mulut' => $this->input->post('sudut_mulut'),
				'ket_luka_sudut_mulut' => $this->input->post('ket_sudut_mulut'),
				'sariawan' => $this->input->post('sariawan'),
				'ket_sariawan' => $this->input->post('ket_sariawan'),
				'lidah_kotor' => $this->input->post('lidah'),
				'ket_lidah_kotor' => $this->input->post('ket_lidah'),
				'luka_lainnya' => $this->input->post('luka_lain'),
				'ket_luka_lainnya' => $this->input->post('ket_luka_lain'),
				'ket_masalah_lain_rongga_mulut' => $this->input->post('ket_masalah_lain_rongga_mulut'),
				'caries' => $this->input->post('caries'),
				'ket_caries' => $this->input->post('ket_caries'),
				'gigi_dep_beraturan' => $this->input->post('gigi_dep'),
				'ket_gigi_dep_beraturan' => $this->input->post('ket_gigi_dep'),
				'ket_masalah_lain_gigi_gusi' => $this->input->post('ket_masalah_lain_gigi_gusi'),
				'mata_luar' => $this->input->post('mata_luar'),
				'ket_mata_luar' => $this->input->post('ket_mata_luar'),
				'tajam_penglihatan' => $this->input->post('penglihatan'),
				'ket_tajam_penglihatan' => $this->input->post('ket_penglihatan'),
				'kacamata' => $this->input->post('kacamata'),
				'ket_kacamata' => $this->input->post('ket_kacamata'),
				'infeksi_mata' => $this->input->post('inf_mata'),
				'ket_infeksi_mata' => $this->input->post('ket_inf_mata'),
				'buta_warna' => $this->input->post('buta_warna'),
				'ket_masalah_lain_penglihatan' => $this->input->post('ket_masalah_lain_penglihatan'),
				'telinga_luar' => $this->input->post('telinga'),
				'ket_telinga_luar' => $this->input->post('ket_telinga'),
				'kotoran_telinga' => $this->input->post('kot_telinga'),
				'ket_kotoran_telinga' => $this->input->post('ket_kot_telinga'),
				'infeksi_telinga' => $this->input->post('inf_telinga'),
				'ket_infeksi_telinga' => $this->input->post('ket_inf_telinga'),
				'tajam_pendengaran' => $this->input->post('tajam_pendengaran'),
				'ket_tajam_pendengaran' => $this->input->post('ket_tajam_pendengaran'),
				'ket_masalah_lain_pendengaran' => $this->input->post('ket_masalah_lain_pendengaran'),
				'gangguan_mental' => $this->input->post('mental'),
				'kesimpulan' => $this->input->post('kesimpulan'),
				'followup' => $this->input->post('followup'),
				'status_followup' => $this->input->post('status_followup'),
				'saran' => $this->input->post('saran'),
				'lokasi' => $this->input->post('lokasi'),
				'tgl_periksa' => $this->input->post('tanggal'),
				'dokter' => $this->input->post('dokter')
		);

		if ($this->mUKS->saveMcu($dataa)) {
			echo "<script type='text/javascript'>alert('Data Berhasil Disimpan');</script>";
			$this->pilihMcu();
		} else {
			echo "gagal";
		}
	}

	public function pilihdental()
	{
		$data['title'] = "Skrining";
		$data['menu'] = 'D00';
		$data['smenu'] = '';

		$data['content'] = $this->mUKS->getAllBasicSiswa();
		//var_dump($data);
		$this->blade->render('pilihdental', $data);
	}

	public function inputdental()
	{
		$nomorgigi = array();
		$rujukan = array();
		$diagnosis = array();
		$nomorgigi = $this->input->post('nomorgigi');
		$diagnosis = $this->input->post('nomorgigi');
		$rujukan = $this->input->post('rujukan');
		$idpemeriksaan = $this->input->post('id_pemeriksaan');
		$idsiswa = $this->input->post('idsiswa');
		$kelas = $this->input->post('kelas');
		$tanggal_periksa = $this->input->post('tanggal');
		$oklusi = $this->input->post('oklusi');
		$mukosa = $this->input->post('mukosa');
		$d = $this->input->post('d');
		$m = $this->input->post('m');
		$f = $this->input->post('f');
		$periode_periksa = $this->input->post('periode_pemeriksaan_dental');
		$dokter = $this->input->post('dokter');


		$counter = 0;
		$count = count($nomorgigi);
		var_dump($count);
		for ($i = 0; $i < $count; $i++) {
			if ($nomorgigi[$i] != "") {

				$dataa = array(
						'idsiswa' => $idsiswa,
						'kelas' => $kelas,
						'id_pemeriksaan' => $idpemeriksaan,
						'no_gigi' => $nomorgigi[$i],
						'diagnosa' => $diagnosis[$i],
						'rujukan' => $rujukan[$i],
						'waktu_pemeriksaan' => $tanggal_periksa
				);


				$this->mUKS->saveOdontogram($dataa);
				# code...
			}
			# code...
		}

		$dataa2 = array(
				'idsiswa' => $idsiswa,
				'id_pemeriksaan' => $idpemeriksaan,
				'oklusi' => $oklusi,
				'mukosa' => $mukosa,
				'd' => $d,
				'm' => $m,
				'f' => $f,
				'd' => $d,
				'periode_periksa' => $periode_periksa,
				'dokter' => $dokter,
				'date_time' => $tanggal_periksa
		);
		$this->mUKS->saveOdontogramLanjutan($dataa2);
		$this->pilihdental();
	}

	public function dental()
	{
		if ($this->mUks->isLogin()) {
			# code...
			$data['title'] = "Dental Checkup";
			$data['menu'] = '';
			$data['smenu'] = '';
			$idsiswa = $this->input->post('siswa');
			//  $data['content']    = $this->mUKS->getOneSiswa($idsiswa);
			$data['content'] = $this->mSiswa->findById($idsiswa);

			//  $data ['jadwal']     = $this->mJadwalS->getAktif();
			$data['limitjadwal'] = $this->mUKS->limitPeriodeMcu($idsiswa);
			//$data['content']    = $this->mSiswa->findById($idsiswa);
			$data ['jadwal'] = $this->mUKS->getJadwalMcu();
			//var_dump($data['content']);
			$this->blade->render('dental', $data);
			// $this->blade->render('skreening', $data);
			// $this->blade->render('skreening', $data);
		} else {
			$data['title'] = "Login";
			$data['hasil'] = '2';
			$data['smenu'] = '';
			$this->blade->render('login', $data);
		}
		//    $this->mSiswa->getOne();
	}

}