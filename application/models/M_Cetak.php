<?php

class M_Cetak extends CI_model
{
    function createscreeningSiswa($data)
    {
            $this->db->insert('skriningg',$data);

    }

    function getAllBasicSiswa()
    {
        $this->db->select('idsiswa,nis,nama');
        $this->db->from('coba_siswa');
        return $this->db->get()->result();
    }

    function getOneSiswa($idsiswa)
    {
        $this->db->select('*');
        $this->db->from('coba_siswa');
        $this->db->where('idsiswa',$idsiswa);
        return $this->db->get()->result();


    }
   
   function getdatemcu($idsiswa)
   {
        $this->db->select('*');
        $this->db->from('coba_mcu');
        $this->db->where('idsiswa',$idsiswa);
        return $this->db->get()->result();
    

   }

   function getdatedental($idsiswa)
   {
        $this->db->select('*');
        $this->db->from('odontogram_lanjutan');
        $this->db->where('idsiswa',$idsiswa);
        return $this->db->get()->result();
    

   }

   function getNama($idsiswa)
   {
    $this->db->select('nama, nis');
    $this->db->from('coba_siswa');
    $this->db->where('idsiswa',$idsiswa);
    return $this->db->get()->result();
    

   }

   function getOdontogramLanjutan($id_pemeriksaan)
   {
        $this->db->select('*');
        $this->db->from('odontogram_lanjutan');
        $this->db->where('id_pemeriksaan',$id_pemeriksaan);
        return $this->db->get()->result();
    

   }

   function getOdontogram($id_pemeriksaan)
   {
        $this->db->select('*');
        $this->db->from('odontogram');
        $this->db->where('id_pemeriksaan',$id_pemeriksaan);
        return $this->db->get()->result();
    

   }

   function getPeriode()
   {
        // $this->db->distinct();
        // $this->db->select('jadwal_mcu');
        // $this->db->from('coba_mcu');
         
        // return $this->db->get()->result();
        $this->db->order_by('tgl_periksa','desc');
        $this->db->select('COUNT(kode_mcu) AS jumlah, jadwal_mcu');
    //$this->db->select('*');
        $this->db->from('coba_mcu');
        $this->db->group_by('jadwal_mcu');
        return $this->db->get()->result();




   }

   function getOnePeriode($periode)
   {
    $this->db->select('*');
    $this->db->from('coba_mcu');
    $this->db->join('coba_siswa', 'coba_mcu.idsiswa = coba_siswa.idsiswa', 'left');
    $this->db->where('jadwal_mcu',$periode);          
      
    return $this->db->get()->result();
   }


   function getKunjunganMonthly()
   {
    $this->db->order_by('tgl_kunjungan','desc');
    $this->db->select('COUNT(idkunjungan) AS jumlah, tgl_kunjungan');
    //$this->db->select('*');
    $this->db->from('kunjungan');
    $this->db->group_by('MONTH(tgl_kunjungan), YEAR(tgl_kunjungan), tgl_kunjungan');
    return $this->db->get()->result();
   }

   function getBulanan($month,$year)
   {
    $this->db->order_by('tgl_kunjungan','desc');
    $this->db->select('*');
    $this->db->where('MONTH(tgl_kunjungan)',$month);
    $this->db->where('YEAR(tgl_kunjungan)',$year);
    //$this->db->select('*');
    $this->db->from('kunjungan');
    //$this->db->group_by('MONTH(tgl_kunjungan), YEAR(tgl_kunjungan)');
    return $this->db->get()->result();

   }

    function getDetailJumlahHarian($tgl_periksa)
    {
        //$this->db->select("jadwal_mcu, COUNT(idsiswa) as jumlah_siswa, CONCAT(kelas.kelas_tingkat, kelas_rombel) as kelas");
        $this->db->select('tgl_periksa, count(kode_mcu) as jumlah_siswa, CONCAT(kelas.kelas_tingkat, kelas_rombel) as kelas');
        $this->db->from('coba_mcu');
        $this->db->join('coba_siswa', 'coba_mcu.idsiswa=coba_siswa.idsiswa', 'left');
        $this->db->join('kelas', 'coba_mcu.idsiswa=kelas.siswa_id', 'left');
        $this->db->where('tgl_periksa',$tgl_periksa);
        $this->db->group_by('kelas');
        return $this->db->get()->result();


    }

    function getJumlahHarian($periode_mcu)
    {

        $this->db->join('coba_siswa', 'coba_mcu.idsiswa=coba_siswa.idsiswa', 'left');
        $this->db->join('kelas', 'coba_mcu.idsiswa=kelas.siswa_id', 'left');   
        $this->db->select('tgl_periksa, tgl_periksa as tgl, count( DISTINCT CONCAT(kelas.kelas_tingkat, kelas_rombel)) as jumlah_kelas, count(kode_mcu) as jumlah_siswa, CONCAT(kelas.kelas_tingkat, kelas_rombel) as kelas');
        $this->db->from('coba_mcu');
        // $this->db->join('coba_siswa', 'coba_mcu.idsiswa=coba_siswa.idsiswa', 'left');
        // $this->db->join('kelas', 'coba_mcu.idsiswa=kelas.siswa_id', 'left');
 //       count(CONCAT(kelas.kelas_tingkat, kelas_rombel)) as jumlah_kelas'
        $this->db->where('jadwal_mcu',$periode_mcu);
        // $this->db->group_by('kelas');
        $this->db->group_by('tgl_periksa');       
        return $this->db->get()->result();


    }

    function pathTtd($dokter)
    {
     $this->db->select('*');
    $this->db->from('tabel_dokter');
 
    $this->db->where('nama_dokter',$dokter);          
      
    return $this->db->get()->result();
    }


} 