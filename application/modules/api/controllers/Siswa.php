
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends Middleware {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Login', 'mLogin');
        $this->load->model('M_SiswaAPI', 'mSiswaAPI');
        $this->load->model('siswa/M_Siswa', 'mSiswa');
    }

    function liveSearch(){
        if($this->input->post()){
            $jenjang = $this->input->get('key');
            $name = $this->input->post('searchTerm');
            $siswa = $this->mSiswaAPI->showByUnique($name, $jenjang);
            $data = array();
            foreach ($siswa as $row) {
                $data[] = array("id"=>$row->idsiswa, "text"=>$row->nis." | ".$row->nama);
            } 
            echo json_encode($data);    
        }
    }

    function liveSearch2(){
        if($this->input->post()){
            $jenjang = $this->input->get('key');
            $name = $this->input->post('searchTerm');
            $siswa = $this->mSiswa->showByUnique($name, $jenjang);
            $options = array();
            foreach ($siswa as $data) {
                $options[] = array("id"=>$data->siswa_id, "text"=>$data->siswa_nis." | ".$data->siswa_nama);
            } 
            echo json_encode($options);    
        }
    }
}