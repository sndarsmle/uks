<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Middleware extends RestAPI
{
	public array $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Login', 'mLogin');
		if (!$this->mLogin->isLogin()) {
			redirect(base_url());
		}
	}
}