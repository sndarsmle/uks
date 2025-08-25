<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

/**
 * Summary of NewStudentKB
 * @property CI_Input $input service to get input variable from codeigniter 3
 * @property CI_Session $session service to handle session based on codeigniter 3
 * @property Blade $blade service to render view with external blade libraries
 * @property M_LaporanKegiatan $mLaporanKegiatan model based on codeigniter model
 */

class Laporan extends Middleware {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Login', 'mLogin');
        $this->load->model('thakademik/M_Thakademik', 'mAkademik');
        $this->load->model('thakademik/M_Periode', 'mPeriode');
        $this->load->model('M_LaporanKegiatan', 'mLaporanKegiatan');
    }
    
    function index(){
        $data['title'] = "Laporan Kegiatan";
        $data['menu'] = 'LK';
        $data['tahun_akademik'] = $this->mAkademik->showAllSummary();
        $this->blade->render('laporan', $data);
    }

    function tahun($thnID){
        $data['title'] = "Laporan Kegiatan";
        $data['menu'] = 'LK';
        $data['tahun_akademik'] = $this->mPeriode->showSummaryByParentId($thnID);
        $this->blade->render('laporan_periode', $data);
    }

    function detail($periode_id, $periode_name){
        $this->load->helper('jenjang_helper');
        $this->load->helper('kegiatan_helper');

        $data['title'] = "Laporan Kegiatan";
        $data['menu'] = 'LK';
        if ($periode_name == "MCU" || $periode_name == "SCR") {
            $data['content']= $this->mLaporanKegiatan->showSummaryPeriodeMCUSCR($periode_id);
        }
        elseif ($periode_name=="DCU") {
            $data['content']= $this->mLaporanKegiatan->showSummaryPeriodeDCU($periode_id);
        }
        $data['kegiatan'] = $periode_name;
        $this->blade->render('kegiatan/kegiatan', $data);
    }

    /**
     * @param string $classLevel
     * @param string $groupName
     * @param string $periode
     * @param string $schoolLevel
     * @return void
     */
    public function detailMCUSCR(string $classLevel, string $groupName, string $periode, string $schoolLevel): void
    {
        $this->load->helper('kegiatan_helper');
        $cleanGroupName = urldecode($groupName);

        $data['title'] = "Laporan Kegiatan";
        $data['menu'] = 'LK';
        $data['content']= $this->mLaporanKegiatan->showDetailPeriodeMCUSCR($classLevel, $cleanGroupName, $periode, $schoolLevel);
        $data['kegiatan'] = "MCU";
        $data['level'] = $schoolLevel;
        $this->blade->render('kegiatan/kegiatan_detail', $data);
    }

    /**
     * @param string $classLevel
     * @param string $groupName
     * @param string $periode
     * @param string $schoolLevel
     * @return void
     */
    public function detailDCU(string $classLevel, string $groupName, string $periode, string $schoolLevel): void
    {
        $this->load->helper('kegiatan_helper');
        $cleanGroupName = urldecode($groupName);

        $data['title'] = "Laporan Kegiatan";
        $data['menu'] = 'LK';
        $data['content']= $this->mLaporanKegiatan->showDetailPeriodeDCU($classLevel, $cleanGroupName, $periode, $schoolLevel);
        $data['kegiatan'] = "DCU";
        $this->blade->render('kegiatan/kegiatan_detail', $data);
    }

    function exportRMCUAll($periode_id, $periode_name)
    {
        $this->load->model('cetak/M_CetakMcu', 'mCMcu');
        $this->load->model('M_LaporanKegiatan', 'mLaporanKegiatan');
        $this->load->helper('jenjang_helper');
        if ($periode_name == "MCU" || $periode_name == "SCR") {
            $data['kegiatan']= $this->mLaporanKegiatan->showSummaryPeriodeMCUSCR($periode_id);
        }
        elseif ($periode_name=="DCU") {
            $data['kegiatan']= $this->mLaporanKegiatan->showSummaryPeriodeDCU($periode_id);
        }

        $spreadsheet = new Spreadsheet();
        foreach ($data['kegiatan'] as $key => $data_kegiatan) {
            if ($key == 0) {
                $spreadsheet->getSheet(0)->setTitle(formatJenjang($data_kegiatan->jenjang).' - '.$data_kegiatan->kelas);
            } else {
                $spreadsheet->createSheet()->setTitle(formatJenjang($data_kegiatan->jenjang).' - '.$data_kegiatan->kelas);
            }
            $data['title'] = "Detail Laporan " . $periode_name . " Kelas " . $data_kegiatan->kelas_tingkat . $data_kegiatan->kelas_rombel;
            $data['content'] = $this->mCMcu->getReport($periode_id, $data_kegiatan->kelas_tingkat, $data_kegiatan->kelas_rombel, $data_kegiatan->jenjang);
            $sheet = $spreadsheet->setActiveSheetIndex($key);

            $sheet->setCellValue('A1', $data['title'])->mergeCells('A1:Z1');
            $sheet->setCellValue('A2', 'No');
            $sheet->setCellValue('B2', 'NIS');
            $sheet->setCellValue('C2', 'Nama');
            $sheet->setCellValue('D2', 'Kelas');
            $sheet->setCellValue('E2', 'Berat Badan (kg)');
            $sheet->setCellValue('F2', 'Tinggi Badan (cm)');
            $sheet->setCellValue('G2', 'Lingkar Kepala (cm)');
            $sheet->setCellValue('H2', 'Lingkar Lengan Atas (cm)');
            $sheet->setCellValue('I2', 'Lingkar Perut (cm)');
            $sheet->setCellValue('J2', 'IMT');
            $sheet->setCellValue('K2', 'Status Gizi');
            if ($data_kegiatan->jenjang == "22" || $data_kegiatan->jenjang == "11") {
                $sheet->setCellValue('L2', 'BB/U');
            } else {
                $sheet->setCellValue('L2', 'BB/U (Stunting)');
            }
            $sheet->setCellValue('M2', 'Tanda Klinis Anemi');
            
            $i = 3;
            foreach ($data['content'] as $key => $value) {
                $sheet->setCellValue('A'.$i, $i-2);
                $sheet->setCellValue('B'.$i, $value->siswa_nis);
                $sheet->setCellValue('C'.$i, $value->siswa_nama);
                $sheet->setCellValue('D'.$i, $value->kelas_tingkat.$value->kelas_rombel);
                $sheet->setCellValue('E'.$i, $value->bb);
                $sheet->setCellValue('F'.$i, $value->tb);
                $sheet->setCellValue('G'.$i, $value->lk);
                $sheet->setCellValue('H'.$i, $value->lla);
                $sheet->setCellValue('I'.$i, $value->lp);
                $sheet->setCellValue('J'.$i, $value->pimt);
                $sheet->setCellValue('K'.$i, $value->status_gizi_text);
                if ($data_kegiatan->jenjang == "22" || $data_kegiatan->jenjang == "11") {
                    $sheet->setCellValue('L'.$i, $value->bbperu_text);
                } else {
                    $sheet->setCellValue('L'.$i, $value->stun_text);
                }
                $sheet->setCellValue('M'.$i, $value->anemia_text);
                $i++;
            }

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);
            $sheet->getColumnDimension('H')->setAutoSize(true);
            $sheet->getColumnDimension('I')->setAutoSize(true);
            $sheet->getColumnDimension('J')->setAutoSize(true);
            $sheet->getColumnDimension('K')->setAutoSize(true);
            $sheet->getColumnDimension('L')->setAutoSize(true);
            $sheet->getColumnDimension('M')->setAutoSize(true);
        }

        $spreadsheet->setActiveSheetIndex(0);
        $filename = "List Laporan ".$periode_name."_".date('Y-m-d_H.i.s', time()).".xlsx";
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'"'); 
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $writer->save('php://output');
    }

    function exportRMCU($kelas_tingkat, $kelas_rombel, $periode_id, $jenjang)
    {
        $this->load->model('cetak/M_CetakMcu', 'mCMcu');
        $data['title'] = "Detail Laporan MCU / Screening " . $kelas_tingkat . $kelas_rombel;
        $data['content'] = $this->mCMcu->getReport($periode_id, $kelas_tingkat, $kelas_rombel, $jenjang);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $nama_detail = str_replace("/", "" , $data['title']);
        $sheet->setCellValue('A1', $nama_detail)->mergeCells('A1:Z1');
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'NIS');
        $sheet->setCellValue('C2', 'Nama');
        $sheet->setCellValue('D2', 'Kelas');
        $sheet->setCellValue('E2', 'Berat Badan (kg)');
        $sheet->setCellValue('F2', 'Tinggi Badan (cm)');
        $sheet->setCellValue('G2', 'Lingkar Kepala (cm)');
        $sheet->setCellValue('H2', 'Lingkar Lengan Atas (cm)');
        $sheet->setCellValue('I2', 'Lingkar Perut (cm)');
        $sheet->setCellValue('J2', 'IMT');
        $sheet->setCellValue('K2', 'Status Gizi');
        if ($jenjang == "22" || $jenjang == "11") {
            $sheet->setCellValue('L2', 'BB/U');
        } else {
            $sheet->setCellValue('L2', 'BB/U (Stunting)');
        }
        $sheet->setCellValue('M2', 'Tanda Klinis Anemi');
        
        $i = 3;
        foreach ($data['content'] as $key => $value) {
            $sheet->setCellValue('A'.$i, $i-2);
            $sheet->setCellValue('B'.$i, $value->siswa_nis);
            $sheet->setCellValue('C'.$i, $value->siswa_nama);
            $sheet->setCellValue('D'.$i, $value->kelas_tingkat.$value->kelas_rombel);
            $sheet->setCellValue('E'.$i, $value->bb);
            $sheet->setCellValue('F'.$i, $value->tb);
            $sheet->setCellValue('G'.$i, $value->lk);
            $sheet->setCellValue('H'.$i, $value->lla);
            $sheet->setCellValue('I'.$i, $value->lp);
            $sheet->setCellValue('J'.$i, $value->pimt);
            $sheet->setCellValue('K'.$i, $value->status_gizi_text);
            if ($jenjang == "22" || $jenjang == "11") {
                $sheet->setCellValue('L'.$i, $value->bbperu_text);
            } else {
                $sheet->setCellValue('L'.$i, $value->stun_text);
            }
            $sheet->setCellValue('M'.$i, $value->anemia_text);
            $i++;
        }

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);

        $filename = "List ".$nama_detail."_".date('Y-m-d_H.i.s', time()).".xlsx";
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'"'); 
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $writer->save('php://output');
    }

    function exportRekapDokter($periode_id, $periode_name)
    {
        $this->load->model('M_LaporanRekapDokter', 'mLaporanRekapDokter');

        if ($periode_name == "MCU" || $periode_name == "SCR") {
            $rekap_dokter = $this->mLaporanRekapDokter->showSummaryDoctorPeriodeMCUSCR($periode_id);
        }
        elseif ($periode_name=="DCU") {
            $rekap_dokter = $this->mLaporanRekapDokter->showSummaryDoctorPeriodeDCU($periode_id);
        }

        // group by dokter username
        $temp = [];
        foreach($rekap_dokter as $data) {
            $temp[$data->dokter_username][] = $data;
        }

        $rekap_dokter = $temp;
        unset($temp);

        $spreadsheet = new Spreadsheet();
        $sheet_index = 0;
        foreach ($rekap_dokter as $key => $data) {
            $sheet_title = (strlen($data[0]->dokter_fullname) > 31) ? substr($data[0]->dokter_fullname, 0, 30) : ($data[0]->dokter_fullname ?? '-');
            if ($key == array_key_first($rekap_dokter)) {
                $spreadsheet->getSheet(0)->setTitle($sheet_title);
            } else {
                $spreadsheet->createSheet()->setTitle($sheet_title);
            }
            $sheet = $spreadsheet->setActiveSheetIndex($sheet_index);

            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Username');
            $sheet->setCellValue('C1', 'Dokter');
            $sheet->setCellValue('D1', 'Nama');
            $sheet->setCellValue('E1', 'NIS');
            $sheet->setCellValue('F1', 'Kelas');
            $sheet->setCellValue('G1', 'REF');

            $sheet->getStyle('A1:G1')->getFont()->setBold(true);

            $i = 2;
            foreach ($data as $key => $value) {
                $sheet->setCellValue('A'.$i, $key+1);
                $sheet->setCellValue('B'.$i, $value->dokter_username);
                $sheet->setCellValue('C'.$i, $value->dokter_fullname);
                $sheet->setCellValue('D'.$i, $value->siswa_nama);
                $sheet->setCellValue('E'.$i, $value->siswa_nis);
                $sheet->setCellValue('F'.$i, $value->siswa_kelas);
                $sheet->setCellValue('G'.$i, ($value->mcu_code ?? $value->dcu_code) ?? '-');
                $i++;
            }
            $i--;

            $sheet->getStyle("A2:A{$i}")->getFont()->setBold(true);

            foreach(range('A','G') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }

            $sheet->getStyle("A1:G{$i}")
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color(Color::COLOR_BLACK));

            $sheet->setSelectedCells('A1');

            $sheet_index++;
        }

        $spreadsheet->setActiveSheetIndex(0);
        $filename = "Rekap Dokter Periode ".$periode_name."_".date('Y-m-d_H.i.s', time()).".xlsx";
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'"'); 
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $writer->save('php://output');
    }
}