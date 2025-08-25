<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends Middleware
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Login', 'mLogin');
		$this->load->model('M_Minggu', 'mMinggu');
	}

	public function index()
	{
		if ($this->input->post()) {
			$result = $this->mMinggu->createRow($this->input->post());
			if ($result) {
				redirect(base_url('jadwal'));
			}
		} else {
			$data['title'] = "Jadwal Skrining Karyawan";
			$data['menu'] = 'JWL';
			$data['user'] = $this->mLogin->getNameUser();
			$data['jadwal'] = $this->mMinggu->showAll();
			$this->blade->render('jadwal', $data);
		}
	}

	public function status($jadwalID, $status)
	{
		if ($status == 0) {
			$this->mMinggu->updateRow2($jadwalID, 1);
		} else {
			$this->mMinggu->updateRow2($jadwalID, 0);
		}
		redirect(base_url('jadwal'));
	}

	public function detail($jadwalID)
	{
		$this->load->model('M_Kelas', 'mKelas');
		$this->load->model('M_JadDetail', 'mJDetail');

		if ($this->input->post()) {
			$result = $this->mJDetail->create($this->input->post(), $jadwalID);
			if ($result) {
				redirect(base_url('jadwalSD/detail/' . $jadwalID));
			}
		} else {
			$data['title'] = "Detail Jadwal TFL SD";
			$data['menu'] = 'JSD';
			$data['user'] = $this->mLogin->getNama();
			$data['level'] = $this->mLogin->getLevelUser();
			$data['jadwal'] = $this->mJadwal->showAll();
			$data['kelas'] = $this->mKelas->showForOption(33);
			$data['jdetail'] = $this->mJDetail->showByParentId($jadwalID);
			$this->blade->render('jadwal_detail', $data);
		}
	}

	public function paket($jdetailID)
	{
		$this->load->model('M_PaketItem', 'mPaketItem');
		$this->load->model('M_JadPack', 'mJPack');

		if ($this->input->post()) {
			$result = $this->mJPack->create($this->input->post(), $jdetailID);
			if ($result) {
				redirect(base_url('jadwalSD/paket/' . $jdetailID));
			}
		} else {
			$data['title'] = "Kegiatan";
			$data['menu'] = 'JSD';
			$data['user'] = $this->mLogin->getNama();
			$data['level'] = $this->mLogin->getLevelUser();
			$data['paket'] = $this->mPaketItem->showForOption();
			$data['kegiatan'] = $this->mJPack->showByParentId($jdetailID);
			$this->blade->render('jadwal_paket', $data);
		}
	}

}