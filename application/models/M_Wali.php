<?php

class M_Wali extends CI_model
{
    

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

   function getPeriodeWali($kelas_rombel, $kelas_tingkat)
   {
        // $this->db->distinct();
        // $this->db->select('jadwal_mcu');
        // $this->db->from('coba_mcu');
         
        // return $this->db->get()->result();
        $this->db->order_by('tgl_periksa','desc');
        $this->db->select('COUNT(kode_mcu) AS jumlah, jadwal_mcu');
    //$this->db->select('*');
        $this->db->from('coba_mcu');
        $this->db->join('coba_siswa', 'coba_mcu.idsiswa=coba_siswa.idsiswa', 'left');
        $this->db->join('kelas', 'coba_mcu.idsiswa=kelas.siswa_id', 'left');
        $this->db->where('kelas_rombel',$kelas_rombel);
        $this->db->where('kelas_tingkat',$kelas_tingkat);
        $this->db->group_by('jadwal_mcu');
        return $this->db->get()->result();
       

   }

     function getPeriodeWaliNew($kelas_rombel, $kelas_tingkat)
     {
          $this->db->select('COUNT(mcu_id) AS jumlah, periode_monthName, periode_year,mcu.periode_id')
               ->from('mcu')
               ->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left')
               ->join('periode', 'mcu.periode_id=periode.periode_id', 'left')
               ->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left')
               ->join('tahun_akademik', 'thnAkademik_id', 'left')
               ->where('kelas_rombel',$kelas_rombel)
               ->where('kelas_tingkat',$kelas_tingkat)
               ->where('kelas_ta = thnAkademik_year')
               ->group_by('mcu.periode_id')
               ->order_by('periode_year, periode_created_at, periode_monthName', 'DESC');
          return $this->db->get()->result();
     }

     function getPeriodeWaliDcu($kelas_rombel, $kelas_tingkat)
     {
          $this->db->select('COUNT(dcu_code) AS jumlah, periode_monthName, periode_year,dcu.periode_id')
               ->from('dcu')
               ->join('siswa', 'dcu.siswa_id=siswa.siswa_id', 'left')
               ->join('periode', 'dcu.periode_id=periode.periode_id', 'left')
               ->join('kelas', 'dcu.siswa_id=kelas.siswa_id', 'left')
               ->join('tahun_akademik', 'thnAkademik_id', 'left')
               ->where('kelas_rombel',$kelas_rombel)
               ->where('kelas_tingkat',$kelas_tingkat)
               ->where('kelas_ta = thnAkademik_year')
               ->group_by('dcu.periode_id');
          return $this->db->get()->result();
     }

   function getPeriodeWaliKhususNew()
   {
        $this->db->select('COUNT(mcu_id) AS jumlah, periode_monthName, periode_year,mcu.periode_id')
               ->from('mcu')
               ->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left')
               ->join('periode', 'mcu.periode_id=periode.periode_id', 'left')
               ->join('tahun_akademik', 'thnAkademik_id', 'left')
               ->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left')
               ->where('kelas_ta = thnAkademik_year')
               ->where('(siswa.siswa_jenjang = 11 OR siswa.siswa_jenjang=22)')
               ->group_by('mcu.periode_id');
        return $this->db->get()->result();
       

   }
     function getPeriodeWaliKhususDcu()
     {
          $this->db->select('COUNT(dcu_id) AS jumlah, periode_monthName, periode_year,dcu.periode_id')
               ->from('dcu')
               ->join('siswa', 'dcu.siswa_id=siswa.siswa_id', 'left')
               ->join('periode', 'dcu.periode_id=periode.periode_id', 'left')
               ->join('tahun_akademik', 'thnAkademik_id', 'left')
               ->join('kelas', 'dcu.siswa_id=kelas.siswa_id', 'left')
               ->where('kelas_ta = thnAkademik_year')
               ->where('(siswa.siswa_jenjang = 11 OR siswa.siswa_jenjang=22)')
               ->group_by('dcu.periode_id');
          return $this->db->get()->result();
     }

   function getNotifFOllowup($kelas_rombel, $kelas_tingkat)
   {
        // $this->db->distinct();
        // $this->db->select('jadwal_mcu');
        // $this->db->from('coba_mcu');
         
        // return $this->db->get()->result();
        $this->db->order_by('tgl_periksa','desc');
        $this->db->select('COUNT(kode_mcu) AS jumlah, jadwal_mcu');
    //$this->db->select('*');
        $this->db->from('coba_mcu');
        $this->db->join('coba_siswa', 'coba_mcu.idsiswa=coba_siswa.idsiswa', 'left');
        $this->db->join('kelas', 'coba_mcu.idsiswa=kelas.siswa_id', 'left');
        $this->db->where('kelas_rombel',$kelas_rombel);
        $this->db->where('kelas_tingkat',$kelas_tingkat);
        $this->db->where('followup !=', '-');
        $this->db->where('status_followup !=', '2'); //1 = tidak 2 = sudah
        
        return $this->db->get()->result();
       

   }

   function getFollowUp($kelas_rombel, $kelas_tingkat)
   {


  //      $this->db->order_by('tgl_periksa','desc');
        $this->db->select('kode_mcu, coba_mcu.idsiswa, jadwal_mcu, nama, jadwal_mcu, kelas_rombel,kelas_tingkat, followup,status_followup');
        $this->db->from('coba_mcu');
        $this->db->join('coba_siswa', 'coba_mcu.idsiswa=coba_siswa.idsiswa', 'left');
        $this->db->join('kelas', 'coba_mcu.idsiswa=kelas.siswa_id', 'left');
        $this->db->where('kelas_rombel',$kelas_rombel);
        $this->db->where('kelas_tingkat',$kelas_tingkat);
        $this->db->where('followup !=', '-');
        $this->db->where('status_followup !=', '2'); //1 = tidak 2 = sudah
        
        return $this->db->get()->result();
   }
   function getFollowUpKhusus()
   {


  //      $this->db->order_by('tgl_periksa','desc');
           $this->db->select('kode_mcu, coba_mcu.idsiswa, jadwal_mcu, nama, jadwal_mcu, followup,status_followup, kelas_rombel, kelas_tingkat, jenjang');
        $this->db->from('coba_mcu');
        $this->db->join('coba_siswa', 'coba_mcu.idsiswa=coba_siswa.idsiswa', 'left');
        $this->db->join('kelas', 'coba_mcu.idsiswa=kelas.siswa_id', 'left');
        $this->db->where('siswa_jenjang','00');
        $this->db->or_where('siswa_jenjang', '11');
        $this->db->or_where('siswa_jenjang', '22');
        $this->db->where('followup !=', '-');
        $this->db->where('status_followup !=', '2'); //1 = tidak 2 = sudah
        
        return $this->db->get()->result();
   }


   function getTindakan($kelas_rombel, $kelas_tingkat)
   {


  //      $this->db->order_by('tgl_periksa','desc');
        $this->db->select('*');
        $this->db->from('tindakanfollowup');
        $this->db->join('kelas', 'tindakanfollowup.idsiswa=kelas.siswa_id', 'left');
       // $this->db->join('coba_siswa', 'coba_mcu.idsiswa=coba_siswa.idsiswa', 'left');
       // $this->db->join('kelas', 'coba_mcu.idsiswa=kelas.siswa_id', 'left');
        $this->db->where('kelas_rombel',$kelas_rombel);
        $this->db->where('kelas_tingkat',$kelas_tingkat);
        ///$this->db->where('followup !=', '-');
        //$this->db->where('status_followup !=', '2'); //1 = tidak 2 = sudah
        
        return $this->db->get()->result();
   }

   function getTindakanKhusus()
   {


      //  $this->db->select('kode_mcu, coba_mcu.idsiswa, jadwal_mcu, nama, jadwal_mcu, followup,status_followup, kelas_rombel, kelas_tingkat, jenjang');
    //    $this->db->select('*');
        $this->db->select('tindakanfollowup.idsiswa, tindakanfollowup.kode_mcu, tindakanfollowup.followup, tindakanfollowup.status_followup, hasil_followup, tgl_followup, coba_mcu.jadwal_mcu, nama, kelas_rombel, kelas_tingkat, jenjang');
        $this->db->from('tindakanfollowup');
        $this->db->join('kelas', 'tindakanfollowup.idsiswa=kelas.siswa_id', 'left');
        $this->db->join('coba_siswa', 'tindakanfollowup.idsiswa=coba_siswa.idsiswa', 'left');
        $this->db->join('coba_mcu', 'tindakanfollowup.idsiswa=coba_mcu.idsiswa', 'left');
        //$this->db->join('coba_siswa', 'coba_mcu.idsiswa=coba_siswa.idsiswa', 'left');
       // $this->db->join('kelas', 'coba_mcu.idsiswa=kelas.siswa_id', 'left');
        $this->db->where('jenjang','00');
        $this->db->or_where('jenjang', '11');
        $this->db->or_where('jenjang', '22');
        //$this->db->where('followup !=', '-');
       // $this->db->where('status_followup !=', '2'); //1 = tidak 2 = sudah
        
        return $this->db->get()->result();
   }

   function getAllWali($kelas_rombel,$kelas_tingkat)
   {
    $this->db->select('*');
    $this->db->from('coba_mcu'); 
    $this->db->join('coba_siswa', 'coba_mcu.idsiswa=coba_siswa.idsiswa', 'left');
    $this->db->join('kelas', 'coba_mcu.idsiswa=kelas.siswa_id', 'left');
    $this->db->where('kelas_rombel',$kelas_rombel);
    $this->db->where('kelas_tingkat',$kelas_tingkat);
    $this->db->group_by('coba_mcu.kode_periksa_mcu');
    $this->db->order_by('tgl_periksa','desc');         
    return  $this->db->get()->result(); 

   }

function getAllWaliPeriode($kelas_rombel,$kelas_tingkat,$periode)
   {
    $this->db->select('*');
    $this->db->from('coba_mcu'); 
    $this->db->join('coba_siswa', 'coba_mcu.idsiswa=coba_siswa.idsiswa', 'left');
    $this->db->join('kelas', 'coba_mcu.idsiswa=kelas.siswa_id', 'left');
    $this->db->where('kelas_rombel',$kelas_rombel);
    $this->db->where('kelas_tingkat',$kelas_tingkat);
    $this->db->where('jadwal_mcu',$periode);
    $this->db->group_by('coba_mcu.kode_periksa_mcu');
    $this->db->order_by('tgl_periksa','desc');         
    return  $this->db->get()->result(); 

   }

   function getAllWaliFollowUp($kelas_rombel,$kelas_tingkat)
   {
    $this->db->select('*');
    $this->db->from('coba_mcu'); 
    $this->db->join('coba_siswa', 'coba_mcu.idsiswa=coba_siswa.idsiswa', 'left');
    $this->db->join('kelas', 'coba_mcu.idsiswa=kelas.siswa_id', 'left');
    $this->db->where('kelas_rombel',$kelas_rombel);
    $this->db->where('kelas_tingkat',$kelas_tingkat);
    $this->db->where('followup !=', '-');
    $this->db->where('status_followup !=', '2'); //1 = tidak 2 = sudah
    $this->db->group_by('coba_mcu.kode_periksa_mcu');
    $this->db->order_by('tgl_periksa','desc');         
    return  $this->db->get()->result(); 

   }

   function getOnePeriodeWali($periode, $kelas_tingkat, $kelas_rombel)
   {
    $this->db->select('*');
    $this->db->from('coba_mcu');
    $this->db->join('coba_siswa', 'coba_mcu.idsiswa = coba_siswa.idsiswa', 'left');
    $this->db->join('kelas', 'coba_mcu.idsiswa=kelas.siswa_id', 'left');
    $this->db->where('kelas_rombel',$kelas_rombel);
    $this->db->where('kelas_tingkat',$kelas_tingkat);
    $this->db->where('jadwal_mcu',$periode);          
      
    return $this->db->get()->result();
   }

function getOnePeriodeWaliNew($periode, $kelas_tingkat, $kelas_rombel){
     $this->db->select('*')
          ->from('mcu')
          ->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left')
          ->join('periode','mcu.periode_id=periode.periode_id', 'left')
          ->join('tahun_akademik', 'thnAkademik_id', 'left')
          ->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left')
          ->where('kelas_rombel',$kelas_rombel)
          ->where('kelas_tingkat',$kelas_tingkat)
          ->where('kelas_ta = thnAkademik_year')
          ->where('mcu.periode_id',$periode);          
     return $this->db->get()->result();
}


     function getOneDcuPeriodeWali($periode_id, $kelas_tingkat, $kelas_rombel)
     {
          $this->db->select('*')
               ->from('dcu')
               ->join('siswa', 'dcu.siswa_id=siswa.siswa_id', 'left')
               ->join('periode', 'dcu.periode_id=periode.periode_id', 'left')
               ->join('kelas', 'dcu.siswa_id=kelas.siswa_id', 'left')
               ->join('tahun_akademik', 'thnAkademik_id', 'left')
               ->where('kelas_rombel',$kelas_rombel)
               ->where('kelas_tingkat',$kelas_tingkat)
               ->where('dcu.periode_id',$periode_id)
               ->where('kelas_ta = thnAkademik_year');            
          return $this->db->get()->result();
     }

     function getOnePeriodeWaliKhususNew($periode_id){
          $this->db->select('*')
                    ->from('mcu')
                    ->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left')
                    ->join('periode', 'mcu.periode_id=periode.periode_id', 'left')
                    ->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left')
                    ->where('siswa_jenjang',"22")
                    ->or_where('siswa_jenjang',"11")
                    ->where('mcu.periode_id',$periode_id);          
          return $this->db->get()->result();
     }

     function getOneDcuPeriodeWaliKhusus($periode_id){
          $this->db->select('*')
                    ->from('dcu')
                    ->join('siswa', 'dcu.siswa_id=siswa.siswa_id', 'left')
                    ->join('periode', 'dcu.periode_id=periode.periode_id', 'left')
                    ->join('kelas', 'dcu.siswa_id=kelas.siswa_id', 'left')
                    ->where('siswa_jenjang',"22")
                    ->or_where('siswa_jenjang',"11")
                    ->where('dcu.periode_id',$periode_id);          
          return $this->db->get()->result();
     }

     function simpanTindakan($dataa)
     {
      $this->db->insert('tindakanfollowup',$dataa);
     }


   function updateRow2($kode_mcu, $status){ //hapus aja
        $this->db->set("status_followup", $status);
        $this->db->where("kode_mcu", $kode_mcu);
        return $this->db->update("coba_mcu");
    }

     function getOnePeriodeMcuKhusus($periode_id)
     {
          $this->db->select('count(mcu_id) as jumlah_siswa, CONCAT(kelas.kelas_tingkat, kelas.kelas_rombel) as kelas, periode_id,kelas.kelas_tingkat, kelas.kelas_rombel,siswa.siswa_jenjang as jenjang, mcu_isfinish, dokter_id')
               ->from('mcu')
               ->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left')
               ->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left')
               ->join('periode', 'periode_id', 'left')
               ->join('tahun_akademik', 'thnAkademik_id', 'left')
               ->where('periode_id',$periode_id)
               ->where('kelas_ta = thnAkademik_year')
               ->where('(siswa.siswa_jenjang = 11 OR siswa.siswa_jenjang=22)')
               ->group_by('kelas, jenjang, kelas.kelas_tingkat, kelas.kelas_rombel');
          return $this->db->get()->result();
     }

     function getOnePeriodeDcuKhusus($periode_id)
     {
          $this->db->select('count(dcu_code) as jumlah_siswa, CONCAT(kelas.kelas_tingkat, kelas.kelas_rombel) as kelas, periode_id,kelas.kelas_tingkat, kelas.kelas_rombel,siswa.siswa_jenjang as jenjang, dcu_isfinish, dokter_id')
               ->from('dcu')
               ->join('siswa', 'dcu.siswa_id=siswa.siswa_id', 'left')
               ->join('kelas', 'dcu.siswa_id=kelas.siswa_id', 'left')
               ->join('periode', 'periode_id', 'left')
               ->join('tahun_akademik', 'thnAkademik_id', 'left')
               ->where('kelas_ta = thnAkademik_year')
               ->where('periode_id',$periode_id)
               ->where('(siswa.siswa_jenjang = 11 OR siswa.siswa_jenjang=22)')
               ->group_by('kelas');
          return $this->db->get()->result();
     }
     
     function getOneClassOnePeriodeDcu($kelas_tingkat,$kelas_rombel,$periode)
     {
          $this->db->select('*')
               ->from('dcu')
               ->join('siswa', 'dcu.siswa_id=siswa.siswa_id', 'left')
               ->join('periode','dcu.periode_id=periode.periode_id', 'left')
               ->join('kelas', 'dcu.siswa_id=kelas.siswa_id', 'left')
               ->join('tahun_akademik', 'thnAkademik_id', 'left')
               ->where('kelas_ta = thnAkademik_year')
               ->where('kelas_rombel',$kelas_rombel)
               ->where('kelas_tingkat',$kelas_tingkat)
               ->where('dcu.periode_id',$periode);
          return $this->db->get()->result();
     }

    function getOneClassOnePeriodeMcu($kelas_tingkat,$kelas_rombel,$periode)
    {
        $this->db->select('*')
               ->from('mcu')
               ->join('siswa', 'mcu.siswa_id=siswa.siswa_id', 'left')
               ->join('periode','mcu.periode_id=periode.periode_id', 'left')
               ->join('kelas', 'mcu.siswa_id=kelas.siswa_id', 'left')
               ->join('tahun_akademik', 'thnAkademik_id', 'left')
               ->where('kelas_ta = thnAkademik_year')
               ->where('kelas_rombel',$kelas_rombel)
               ->where('kelas_tingkat',$kelas_tingkat)
               ->where('mcu.periode_id',$periode);
        return $this->db->get()->result();
    }


   

} 