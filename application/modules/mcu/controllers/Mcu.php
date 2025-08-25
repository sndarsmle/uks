<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mcu extends Middleware
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Login', 'mLogin');
        $this->load->model('mcu/M_MCU', 'mMCU');
        $this->load->model('M_WaitingList', 'mWaitingList');
        $this->load->helper("kegiatan");
    }

    public function index(): void
    {
        $data['title'] = "Daftar Tunggu Medical Check Up";
        $data['menu'] = 'MCU';
        $data['smenu'] = '';
        $data['user'] = $this->mLogin->getNameUser();
        $data['role'] = $this->mLogin->getUserRole();
        $data['periode_list'] = $this->mWaitingList->getPeriodeListByActiveYear();
        $params = [
            'periode_id' => $this->input->get('periode_id'),
            'all_mcu' => $this->input->get('all_mcu'),
            'all_dcu' => $this->input->get('all_dcu'),
        ];
        if ($params['periode_id'] == null && $params['all_mcu'] == null && $params['all_dcu'] == null && count($data['periode_list']) > 0) {
            $params['periode_id'] = $data['periode_list'][0]->periode_id;
        }
        $data['daftarTunggu'] = $this->mWaitingList->showAll($params);
        $data['params'] = $params;
        $this->blade->render('mcu', $data);
    }

} 