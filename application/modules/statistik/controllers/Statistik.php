<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Statistik extends Middleware
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Login', 'mLogin');
		$this->load->model('thakademik/M_Thakademik', 'mAkademik');
		$this->load->model('thakademik/M_Periode', 'mPeriode');
		$this->load->model('statistik/M_Statistik', 'mStatistik');
	}

	public function index()
	{
		$data['title'] = "Laporan Kegiatan";
		$data['menu'] = 'LK';
		$data['tahun_akademik'] = $this->mAkademik->showAllSummary();
		$this->blade->render('laporan', $data);
	}

	public function tahun($thnId)
	{
		$data['title'] = "Laporan Kegiatan";
		$data['menu'] = 'LK';
		$data['tahun_akademik'] = $this->mPeriode->showSummaryByParentId($thnId);
		$this->blade->render('laporan_periode', $data);
	}

	public function detail($periode_id, $periode_name)
	{
		$data['menu'] = 'LK';
		if ($periode_name == "MCU") {
			$data['title'] = "Statistik Kegiatan MCU";
			$data['jumlah_peserta_laki'] = $this->mStatistik->pesertaMcuLaki($periode_id);
			$data['jumlah_peserta_perempuan'] = $this->mStatistik->pesertaMcuPerempuan($periode_id);
			$data['jumlah_sangatkurus'] = $this->mStatistik->imtsangatkurus($periode_id);
			$data['jumlah_kurus'] = $this->mStatistik->imtkurus($periode_id);
			$data['jumlah_ideal'] = $this->mStatistik->imtideal($periode_id);
			$data['jumlah_berlebih'] = $this->mStatistik->imtberlebih($periode_id);
			$data['jumlah_sangatberlebih'] = $this->mStatistik->imtsangatberlebih($periode_id);
			$this->blade->render('statistikawalmcu', $data);

		}
		// elseif ($periode_name=="DCU") {
		//     $data['content']= $this->mPeriode->getOnePeriodeDcu($periode_id);
		//      $this->blade->render('detail_jumlahdcu', $data);
		// }
	}

}