<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * perform controll Thn Akademik data
 * @property mixed $input service to get input variable from codeigniter 3
 * @property mixed $load service to register module from codeigniter 3
 * @property mixed $blade service to render view with blade engine
 * @property M_Thakademik $mAkademik model tahun_akademik based on codeigniter model
 */
class Thakademik extends Middleware
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('thakademik/M_Thakademik', 'mAkademik');
        $this->load->model('thakademik/M_Periode', 'mPeriode');
    }

    /**
     * @return void
     */
    public function index(): void
    {
        if ($this->input->post()) {
            if ($this->mAkademik->createRow($this->input->post())) {
                redirect(base_url('thakademik'));
            }
        } else {
            $data['title'] = 'Tahun Adakemik';
            $data['menu'] = 'THA';
            $data['tahun_akademik'] = $this->mAkademik->showAll();
            $this->blade->render('thakademik', $data);
        }
    }

    /**
     * @param $thnId
     * @return void
     */
    public function show($thnId): void
    {
        $this->load->helper('kegiatan');
        if ($this->input->post()) {
            $form = $this->input->post();
            $form['form_id'] = $thnId;
            if ($this->mPeriode->createRow($form)) {
                redirect(base_url('thakademik/periode/' . $thnId));
            }
        } else {
            $data['title'] = 'Kegiatan';
            $data['menu'] = 'THA';
            $data['thn'] = $this->mAkademik->findById($thnId);
            $data['jadwal'] = $this->mPeriode->showByParentId($thnId);
            $this->blade->render('thakademik_periode', $data);
        }
    }
}