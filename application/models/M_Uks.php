<?php
 
class M_Uks extends CI_model
{
    private $table = 'uks';
    
    function login($Data)
    {
        $this->db->select("uss, psw, nama_lengkap");
        $this->db->from($this->table);
        $this->db->where("uss", $Data['username']);
        $User = $this->db->get()->result();
        if($User){
            $User = $User[0];
            if($Data['password']== $User->psw){
                // unset($User->psw);
                $this->session->set_userdata( (array) $User);
                $this->session->set_userdata( ['skrining' => TRUE ] );
               echo $Data['password'];
                 return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function logout() {
        $this->session->sess_destroy();
    }

    function getNameUser(){
        return $this->session->userdata()['uss'];
    }

    function isLogin()
    {
        if( count( $this->session->userdata() ) == 0 ){
            return FALSE;
        }else if( ! isset( $this->session->userdata['skrining'] ) ){
            return FALSE;
        }else if( $this->session->userdata['skrining']  ){
            return TRUE;
        } 
    }
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
    
function getOneSiswaNis($nis)
    {
        $this->db->select('*')
        //$this->db->from('coba_siswa');
        //$this->db->where('nis',$nis);
         ->from('coba_siswa')
                ->join('kelas', 'siswa_id = idsiswa', 'LEFT')
                ->where("nis", $nis);
        return $this->db->get()->result();


    }

    function saveScreening($dataa)
    {
        $this->db->insert('coba_skreening',$dataa);
    }

    

     function saveMcu($dataa)
    {
        return $this->db->insert('coba_mcu',$dataa);
    }

    function saveOdontogram($dataa)
    {
        return $this->db->insert('odontogram',$dataa);
    }

    function saveOdontogramLanjutan($dataa2)
    {
        return $this->db->insert('odontogram_lanjutan',$dataa2);
    }

    function getOneMcu($kodeperiksamcu)
    {
        $this->db->select('*');
        $this->db->from('coba_mcu');
        $this->db->where('kode_periksa_mcu',$kodeperiksamcu);
        return $this->db->get()->result();

    }

    function getOneMcukode($kode_mcu, $gender)
    {
        $this->db->select('*');
        $this->db->from('coba_mcu');
        if ($gender=="L") {
            $this->db->join('imt_laki', '(coba_mcu.usia_tahun = imt_laki.tahun_usia AND coba_mcu.usia_bulan = imt_laki.bulan_usia)','left');
        }
        if($gender=='P')
        {
             $this->db->join('imt_perempuan', 'coba_mcu.usia_tahun = imt_perempuan.tahun_usia AND coba_mcu.usia_bulan = imt_perempuan.bulan_usia','left');     
        }
       
        $this->db->where('kode_mcu',$kode_mcu);



        return $this->db->get()->result();
        //$this->db->select('*');
        //$this->db->from('blogs');
        
        //$query = $this->db->get();

    }
    function getTglLhr($nis)
    {
        $this->db->select('tgl_lahir');
        $this->db->from('coba_siswa');
        $this->db->where('nis',$nis);
        return $this->db->get()->result();
    }
     function getTglMcu($kode_periksa_mcu)
    {
        $this->db->select('tgl_periksa');
        $this->db->from('coba_mcu');
        $this->db->where('kode_periksa_mcu',$kode_periksa_mcu);
        return $this->db->get()->result();
    }

    function getTglMcuKode($kode_mcu)
    {
        $this->db->select('tgl_periksa');
        $this->db->from('coba_mcu');
        $this->db->where('kode_mcu',$kode_mcu);
        return $this->db->get()->result();
    }

         function grafik($nis,$gender)
    {
        $this->db->distinct();
        $this->db->select('imt, jadwal_mcu, tgl_periksa, kurus, ideal, batas_atas as berlebih,nis');
        $this->db->from('coba_mcu');
        if ($gender=="L") {
            $this->db->join('imt_laki', 'coba_mcu.usia_tahun = imt_laki.tahun_usia AND coba_mcu.usia_bulan = imt_laki.bulan_usia','left');
        }
        else
        {
            $this->db->join('imt_perempuan', 'coba_mcu.usia_tahun = imt_perempuan.tahun_usia AND coba_mcu.usia_bulan = imt_perempuan.bulan_usia','left');
        }
        
        // $this->db->where('kode_mcu',$kode_mcu);
        // return $this->db->get()->result();
        $this->db->where('nis',$nis);
        $this->db->order_by('tgl_periksa','ASC');
        return $this->db->get()->result();

    }

    function limitPeriodeMcu($idsiswa)
    {
        $this->db->select('jadwal_mcu');
        $this->db->from('coba_mcu');
        $this->db->where('idsiswa',$idsiswa);
        return $this->db->get()->result();

    }

    function updateMcu($dataa,$kode_mcu)
    {
        $this->db->where('kode_mcu', $kode_mcu);
        $this->db->update('coba_mcu', $dataa);

    }


    function limitPeriodeMcuNis($niss)
    {
        $this->db->select('jadwal_mcu');
        $this->db->from('coba_mcu');
        $this->db->where('nis',$niss);
        return $this->db->get()->result();

    }

    function getJadwalMcu()
    {
        $this->db->select('*');
        $this->db->from('jadwal_mcu');
        $this->db->where('status',1);
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

   function getTglDental($id_pemeriksaan)
    {
        $this->db->select('date_time');
        $this->db->from('odontogram_lanjutan');
        $this->db->where('id_pemeriksaan',$id_pemeriksaan);
        return $this->db->get()->result();
    }

    function tgl_indo($tanggal)
    {
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    
    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun
 
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }

    function getIMT()
    {
        $this->db->select('*');
        $this->db->from('imt');
        return $this->db->get()->result();
    }

    function getIMTLaki()
    {
        $this->db->select('*');
        $this->db->from('imt_laki');
        return $this->db->get()->result();
    }

    function getIMTPerempuan()
    {
        $this->db->select('*');
        $this->db->from('imt_perempuan');
        return $this->db->get()->result();
    }

    function saveKunjungan($dataa)
    {
    
        $this->db->insert('kunjungan',$dataa);
    
    }

   




} 