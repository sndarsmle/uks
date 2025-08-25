<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Login', 'mLogin');
	}

	public function index()
	{
		if ($this->mLogin->isLogin()) {
			redirect(base_url('dashboard'));
		} else {
			$data['hasil'] = "2";
			$data['title'] = "Login Petugas UKS";
			if ($this->input->post()) {
				$login = $this->mLogin->login($this->input->post(), 0);
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

	public function dokter()
	{
		if ($this->mLogin->isLogin()) {
			redirect(base_url('dashboard'));
		} else {
			$data['hasil'] = "2";
			$data['title'] = "Login Dokter";
			if ($this->input->post()) {
				$login = $this->mLogin->login($this->input->post(), 1);
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

}