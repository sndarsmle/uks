<?php

class M_Jadwal extends CI_model
{

    function createRow($Data){
        $Kunjungan = [
            'hari' => $Data['form_hari'],
            'tgl_kunjungan' => $Data['form_tgl_kunjugan'],
            'jam_datang' => $Data['form_jam_datang'],
            'jam_keluar' => $Data['form_jam_keluar'],
            'idsiswa' => $Data['form_idsiswa'],
            'nama' => $Data['form_nama'],
            'kelas' => $Data['form_kelas'],
            'keluhan' => $Data['form_keluhan'],
            'penanganan' => $Data['form_penanganan'],
            'hasil' => $Data['form_hasil'],

        ];
        $result = $this->db->insert('kunjungan', $Kunjungan);
        return $result;
    }

    function findById($jadwalID){
        $this->db->select("id, periode_mcu");
        $this->db->from("jadwal_mcu");
        $this->db->where("id", $jadwalID);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;
    }

    function showAll(){
        $this->db->select("*");
        $this->db->from("jadwal_mcu");
        return $this->db->get()->result();
    }

    function showJadwalMcu()
    {
        $this->db->select('*');
        $this->db->from('jadwal_mcu');
        $this->db->join('tbl_thn_akademik', 'jadwal_mcu.thn_akademik_id = tbl_thn_akademik.thn_akademik_id', 'left');
        $this->db->join('th', 'jadwal_mcu.thn_akademik_id = th.thn_akademik_id', 'left');
//         select * from a INNER JOIN b on a.a = b.b;
// select a.*, b.*  from a,b where a.a = b.b;
        // $this->db->select('*');
        // $this->db->from('jadwal_mcu','tbl_thn_akademik');
       // $this->db->where("jadwal_mcu.thn_akademik_id = tbl_thn_akademik.thn_akademik_id");
        //$this->db->join('','inner');
        return $this->db->get()->result();
    }

    function simpanJadwalMcu($data)
    {
        $this->db->insert('jadwal_mcu',$data);
    }


    function updateRow2($id, $status){ 
        $this->db->set("status", $status);
        $this->db->where("id", $id);
        return $this->db->update("jadwal_mcu");
    }
    function hapusjadwal($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('jadwal_mcu');

    }

    function updateRow($Data){ //sek
        $this->db->set("minggu_jadwal", $Data['form_nama_jadwal']);
        $this->db->set("minggu_mulai", $Data['form_jadwal_mulai']);
        $this->db->set("minggu_selesai",$Data['form_jadwal_selesai']);
        $this->db->where("minggu_id", $Data['form_id']);
        return $this->db->update("minggu");
    }

    function getStatusOne($mingguID) //japus aja
    {       
        $this->db->select("minggu_active");
        $this->db->from('minggu');
        $this->db->where("minggu_id",$mingguID);
        $result= $this->db->get()->result();
        return $result;

    }

    function tahun_akademik()
    {
        $this->db->select('*');
        $this->db->from('tbl_thn_akademik');
        $this->db->where('thn_akademik_is_active',1);
        return $this->db->get()->result();
    }

}