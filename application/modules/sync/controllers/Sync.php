<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;

class Sync extends Middleware {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Sync', 'mSync');
        $this->load->model('siswa/M_Siswa', 'mSiswa');
        $this->load->model('siswa/M_Kelas', 'mKelas');
    }

    function index(){
        $data['title'] = "Sinkronasi Data";
        $data['menu'] = 'SYNC';
        $data['sync'] = $this->mSync->showAll();
        $this->blade->render('sync', $data);
    }

    function doSync(){
        //$url = 'http://localhost/sia/api/UKS?key=MwPpnHCFQf5xLdtvOmxoLddaa2OoRv';
        $url = 'https://akademik.sekolahteladan.sch.id/api/UKS?key=MwPpnHCFQf5xLdtvOmxoLddaa2OoRv';
        $result = json_decode(file_get_contents($url));
        $listSiswa = $result->data;
        $i = 0;
        foreach ($listSiswa as $key => $siswa) {
            $isExist = $this->mSiswa->isExist($siswa->siswa_id);
            if(!$isExist){
                $this->mSiswa->createRow($siswa);
                $i++;
            }
        }
        echo $i;
        $createLOG = $this->mSync->create($i, $this->mLogin->getUserID(),0);
        if($createLOG){
            redirect(base_url('sync'));
        }
    }

    function doSyncK(){
        //$url = 'http://localhost/sia/api/UKS/kelas?key=MwPpnHCFQf5xLdtvOmxoLddaa2OoRv';
        $url = 'https://akademik.sekolahteladan.sch.id/api/UKS/kelas?key=MwPpnHCFQf5xLdtvOmxoLddaa2OoRv';
        $result = json_decode(file_get_contents($url));
        $listKelas = $result->data;
        $i = 0;
        foreach ($listKelas as $key => $kelas) {
            $currentKelas = $this->mKelas->find([
                'siswa_id' => $kelas->siswa_id,
                'kelas_ta' => $kelas->ta_mulai
            ]);
            if(!$currentKelas){
                $this->mKelas->createRow($kelas);
                $i++;
            } else {
                if (
                    $kelas->kelas_tingkat_nama !== $currentKelas->kelas_tingkat
                    || $kelas->rombel_nama !== $currentKelas->kelas_rombel
                ) {
                    $this->mKelas->update($currentKelas->kelas_id, [
                        'siswa_id' => $kelas->siswa_id,
                        'kelas_tingkat' => $kelas->kelas_tingkat_nama,
                        'kelas_rombel' => $kelas->rombel_nama,
                        'kelas_ta' => $kelas->ta_mulai
                    ]);
                    $i++;
                }
            }
        }
        $createLOG = $this->mSync->create($i, $this->mLogin->getUserID(), 1);
        if($createLOG){
            redirect(base_url('sync'));
        }
    }

    /**
     * @throws JsonException|GuzzleException
     */
    public function change()
    {
        $base_url = "http://sia.test";
        $client = new \GuzzleHttp\Client([
            'base_uri' => "{$base_url}/api/",
        ]);
        $key = "RXEZ03r2JwDeNLxHWBP5zgFhYctf84";
        $count = 0;
        try {
            $response = $client->get(
                "UKS",
                [
                    'query' => [
                        'key' => $key,
                    ]
                ]
            );
            $result = json_decode((string)$response->getBody(), false, 512, JSON_THROW_ON_ERROR);
            $data = $result->data ?? null;
            if ($data) {
                $currentSiswa = $this->mSiswa->getAll();
                $currentDateTime = date('Y-m-d H:i:s');
                foreach ($data as $value) {
                    $isExist = array_filter($currentSiswa, static function($el) use ($value) {
                        return ($value->siswa_id === $el->siswa_id) && ($value->siswa_nis === $el->siswa_nis);
                    });
                    if (count($isExist) > 0) {
                        $isExist = array_values($isExist)[0];
                        $value->siswa_angkatan = substr($value->siswa_angkatan, -2);
                        if (
                            $isExist->siswa_nama !== $value->siswa_nama_full ||
                            $isExist->siswa_kelamin !== $value->siswa_kelamin ||
                            $isExist->siswa_tgl_lahir !== $value->siswa_tgl_lhr ||
                            $isExist->siswa_jenjang !== $value->jenjang ||
                            $isExist->siswa_angkatan !== $value->siswa_angkatan
                        ) {
                            $value->updated_at = $currentDateTime;
                            $this->mSiswa->update($value->siswa_id, [
                                "siswa_nama" => $value->siswa_nama_full,
                                "siswa_kelamin" => $value->siswa_kelamin,
                                "siswa_tgl_lahir" => $value->siswa_tgl_lhr,
                                "siswa_jenjang" => $value->jenjang,
                                "siswa_angkatan" => $value->siswa_angkatan,
                                'siswa_updated_at' => $value->updated_at,
                            ]);
                            $count++;
                        }
                    }
                }
            }
            $this->mSync->create($count, $this->mLogin->getUserID(), 2);
            $message = "Sinkronisasi Perubahan Berhasil!";
        } catch (ClientException $clientException) {
            $message = $clientException->getResponse()->getBody();
        } catch (ServerException $serverException) {
            $message = $serverException->getResponse()->getBody();
        }
        $this->session->set_flashdata('message', $message);
        redirect(base_url('sync'));
    }
}