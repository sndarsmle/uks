<?php

class M_Statistik extends CI_model
{
  
    function pesertaMcuLaki($periode_id)
    {       
     $this->db->select('count(mcu_id) as jumlah');
        $this->db->from('mcu');
        $this->db->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left');
        $this->db->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left');
        $this->db->where('periode_id',$periode_id);
        $this->db->where('siswa_kelamin','L');
        
        $result =$this->db->get()->result(); 
        return $result[0];
    }

    function pesertaMcuPerempuan($periode_id)
    {
        $this->db->select('count(mcu_id) as jumlah');
        $this->db->from('mcu');
        $this->db->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left');
        $this->db->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left');
        $this->db->where('periode_id',$periode_id);
        $this->db->where('siswa_kelamin','P');
        
        $result =$this->db->get()->result(); 
        return $result[0];

    }
    function pesertaDcuLaki($periode_id)
    {       
     $this->db->select('count(dcu_id) as jumlah');
        $this->db->from('dcu');
        $this->db->join('siswa', 'dcu.siswa_id=siswa.siswa_id', 'left');
        $this->db->join('kelas', 'dcu.siswa_id=kelas.siswa_id', 'left');
        $this->db->where('periode_id',$periode_id);
        $this->db->where('siswa_kelamin','L');
        
        $result =$this->db->get()->result(); 
        return $result[0];
    }

    function pesertaDcuPerempuan($periode_id)
    {
        $this->db->select('count(dcu_id) as jumlah');
        $this->db->from('dcu');
        $this->db->join('siswa', 'dcu.siswa_id=siswa.siswa_id', 'left');
        $this->db->join('kelas', 'dcu.siswa_id=kelas.siswa_id', 'left');
        $this->db->where('periode_id',$periode_id);
        $this->db->where('siswa_kelamin','P');
        
        $result =$this->db->get()->result(); 
        return $result[0];

    }
    function imtsangatkurus($periode_id)
    {
        $where = "mcu_gizi_sd.status_gizi='1' OR mcu_gizi_smp.status_gizi='1' OR mcu_gizi_dckbtk.status_gizi='1' ";

        $this->db->select('count(mcu_id) as jumlah');
        $this->db->from('mcu');
        $this->db->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left');
        $this->db->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left')
        ->join("mcu_gizi_sd","mcu_id","LEFT")
        ->join("mcu_gizi_smp","mcu_id","LEFT")
        ->join("mcu_gizi_dckbtk","mcu_id","LEFT");
        $this->db->where('periode_id',$periode_id);

        $this->db->where($where);
        
        $result =$this->db->get()->result(); 
        return $result[0];
    }
    function imtkurus($periode_id)
    {
        $where = "mcu_gizi_sd.status_gizi='2' OR mcu_gizi_smp.status_gizi='2' OR mcu_gizi_dckbtk.status_gizi='2'";

        $this->db->select('count(mcu_id) as jumlah');
        $this->db->from('mcu');
        $this->db->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left');
        $this->db->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left')
        ->join("mcu_gizi_sd","mcu_id","LEFT")
        ->join("mcu_gizi_smp","mcu_id","LEFT")
        ->join("mcu_gizi_dckbtk","mcu_id","LEFT");
        $this->db->where('periode_id',$periode_id);

        $this->db->where($where);
        
        $result =$this->db->get()->result(); 
        return $result[0];
    }
    function imtideal($periode_id)
    {
        $where = "mcu_gizi_sd.status_gizi='3' OR mcu_gizi_smp.status_gizi='3' OR mcu_gizi_dckbtk.status_gizi='3'";

        $this->db->select('count(mcu_id) as jumlah');
        $this->db->from('mcu');
        $this->db->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left');
        $this->db->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left')
        ->join("mcu_gizi_sd","mcu_id","LEFT")
        ->join("mcu_gizi_smp","mcu_id","LEFT")
        ->join("mcu_gizi_dckbtk","mcu_id","LEFT");
        $this->db->where('periode_id',$periode_id);

        $this->db->where($where);
        
        $result =$this->db->get()->result(); 
        return $result[0];
    }
    function imtberlebih($periode_id)
    {
        $where = "mcu_gizi_sd.status_gizi='4' OR mcu_gizi_smp.status_gizi='4' OR mcu_gizi_dckbtk.status_gizi='4'";

        $this->db->select('count(mcu_id) as jumlah');
        $this->db->from('mcu');
        $this->db->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left');
        $this->db->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left')
        ->join("mcu_gizi_sd","mcu_id","LEFT")
        ->join("mcu_gizi_smp","mcu_id","LEFT")
        ->join("mcu_gizi_dckbtk","mcu_id","LEFT");
        $this->db->where('periode_id',$periode_id);

        $this->db->where($where);
        
        $result =$this->db->get()->result(); 
        return $result[0];
    }
    function imtsangatberlebih($periode_id)
    {
        $where = "mcu_gizi_sd.status_gizi='5' OR mcu_gizi_smp.status_gizi='5' OR mcu_gizi_dckbtk.status_gizi='5'";

        $this->db->select('count(mcu_id) as jumlah');
        $this->db->from('mcu');
        $this->db->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left');
        $this->db->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left')
        ->join("mcu_gizi_sd","mcu_id","LEFT")
        ->join("mcu_gizi_smp","mcu_id","LEFT")
        ->join("mcu_gizi_dckbtk","mcu_id","LEFT");
        $this->db->where('periode_id',$periode_id);

        $this->db->where($where);
        
        $result =$this->db->get()->result(); 
        return $result[0];
    }
    
}