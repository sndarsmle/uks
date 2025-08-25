<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aktivasi extends Middleware
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Admin', 'mAdmin');
	}

	public function index()
	{
		$data['content'] = $this->mAdmin->getAll();
		$data['title'] = "Aktivasi User";
		$data['menu'] = 'D00';
		$data['smenu'] = '';
		$this->blade->render('aktivasi', $data);
	}

	public function logout()
	{
		$this->mLogin->logout();
		redirect(base_url());
	}

	public function status($user_id, $status)
	{
		if ($status == 0) {
			$this->mAdmin->aktivasiSingle($user_id, 1);
		} else {
			$this->mAdmin->aktivasiSingle($user_id, 0);
		}
		redirect(base_url('aktivasi'));
	}
}