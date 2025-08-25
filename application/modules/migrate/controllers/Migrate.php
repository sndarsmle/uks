<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migrate extends Middleware
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($number = 0)
    {
        switch ($number) {
            case 1:
                $this->load->model('migrate/M_Siswa', 'mMigrateSiswa');
                $this->mMigrateSiswa->up(1);
                break;
            case 2:
                $master_table = 'smp';
                $table_name = 'sma';
                $other_tables = [
                    'mcu_bersih',
                    'mcu_gizi_',
                    'mcu_lain',
                    'mcu_matatelinga',
                    'mcu_mulut',
                    'mcu_vital',
                ];
                foreach ($other_tables as $table) {
                    $this->db->query("CREATE TABLE {$table}{$table_name} LIKE {$table}{$master_table}");
                    $fields = $this->db->field_data("{$table}{$table_name}");

                    foreach ($fields as $field) {
                        $new_field_name = str_replace('smp', 'sma', $field->name);
                        $this->db->query("ALTER TABLE {$table}{$table_name} RENAME COLUMN $field->name TO {$new_field_name}");
                    }
                }
                echo "Migrate table for SMA module is success!<br>";
                break;
            default:
                show_404();
        }
    }
}