
<?php

class M_CetakDcu extends CI_model
{
   

    function createRow($Data){
        $lainsd = [
            'mcu_id' => $Data['form_id'],
            'mental' => $Data['mental'],
            'saran' => $Data['saran'],
            'kesimpulan' => $Data['kesimpulan'],
            'followup' => $Data['followup'],
        ];
        $result = $this->db->insert($this->table, $lainsd);
        return $result;
    }

    function findByParentId($mcuID){
        $this->db->select("*")
                ->from($this->table)
                ->where("mcu_id", $mcuID);
        $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;
    }

    function updateRow($Data){
        $lainsd = [
                    'mental' => $Data['mental'],
                    'saran' => $Data['saran'],
                    'kesimpulan' => $Data['kesimpulan'],
                    'followup' => $Data['followup'],
        ];
        $this->db->where("mcu_id", $Data['form_id']);
        $result = $this->db->update($this->table, $lainsd);
        return $result;
    }
    function getNama($idsiswa)
   {
    $this->db->select('siswa_nama, siswa_nis');
    $this->db->from('siswa');
    $this->db->where('siswa_id',$idsiswa);
    $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;
    

   }
   function getdatedcu($idsiswa)
   {
        $this->db->select('*');
        $this->db->from('dcu')
            ->join("periode","periode_id","LEFT")
            ->where('siswa_id',$idsiswa)
            ->order_by("dcu_created_at", "DSC");

         $result = $this->db->get()->result();
         return $result;
    

   }
   function getIdSiswa($mcu_id)
   {
    $this->db->select('siswa_id');
    $this->db->from('dcu');
    $this->db->where('dcu_id',$mcu_id);
    $result = $this->db->get()->result();
        if($result){
            $result = $result[0];
        }
        return $result;

   }
   function getIdSiswaArray($mcu_id)
   {
    $this->db->select('siswa_id');
    $this->db->from('mcu');
    $this->db->where('mcu_id',$mcu_id);
    $result = $this->db->get()->result_array();
        if($result){
            $result = $result[0];
        }
        return $result;

   }
   function getOneDcuKode($dcu_id)
   {
    $this->db->distinct();
    
    $this->db->select("*")
                ->from('dcu')
                ->join("dcu_detail","dcu_id","LEFT");
                
     

        $this->db->join("siswa","dcu.siswa_id = siswa.siswa_id","LEFT")
                ->join('kelas', 'dcu.siswa_id = kelas.siswa_id', 'LEFT')
                ->join("periode","periode_id","LEFT")
                

                ->where("dcu_id", $dcu_id);
                return $this->db->get()->result();
   }
   function getDiagnose($dcu_id)
   {
     $this->db->select("*")
                ->from('dcu_diagnosis')
                ->join('diagnose_gigi', 'kode_diagnose = dcuDiag_diag', 'LEFT')
                ->where("dcu_id", $dcu_id);
                return $this->db->get()->result();

   }
}