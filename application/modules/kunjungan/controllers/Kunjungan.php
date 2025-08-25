<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kunjungan extends Middleware
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Login', 'mLogin');
        $this->load->model('M_Kunjungan', 'mKunjungan');
        $this->load->model('M_Uks', 'mUKS');
    }

    /**
     * @return void
     */
    public function index(): void
    {
        $data['title'] = ' Kunjungan UKS';
        $data['menu'] = 'JWL';
        $data['user'] = $this->mLogin->getNameUser();
        $data['kunjungan'] = $this->mKunjungan->showAll();

        $i = 0;
        foreach ($data['kunjungan'] as $key) {
            $data['kunjungan'][$i]->tgl_kunjungan = $this->mUKS->tgl_indo($key->tgl_kunjungan);
            $i++;
        }
        $this->blade->render('kunjungan', $data);
    }

    /**
     * @param $jadwalId
     * @param $status
     * @return void
     */
    public function status($jadwalId, $status): void
    {
        if ($status == 0) {
            $this->mMinggu->updateRow2($jadwalId, 1);
        } else {
            $this->mMinggu->updateRow2($jadwalId, 0);
        }
        redirect(base_url('jadwal'));
    }

    /**
     * @return void
     */
    public function tambah(): void
    {
        if ($this->input->post()) {
            $data = [
                'hari' => $this->input->post('hari'),
                'jam_datang' => $this->input->post('jam_datang'),
                'jam_keluar' => $this->input->post('jam_keluar'),
                'nama' => $this->input->post('nama'),
                'kelas' => $this->input->post('kelas'),
                'keluhan' => $this->input->post('keluhan'),
                'penanganan' => $this->input->post('penanganan'),
                'hasil' => $this->input->post('hasil'),
                'tgl_kunjungan' => $this->input->post('tanggal')
            ];

            $this->mUKS->saveKunjungan($data);
            echo "<script type='text/javascript'>alert('Data Berhasil Disimpan');</script>";
            $this->index();
        } else {
            $data['title'] = 'Tambah Kunjungan';
            $data['menu'] = 'JWL';
            $this->blade->render('tambah', $data);
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function update($id): void
    {
        $post = $this->input->post();
        $param['idkunjungan'] = $id;
        if ($post) {
            $data = [
                'hari' => $post['hari'],
                'jam_datang' => $post['jam_datang'],
                'jam_keluar' => $post['jam_keluar'],
                'nama' => $post['nama'],
                'kelas' => $post['kelas'],
                'keluhan' => $post['keluhan'],
                'penanganan' => $post['penanganan'],
                'hasil' => $post['hasil'],
                'tgl_kunjungan' => $post['tanggal']
            ];
            $this->mKunjungan->update($param, $data);
            redirect(base_url('kunjungan/update/' . $id));
        } else {
            $kunjungan = $this->mKunjungan->find($param);
            $data['title'] = 'Perbaharui Kunjungan';
            $data['menu'] = 'JWL';
            $data['kunjungan'] = $kunjungan;
            $this->blade->render('tambah', $data);
        }
    }

    /**
     * @param $id
     * @return void
     */
    function hapus_kunjungan($id): void
    {
        $idkunjungan = $id;
        $this->mKunjungan->hapusKunjungan($id);
        $this->index();
    }
}