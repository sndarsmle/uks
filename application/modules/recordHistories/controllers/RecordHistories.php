<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RecordHistories extends Middleware
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $data['title'] = "Riwayat Pemeriksaan";
        $data['menu'] = '-';
        $data['user'] = $this->mLogin->getNameUser();
        $data['role'] = $this->mLogin->getUserRole();
        $this->blade->render('index', $data);
    }

    public function detail($periodId)
    {
        $namaKegiatan = 'MCU - September 2025';
        $data['title'] = "Riwayat Pemeriksaan Kegiatan " . $namaKegiatan;
        $data['menu'] = 'RHS';
        $data['user'] = $this->mLogin->getNameUser();
        $data['role'] = $this->mLogin->getUserRole();
        $this->blade->render('detail', $data);
    }
}