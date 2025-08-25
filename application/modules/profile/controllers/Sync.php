<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;

class Sync extends Middleware
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('siswa/M_Siswa', 'mSiswa');
        $this->load->helper('jenjang');
        $this->load->helper('kegiatan');
    }

    /**
     * @throws JsonException|GuzzleException
     */
    public function index($siswa_id)
    {
        $siswa = $this->mSiswa->get($siswa_id);
        $new_siswa = $this->getSiswaFromSIA($siswa_id);
        if (
            $siswa->siswa_nama !== $new_siswa->siswa_nama_full ||
            $siswa->siswa_kelamin !== $new_siswa->siswa_kelamin ||
            $siswa->siswa_tgl_lahir !== $new_siswa->siswa_tgl_lhr ||
            $siswa->siswa_jenjang !== $new_siswa->jenjang ||
            $siswa->siswa_angkatan !== $new_siswa->siswa_angkatan
        ) {
            $new_siswa->updated_at = date('Y-m-d H:i:s');
            $this->mSiswa->update($siswa_id, [
                "siswa_nama" => $new_siswa->siswa_nama_full,
                "siswa_kelamin" => $new_siswa->siswa_kelamin,
                "siswa_tgl_lahir" => $new_siswa->siswa_tgl_lhr,
                "siswa_jenjang" => $new_siswa->jenjang,
                "siswa_angkatan" => $new_siswa->siswa_angkatan,
                "siswa_status" => $new_siswa->siswa_isactive,
                'siswa_updated_at' => $new_siswa->updated_at,
            ]);
        }
        $message = "Sinkronisasi Perubahan Berhasil!";
        $this->session->set_flashdata('message', $message);
        redirect(base_url("profile/siswa/{$siswa_id}"));
    }

    /**
     * @throws JsonException|GuzzleException
     */
    public function preview($siswa_id)
    {
        $title = "Preview Sinkronasi Data";
        $menu = 'PS';
        $siswa = $this->mSiswa->get($siswa_id);
        $new_siswa = $this->getSiswaFromSIA($siswa_id);
        $this->blade->render('sync/preview', compact(
            'title',
            'menu',
            'siswa',
            'new_siswa',
        ));
    }

    /**
     * @throws JsonException|GuzzleException
     */
    private function getSiswaFromSIA($siswa_id)
    {
        $base_url = "http://sia.test";
        $client = new \GuzzleHttp\Client([
            'base_uri' => "{$base_url}/openAPI/",
        ]);
        $key = "RXEZ03r2JwDeNLxHWBP5zgFhYctf84";
        $siswa = $this->mSiswa->get($siswa_id);
        try {
            $response = $client->get(
                "siswa",
                [
                    'query' => [
                        'key' => $key,
                        'id' => $siswa_id,
                        'level' => $siswa->siswa_jenjang
                    ]
                ]
            );
            $result = json_decode((string)$response->getBody(), false, 512, JSON_THROW_ON_ERROR);
            $new_siswa = $result?->data;
            $new_siswa->jenjang = $siswa->siswa_jenjang;
            $new_siswa->siswa_angkatan = substr($new_siswa->siswa_angkatan, -2);
            return $new_siswa;
        } catch (ClientException $clientException) {
            $clientException->getResponse()->getBody();
        } catch (ServerException $serverException) {
            $serverException->getResponse()->getBody();
        }
        return false;
    }
}