<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class Dashboard extends Middleware {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Login', 'mLogin');
    }

    function index(){
        $data['title'] = "Dashboard";
        $data['menu']  = 'D00';
        $data['smenu'] = '';
        $data['user']  = $this->mLogin->getNameUser();
        $data['role']  = $this->mLogin->getUserRole();
        $this->blade->render('dashboard', $data);
    }

    public function exportSiswaToExcel()
    {
        $this->load->model('thakademik/M_Thakademik', 'mThakademik');
        $this->load->model('siswa/M_Siswa', 'mSiswa');
        $this->load->model('siswa/M_Kelas', 'mKelas');

        $this->load->helper('jenjang_helper');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $activeTa = $this->mThakademik->getActive();
        $listKelas = $this->mKelas->getListKelas();

        foreach ($listKelas as $key => $data_kelas) {
            if ($key === 0) {
                $spreadsheet->getSheet(0)->setTitle(formatJenjang($data_kelas->siswa_jenjang) . ' - ' . $data_kelas->kelas_tingkat . $data_kelas->kelas_rombel);
            } else {
                $spreadsheet->createSheet()->setTitle(formatJenjang($data_kelas->siswa_jenjang) . ' - ' . $data_kelas->kelas_tingkat . $data_kelas->kelas_rombel);
            }
            $params = [
                'thnAkademik_year' => $activeTa->thnAkademik_year,
                'kelas_tingkat' => $data_kelas->kelas_tingkat,
                'kelas_rombel' => $data_kelas->kelas_rombel,
                'jenjang' => $data_kelas->siswa_jenjang,
            ];
            $dataSiswa = $this->mSiswa->getSummarySiswa($params);
            $sheet = $spreadsheet->setActiveSheetIndex($key);

            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Nama');
            $sheet->setCellValue('C1', 'Kelas');
            $sheet->setCellValue('D1', 'Jenis Kelamin');
            $sheet->setCellValue('E1', 'Usia');

            $sheet->getStyle("A1:E1")->getFont()->setBold(true);

            $i = 2;
            foreach ($dataSiswa as $index => $value) {
                $sheet->setCellValue('A'.$i, $i-1);
                $sheet->setCellValue('B'.$i, $value->nama);
                $sheet->setCellValue('C'.$i, $value->kelas);
                $sheet->setCellValue('D'.$i, $value->kelamin);
                $sheet->setCellValue('E'.$i, "{$value->siswa_umurTahun} Tahun {$value->siswa_umurBulan} Bulan");
                $i++;
            }
            $i--;

            foreach(range('A','E') as $columnID) {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            }

            $sheet->getStyle("A1:E{$i}")
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color(Color::COLOR_BLACK));

            $sheet->setSelectedCells('A1');
        }

        $spreadsheet->setActiveSheetIndex(0);
        $filename = "Rekap Data Siswa ".date('Y-m-d_H.i.s').".xlsx";
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"{$filename}\"");
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}