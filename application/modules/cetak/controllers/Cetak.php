<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Cetak extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Login', 'mUks');
		$this->load->model('M_Uks', 'mUKS');
		$this->load->model('M_Jadwalscreening', 'mJadwalS');
		$this->load->model('M_Cetak', 'mCetak');
		$this->load->model('siswa/M_Siswa', 'mSiswa');
	}

	public function index()
	{
		if ($this->mUks->isLogin()) {
			# code...
			$data['title'] = "Skrining";
			$data['menu'] = 'D00';
			$data['smenu'] = '';
			$this->blade->render('utama', $data);
		} else {
			$data['title'] = "Login";
			$data['hasil'] = '2';
			$data['smenu'] = '';
			$this->blade->render('login', $data);
		}
	}

	public function logout()
	{
		$this->mLogin->logout();
		redirect(base_url());
	}


	public function edit_mcu($niss, $kode_mcu)
	{

		if ($this->mUks->isLogin()) {
			# code...
			$data['title'] = "Edit Medical Check Up";
			$data['menu'] = 'EMCU';
			$data['smenu'] = '';

			$data['content'] = $this->mSiswa->findByNis($niss);
			$gender = "";
			$data['basicsiswa'] = $this->mUKS->getOnesiswaNis($niss);
			$gender = $data['basicsiswa'][0]->jenis_kelamin;


			$data['limitjadwal'] = $this->mUKS->limitPeriodeMcuNis($niss);
			$data['isii'] = $this->mUKS->getOneMcuKode($kode_mcu, $gender);
			$data['isi'] = $data['isii'][0];
			$data['isi_mcu'] = $data['isi'];

			$data ['jadwal'] = $this->mUKS->getJadwalMcu();
			$jk = $data['content']->jenis_kelamin;
			if ($jk == "L") {
				$data ['imtdbb'] = $this->mUKS->getIMTLaki();
			} else {
				$data ['imtdbb'] = $this->mUKS->getIMTPerempuan();
			}
			$this->blade->render('editmcu', $data);

		} else {
			$data['title'] = "Login";
			$data['hasil'] = '2';
			$data['smenu'] = '';
			$this->blade->render('login', $data);
		}


	}

	public function update_mcu()
	{
		$kode_periksa_mcu = $this->input->post('nis') . $this->input->post('jadwal_screening');
		$kode_mcu = $this->input->post('kode_mcu');
		$dataa = array(
				'idsiswa' => $this->input->post('idsiswa'),
				'nis' => $this->input->post('nis'),
				'jadwal_mcu' => $this->input->post('jadwal_screening'),
			// 'usia_periksa' => $this->input->post('tahun'),
				'usia_tahun' => $this->input->post('tahun_usia'),
				'usia_bulan' => $this->input->post('bulan_usia'),
				'kode_periksa_mcu' => $kode_periksa_mcu,
				'berat_badan' => $this->input->post('bb'),
				'tinggi_badan' => $this->input->post('tb'),
				'lingkar_kepala' => $this->input->post('lk'),
				'lingkar_lengan_atas' => $this->input->post('lla'),
				'lingkar_perut' => $this->input->post('lp'),
				'imt' => $this->input->post('pimt'),
				'status_gizi' => $this->input->post('sg'),
				'stuning' => $this->input->post('stuning'),
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

		$this->mUKS->updateMcu($dataa, $kode_mcu);
		echo "<script type='text/javascript'>alert('Data Berhasil Diupdate');</script>";
		$this->index();


	}


	public function pnmcu()
	{

		$data['title'] = "Cetak data mcu";
		$data['menu'] = 'CMCU1';
		$data['smenu'] = '';

		//$data['content'] = $this->mUKS->getAllBasicSiswa();
		//var_dump($data);
		$this->blade->render('pnmcu', $data);

	}

	public function pdmcu()
	{
		if ($this->mUks->isLogin()) {
			# code...
			$data['title'] = "Riwayat Medical Check Up";
			$data['menu'] = 'CMCU';
			$data['smenu'] = '';
			$idsiswa = $this->input->post('siswa');
			$data['nama'] = $this->mCetak->getNama($idsiswa);
			$data['jadwal'] = $this->mCetak->getdatemcu($idsiswa);
			$this->blade->render('pdmcu', $data);
			// $this->blade->render('skreening', $data);
			// $this->blade->render('skreening', $data);
		} else {
			$data['title'] = "Login";
			$data['hasil'] = '2';
			$data['smenu'] = '';
			$this->blade->render('login', $data);
		}

	}

	public function pndental()
	{

		$data['title'] = "Manajemen data dental";
		$data['menu'] = 'MDD';
		$data['smenu'] = '';

		//$data['content'] = $this->mUKS->getAllBasicSiswa();
		//var_dump($data);
		$this->blade->render('pndental', $data);

	}

	public function pddental()
	{
		if ($this->mUks->isLogin()) {
			# code...
			$data['title'] = "Riwayat Pemeriksaan Gigi";
			$data['menu'] = 'CMCU';
			$data['smenu'] = '';
			$idsiswa = $this->input->post('siswa');
			$data['nama'] = $this->mCetak->getNama($idsiswa);
			$data['jadwal'] = $this->mCetak->getdatedental($idsiswa);
			//var_dump($data['jadwal']);
			$this->blade->render('pddental', $data);
			// $this->blade->render('skreening', $data);
			// $this->blade->render('skreening', $data);
		} else {
			$data['title'] = "Login";
			$data['hasil'] = '2';
			$data['smenu'] = '';
			$this->blade->render('login', $data);
		}

	}

	function cek_saja()
	{
		echo "tesss";
	}

	public function precetakmcu($niss, $kode_mcu)
	{

		if ($this->mUks->isLogin()) {
			# code...
			$this->load->model('M_Login', 'mLogin');
			$data['title'] = "pracetak Medical Check Up";
			$data['menu'] = 'CMCU';
			$data['smenu'] = '';
			$data['role'] = $this->mLogin->getUserRole();
			$gender = "";
			//$nis                = $this->input->post('nis');
			//$tanggal_mcu        = $this->input->post('tanggal_mcu');
			//$kodemcu            = $nis.$tanggal_mcu;
			//$data['basicsiswa'] = $this->mUKS->getOnesiswaNis($nis);
			$data['basicsiswa'] = $this->mUKS->getOnesiswaNis($niss);
			$jk = $data['basicsiswa'][0]->jenis_kelamin;
			if ($jk == "L") {
				$tabel_imt = "imt_laki";
			} else {
				$tabel_imt = "imt_perempuan";
			}
			//$data['content']    = $this->mUKS->getOneMcu($kodemcu);
			$data['content'] = $this->mUKS->getOneMcuKode($kode_mcu, $jk);
			$dokter = $data['content'][0]->dokter;
			//$a                  = $this->mUKS->getTglLhr($nis);
			$a = $this->mUKS->getTglLhr($niss);
			$b = $this->mUKS->getTglMcuKode($kode_mcu);
			$cek = $a[0]->tgl_lahir;
			$cek2 = $b[0]->tgl_periksa;
			$data['tanggal_lhr'] = $this->mUKS->tgl_indo($cek);
			$data['tanggal_mcu'] = $this->mUKS->tgl_indo($cek2);
			$data['grafik'] = $this->mUKS->grafik($niss, $jk);
			//$pathttd            = $this->mCetak->pathTtd($dokter);
			//$data['ttd']        = $pathttd[0]->pathttd;
			//var_dump($data['grafik']);
			//var_dump($tabel_imt);
			//var_dump($data['grafik']);
			// var_dump($data['basicsiswa']);
			$this->blade->render('pracetakmcu', $data);
			// $this->blade->render('skreening', $data);
			// $this->blade->render('skreening', $data);
		} else {
			$data['title'] = "Login";
			$data['hasil'] = '2';
			$data['smenu'] = '';
			$this->blade->render('login', $data);
		}


	}

	public function precetakdental($niss, $id_pemeriksaan)
	{

		if ($this->mUks->isLogin()) {
			# code...//
			$data['title'] = "pracetak Odontogram";
			$data['menu'] = 'CMCU';
			$data['smenu'] = '';
			//$nis                = $this->input->post('nis');
			//$tanggal_mcu        = $this->input->post('tanggal_mcu');
			//$kodemcu            = $nis.$tanggal_mcu;
			//$data['basicsiswa'] = $this->mUKS->getOnesiswaNis($nis);
			$data['basicsiswa'] = $this->mUKS->getOnesiswaNis($niss);
			//$data['content']    = $this->mUKS->getOneMcu($kodemcu);
			$data['content'] = $this->mUKS->getOdontogramLanjutan($id_pemeriksaan);
			$data['content'] = $this->mUKS->getOdontogramLanjutan($id_pemeriksaan);
			//$a                  = $this->mUKS->getTglLhr($nis);
			$a = $this->mUKS->getTglLhr($niss);
			$b = $this->mUKS->getTglDental($id_pemeriksaan);
			$cek = $a[0]->tgl_lahir;
			$cek2 = $b[0]->date_time;
			$data['tanggal_lhr'] = $this->mUKS->tgl_indo($cek);
			$data['tgl_periksa'] = $this->mUKS->tgl_indo($cek2);

			$this->blade->render('pracetakdental', $data);
			// $this->blade->render('skreening', $data);
			// $this->blade->render('skreening', $data);
		} else {
			$data['title'] = "Login";
			$data['hasil'] = '2';
			$data['smenu'] = '';
			$this->blade->render('login', $data);
		}


	}

	public function mcu_periode()
	{

		$data['title'] = "Cetak data mcu";
		$data['menu'] = 'CMCU';
		$data['smenu'] = '';
		$data['periode'] = $this->mCetak->getPeriode();
		//$data['content'] = $this->mUKS->getAllBasicSiswa();
		// var_dump($data['periode']);
		$this->blade->render('mcu_periode', $data);

	}

	public function pdperiodemcu($periode)
	{
		if ($this->mUks->isLogin()) {
			# code...
			$data['title'] = "Riwayat Medical Check Up";
			$data['menu'] = 'CMCU';
			$data['smenu'] = '';
			//$periode            = $this->input->post('periode');
			$periode = str_replace('_', ' ', $periode);
			$data['content'] = $this->mCetak->getOnePeriode($periode);
			$this->blade->render('v_pdperiodemcu', $data);
			// $this->blade->render('skreening', $data);
			// $this->blade->render('skreening', $data);
		} else {
			$data['title'] = "Login";
			$data['hasil'] = '2';
			$data['smenu'] = '';
			$this->blade->render('login', $data);
		}

	}

	public function kunjungan_bulanan()
	{

		if ($this->mUks->isLogin()) {
			# code...
			$data['title'] = "Cetak Laporan Kunjungan UKS Bulanan";
			$data['menu'] = 'CMCU';
			$data['smenu'] = '';

			$data['content'] = $this->mCetak->getKunjunganMonthly();
			//var_dump($data['content']);
			$this->blade->render('kunjunganbulanan', $data);
			// $this->blade->render('skreening', $data);
			// $this->blade->render('skreening', $data);
		} else {
			$data['title'] = "Login";
			$data['hasil'] = '2';
			$data['smenu'] = '';
			$this->blade->render('login', $data);
		}

	}

	function lihat_kunjungan_bulanan($month, $year)
	{
		$data['title'] = "Cetak Laporan Kunjungan UKS Bulanan";
		$data['menu'] = 'CMCU';
		$data['smenu'] = '';
		$data ['content'] = $this->mCetak->getBulanan($month, $year);
		foreach ($data['content'] as $key => $hasil) {
			$hasil->tgl_kunjungan = $this->mUKS->tgl_indo($hasil->tgl_kunjungan);
		};

		//var_dump($data['content']);
		$this->blade->render('lihat_kunjungan_bulanan', $data);


	}

	function detaillaporanharian($tgl)
	{
		$data['title'] = "Laporan Jumlah MCU Harian";
		$data['menu'] = 'CMCU';
		$data['smenu'] = '';
		$tgl_periksa = $tgl;
		$data['tgl_periksa'] = $this->mUKS->tgl_indo($tgl_periksa);
		$data['content'] = $this->mCetak->getDetailJumlahHarian($tgl_periksa);

		$this->blade->render('laporanharian', $data);

	}

	function laporanharian($periode_mcu)
	{
		$data['title'] = "Laporan Jumlah MCU Harian";
		$data['menu'] = 'CMCU';
		$data['smenu'] = '';
		$periode_mcu = str_replace('_', ' ', $periode_mcu);
		//$periode_mcu        = "Maret 2021";
		$data['periode'] = $periode_mcu;
		//$data['content']    = $this->mCetak->getDetailJumlahHarian($tgl_periksa);
		$data['content'] = $this->mCetak->getJumlahHarian($periode_mcu);
		foreach ($data['content'] as $key => $hasil) {
			$hasil->tgl_periksa = $this->mUKS->tgl_indo($hasil->tgl_periksa);
		};
		//var_dump($data['content']);
		// var_dump($data['content']);

		$this->blade->render('statistikharian', $data);

	}

	function excel_bulanan($month, $year)
	{


		$data ['content'] = $this->mCetak->getBulanan($month, $year);
		$bulan = "";
		if ($month == '01') {
			$bulan = 'Januari';
			# code...
		} else if ($month == '02') {
			$bulan = 'Februari';
			# code...
		} else if ($month == '03') {
			$bulan = 'Maret';
			# code...
		} else if ($month == '04') {
			$bulan = 'April';
			# code...
		} else if ($month == '05') {
			$bulan = 'Mei';
			# code...
		} else if ($month == '06') {
			$bulan = 'Juni';
			# code...
		} else if ($month == '07') {
			$bulan = 'Juli';
			# code...
		} else if ($month == '08') {
			$bulan = 'Agustus';
			# code...
		} else if ($month == '09') {
			$bulan = 'September';
			# code...
		} else if ($month == '10') {
			$bulan = 'Oktober';
			# code...
		} else if ($month == '11') {
			$bulan = 'November';
			# code...
		} else if ($month == '12') {
			$bulan = 'Desember';
			# code...
		}
		//require(APPPATH. 'PHPExcelpath/Classes/PHPExcel.php');
		// require base_url('PHPExcelpath/Classes/PHPExcel.php');
		// require(APPPATH. 'PHPExcelpath/Classes/PHPExcel/Writer/Excel2007.php');


		$object = new Spreadsheet();
		$object->getProperties()->setCreator('UKS Teladan');
		$object->getProperties()->setTitle('Daftar UKS Bulan ' . $bulan . ' Tahun ' . $year);
		$object->setActiveSheetIndex(0);
		$object->getDefaultStyle()->getFont()->setName('Carlito');//font
		$object->getDefaultStyle()->getFont()->setSize(9);//sizefont
		$object->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$object->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$object->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$object->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$object->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$object->getActiveSheet()->getColumnDimension('G')->setWidth(18);
		$object->getActiveSheet()->getColumnDimension('H')->setWidth(30.5);
		$object->getActiveSheet()->getColumnDimension('I')->setWidth(43.17);


		$object->getActiveSheet()->setCellValue('A1', 'No');
		$object->getActiveSheet()->mergeCells("A1:A2");
		$object->getActiveSheet()->setCellValue('B1', 'Hari,tanggal');
		$object->getActiveSheet()->mergeCells("B1:B2");
		$object->getActiveSheet()->setCellValue('C1', 'Nama Siswa');
		$object->getActiveSheet()->mergeCells("C1:C2");
		$object->getActiveSheet()->setCellValue('D1', 'Kelas');
		$object->getActiveSheet()->mergeCells("D1:D2");
		$object->getActiveSheet()->setCellValue('E1', 'Waktu');
		$object->getActiveSheet()->mergeCells("E1:F1");
		$object->getActiveSheet()->setCellValue('E2', 'Masuk');
		$object->getActiveSheet()->setCellValue('F2', 'Keluar');
		$object->getActiveSheet()->setCellValue('G1', 'Keluhan');
		$object->getActiveSheet()->mergeCells("G1:G2");
		$object->getActiveSheet()->setCellValue('H1', 'Penanganan');
		$object->getActiveSheet()->mergeCells("H1:H2");
		$object->getActiveSheet()->setCellValue('I1', 'Hasil/Keterangan');
		$object->getActiveSheet()->mergeCells("I1:I2");


		$baris = 3;
		$no = 1;

		foreach ($data['content'] as $key => $hasil) {
			$hasil->tgl_kunjungan = $this->mUKS->tgl_indo($hasil->tgl_kunjungan);

			$object->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$object->getActiveSheet()->setCellValue('B' . $baris, $hasil->hari . ', ' . $hasil->tgl_kunjungan);
			$object->getActiveSheet()->setCellValue('C' . $baris, $hasil->nama);
			$object->getActiveSheet()->setCellValue('D' . $baris, $hasil->kelas);
			$object->getActiveSheet()->setCellValue('E' . $baris, $hasil->jam_datang);
			$object->getActiveSheet()->setCellValue('F' . $baris, $hasil->jam_keluar);
			$object->getActiveSheet()->setCellValue('G' . $baris, $hasil->keluhan);
			$object->getActiveSheet()->setCellValue('H' . $baris, $hasil->penanganan);
			$object->getActiveSheet()->setCellValue('I' . $baris, $hasil->hasil);


			$baris++;

			# code...
		}
		$styleArray = [
				'font' => [
						'bold' => true,
				],
				'alignment' => [
						'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
						'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
					// 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,


				],
				'borders' => [
						'top' => [
								'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
						],
				],

		];

		$object->getActiveSheet()->getStyle('A1:I2')->applyFromArray($styleArray);
		$object->getActiveSheet()->getStyle('A3:A' . $baris)
				->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('D3:F' . $baris)
				->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$object->getActiveSheet()->getStyle('G3:I' . $baris)
				->getAlignment()->setWrapText(true);


		$borderStyle = [
				'borders' => [
						'allBorders' => [
								'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
								'color' => ['argb' => 'FF000000'],
						],
				],
		];

		$object->getActiveSheet()->getStyle('A1:I' . $baris)->applyFromArray($borderStyle);

		$writer = new Xlsx($object);
		$filename = "Data_Pengunjung_Uks_Bulan_" . $bulan . "_Tahun_" . $year . '.xlsx';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

}