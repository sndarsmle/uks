<?php

class M_Checkup extends CI_model
{
    private $table = "checkup";

    function getAll($checkup_periode_id)
    {
        return $this->db
            ->select('
                checkup.id
                , checkup.kuku
                , checkup.ket_kuku
                , checkup.telinga
                , checkup.ket_telinga
                , checkup.mulut
                , checkup.ket_mulut
                , checkup.hidung
                , checkup.ket_hidung
                , checkup.kulit
                , checkup.ket_kulit
                , siswa.siswa_nis
                , siswa.siswa_nama
            ')
            ->from($this->table)
            ->join("siswa", "checkup.siswa_id = siswa.siswa_id")
            ->where([
                "checkup.checkup_periode_id" => $checkup_periode_id
            ])
            ->order_by("siswa.siswa_nama", "ASC")
            ->get()
            ->result();
    }

    function get($checkup_periode_id, $siswa_id)
    {
        return $this->db
            ->select('
                checkup.id
                , checkup.kuku
                , checkup.ket_kuku
                , checkup.telinga
                , checkup.ket_telinga
                , checkup.mulut
                , checkup.ket_mulut
                , checkup.hidung
                , checkup.ket_hidung
                , checkup.kulit
                , checkup.ket_kulit
                , siswa.siswa_nis
                , siswa.siswa_nama
            ')
            ->from($this->table)
            ->join("siswa", "checkup.siswa_id = siswa.siswa_id")
            ->where([
                "checkup.checkup_periode_id" => $checkup_periode_id,
                "checkup.siswa_id" => $siswa_id,
            ])
            ->get()
            ->row();
    }

    function insert($data)
    {
        $checkup = array();
        $i = 0;
        foreach ($data->siswa as $d) {
            $checkup[$i]['id'] = generateUUID();
            $checkup[$i]['checkup_periode_id'] = $data->checkup_periode_id;
            $checkup[$i]['siswa_id'] = $d->siswa_id;
            $i++;
        }
        return $this->db->insert_batch($this->table, $checkup);
    }

    function update($data)
    {
        $checkup = array(
            'kuku' => $data['kuku'],
            'ket_kuku' => $data['ket_kuku'],
            'telinga' => $data['telinga'],
            'ket_telinga' => $data['ket_telinga'],
            'mulut' => $data['mulut'],
            'ket_mulut' => $data['ket_mulut'],
            'hidung' => $data['hidung'],
            'ket_hidung' => $data['ket_hidung'],
            'kulit' => $data['kulit'],
            'ket_kulit' => $data['ket_kulit'],
            'updated_at' => date('Y-m-d H:i:s', time())
        );
        $this->db->update($this->table, $checkup, ['id' => $data['id']]);
        return $this->db->affected_rows();
    }

    function deleteByCheckUpPeriodeId($checkup_periode_id)
    {
        return $this->db->delete($this->table, [
            'checkup_periode_id' => $checkup_periode_id
        ]);
    }
}
