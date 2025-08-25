<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Wali extends Middleware
{

    public function __construct()
    {
	    parent::__construct();
        $this->load->model('M_Login', 'mUks');
        $this->load->model('M_Uks', 'mUKS');
        $this->load->model('M_Jadwalscreening', 'mJadwalS');
        $this->load->model('M_Cetak', 'mCetak');
        $this->load->model('M_Wali', 'mWali');
        $this->load->model('siswa/M_Siswa', 'mSiswa');
        $this->load->model('M_Login', 'mLogin');
        $this->load->model('thakademik/M_Thakademik', 'mAkademik');
    }

    public function index()
    {
        $jenjang = $this->session->userdata['jenjang'];
        $kelas_rombel = $this->session->userdata['kelas_rombel'];
        $kelas_tingkat = $this->session->userdata['kelas_tingkat'];

        if ($jenjang == "22" || $jenjang == "11") {
            $jenjangg = "";
            if ($jenjang == "22") {
                $jenjangg = "TK";
            } else {
                $jenjangg = "KB";
            }
            $data['title'] = "Laporan MCU / Screening Jenjang " . $jenjangg;
            $data['periode'] = $this->mWali->getPeriodeWaliKhususNew($jenjang);
        } else {
            $data['title'] = "Laporan MCU / Screening Kelas " . $kelas_tingkat . $kelas_rombel;

            $data['periode'] = $this->mWali->getPeriodeWaliNew($kelas_rombel, $kelas_tingkat);
        }
        $data['menu'] = '';
        $data['smenu'] = '';
        $data['role'] = $this->session->userdata['user_role'];
        $this->blade->render('mcu/summary', $data);
    }

    public function detailMCUSCR($periode_id)
    {
        $jenjang = $this->session->userdata['jenjang'];
        $kelas_rombel = $this->session->userdata['kelas_rombel'];
        $kelas_tingkat = $this->session->userdata['kelas_tingkat'];
        if ($jenjang == "22" || $jenjang == "11") {
            $this->load->helper('jenjang_helper');
            $jenjangg = "";
            if ($jenjang == "22") {
                $jenjangg = "TK";
            } else {
                $jenjangg = "KB";
            }
            $data['title'] = "Detail Laporan MCU / Screening Jenjang " . $jenjangg;
            $data['menu'] = 'CMCU';
            $data['smenu'] = '';
            $data['role'] = $this->session->userdata['user_role'];
            $data['content'] = $this->mWali->getOnePeriodeMcuKhusus($periode_id);
            $this->blade->render('mcu/detail_v2', $data);
        } else {
            $data['title'] = "Detail Laporan MCU / Screening " . $kelas_tingkat . $kelas_rombel;
            $data['menu'] = 'CMCU';
            $data['smenu'] = '';
            $data['role'] = $this->session->userdata['user_role'];
            $data['content'] = $this->mWali->getOnePeriodeWaliNew($periode_id, $kelas_tingkat, $kelas_rombel);
            $this->blade->render('mcu/detail', $data);
        }
    }

    public function detailMCUSCR2($kelas_tingkat, $kelas_rombel, $periode)
    {
        $data['title'] = "Detail Laporan MCU / Screening Kelas " . $kelas_tingkat . $kelas_rombel;
        $data['menu'] = 'CMCU';
        $data['smenu'] = '';
        $data['role'] = $this->session->userdata['user_role'];
        $data['content'] = $this->mWali->getOneClassOnePeriodeMcu($kelas_tingkat, $kelas_rombel, $periode);
        $this->blade->render('mcu/detail', $data);
    }

    public function dcu()
    {
        $kelas_rombel = $this->session->userdata['kelas_rombel'];
        $kelas_tingkat = $this->session->userdata['kelas_tingkat'];
        $jenjang = $this->session->userdata['jenjang'];

        if ($jenjang == "22" || $jenjang == "11") {
            $jenjangg = "";
            if ($jenjang == "22") {
                $jenjangg = "TK";
            } else {
                $jenjangg = "KB";
            }
            $data['title'] = "List DCU jenjang " . $jenjangg;
            $data['menu'] = '';
            $data['smenu'] = '';
            $data['role'] = $this->session->userdata['user_role'];
            $data['periode'] = $this->mWali->getPeriodeWaliKhususDcu();
        } else {
            $data['title']      = "Laporan DCU Kelas " . $kelas_tingkat . $kelas_rombel;
            $data['periode'] = $this->mWali->getPeriodeWaliDcu($kelas_rombel, $kelas_tingkat);
        }
        $data['menu'] = 'CDCU';
        $data['smenu'] = '';
        $data['role'] = $this->mLogin->getUserRole();
        $this->blade->render('dcu/summary', $data);
    }

    public function detailDCU($periode_id)
    {
        $jenjang = $this->session->userdata['jenjang'];
        $kelas_rombel = $this->session->userdata['kelas_rombel'];
        $kelas_tingkat = $this->session->userdata['kelas_tingkat'];
        if ($jenjang == "22" || $jenjang == "11") {
            $this->load->helper('jenjang_helper');

            $jenjangg = "";
            if ($jenjang == "22") {
                $jenjangg = "TK";
            } else {
                $jenjangg = "KB";
            }
            $data['title'] = "Laporan Dental Check Up Jenjang " . $jenjangg;
            $data['menu'] = 'CDCU';
            $data['smenu'] = '';
            $data['role'] = $this->session->userdata['user_role'];
            $data['content'] = $this->mWali->getOnePeriodeDcuKhusus($periode_id);
            $this->blade->render('dcu/detail_v2', $data);
        } else {
            $jenjang = $this->session->userdata['jenjang'];
            $kelas_rombel = $this->session->userdata['kelas_rombel'];
            $kelas_tingkat = $this->session->userdata['kelas_tingkat'];
            $data['title'] = "Laporan Dental Check Up Kelas " . $kelas_tingkat . $kelas_rombel;
            $data['menu'] = 'CDCU';
            $data['smenu'] = '';
            $data['role'] = $this->session->userdata['user_role'];
            $data['content'] = $this->mWali->getOneDcuPeriodeWali($periode_id, $kelas_tingkat, $kelas_rombel);
            $this->blade->render('dcu/detail', $data);
        }
    }

    public function detailDCU2($kelas_tingkat, $kelas_rombel, $periode)
    {
        $data['title'] = "Detail Dental Check Up Kelas " . $kelas_tingkat . $kelas_rombel;
        $data['menu'] = 'CMCU';
        $data['smenu'] = '';
        $data['role'] = $this->session->userdata['user_role'];
        $data['content'] = $this->mWali->getOneClassOnePeriodeDcu($kelas_tingkat, $kelas_rombel, $periode);
        $this->blade->render('dcu/detail', $data);
    }

    public function all()
    {
        $data['title'] = "Riwayat Medical Check Up";
        $data['menu'] = 'CMCU';
        $data['smenu'] = '';
        //  $data['notif'] = $this->mWali->getNotifFOllowup($kelas_rombel, $kelas_tingkat);
        $data['role'] = $this->mLogin->getUserRole();
        $kelas_rombel = $this->session->userdata['kelas_rombel'];
        $kelas_tingkat = $this->session->userdata['kelas_tingkat'];
        //$periode            = $this->input->post('periode');
        //$periode = str_replace('_', ' ', $periode);
        $data['content'] = $this->mWali->getAllWali($kelas_rombel, $kelas_tingkat);
        //$data['content']    = $this->mWali->getPeriodeWali($kelas_rombel, $kelas_tingkat);    
        //  var_dump($data['content']);
        //var_dump($kelas_tingkat); 

        $this->blade->render('semua', $data);
        // $this->blade->render('skreening', $data);
        // $this->blade->render('skreening', $data);
    }

    public function listperiode()
    {
        $jenjang = $this->session->userdata['jenjang'];
        $kelas_rombel = $this->session->userdata['kelas_rombel'];
        $kelas_tingkat = $this->session->userdata['kelas_tingkat'];

        if ($jenjang == "22" || $jenjang == "11") {
            $jenjangg = "";
            if ($jenjang == "22") {
                $jenjangg = "TK";
            } else {
                $jenjangg = "KB";
            }

            $data['title'] = "List MCU jenjang " . $jenjangg;
            $data['menu'] = '';
            //$data['notif'] = $this->mWali->getNotifFOllowup($kelas_rombel, $kelas_tingkat);
            $data['smenu'] = '';
            $data['role'] = $this->session->userdata['user_role'];

            $data['periode'] = $this->mWali->getPeriodeWaliKhususNew();
            //var_dump($data['periode']);
            $this->blade->render('listperiodewali', $data);
        } else {
            $data['title'] = "List MCU Kelas " . $kelas_tingkat . $kelas_rombel;
            $data['menu'] = '';
            // $data['notif'] = $this->mWali->getNotifFOllowup($kelas_rombel, $kelas_tingkat);
            $data['smenu'] = '';
            $data['role']  = $this->session->userdata['user_role'];
            $data['periode'] = $this->mWali->getPeriodeWali($kelas_rombel, $kelas_tingkat);
            $this->blade->render('listperiodewali', $data);
        }
    }

    public function listperbulan($periode)
    {
        $jenjang = $this->session->userdata['jenjang'];
        $kelas_rombel = $this->session->userdata['kelas_rombel'];
        $kelas_tingkat = $this->session->userdata['kelas_tingkat'];
        if ($jenjang == "22" || $jenjang == "11") {
            $jenjangg = "";
            if ($jenjang == "22") {
                $jenjangg = "TK";
            } else {
                $jenjangg = "KB";
            }
            $data['title'] = "Riwayat Medical Check jenjang " . $jenjangg;
            $data['menu'] = 'CMCU';
            //$data['notif'] = $this->mWali->getNotifFOllowup($kelas_rombel, $kelas_tingkat);
            $data['smenu'] = '';
            $data['role'] = $this->session->userdata['user_role'];
            $periode = str_replace('_', ' ', $periode);
            $data['content'] = $this->mWali->getOnePeriodeWaliKhusus($periode);
        } else {
            $data['title'] = "Riwayat Medical Check Up Kelas" . $kelas_tingkat . $kelas_rombel . " Periode " . $periode;
            $data['menu'] = 'CMCU';
            $data['smenu'] = '';
            $data['role'] = $this->session->userdata['user_role'];
            // $data['notif'] = $this->mWali->getNotifFOllowup($kelas_rombel, $kelas_tingkat);
            //$periode = str_replace('_', ' ', $periode);
            $data['content'] = $this->mWali->getOnePeriodeWali($periode, $kelas_tingkat, $kelas_rombel);
        }
        $this->blade->render('v_perkelas', $data);
    }

    public function listfollowup()
    {
        $jenjang = $this->session->userdata['jenjang'];
        $kelas_rombel = $this->session->userdata['kelas_rombel'];
        $kelas_tingkat = $this->session->userdata['kelas_tingkat'];
        if ($jenjang == "22" || $jenjang == "11") {
            $jenjangg = "";
            if ($jenjang == "22") {
                $jenjangg = "TK";
            } else {
                $jenjangg = "KB";
            }
            $data['title'] = "Daftar siswa yang perlu dilakukan follow up jenjang TK dan KB";
            $data['menu'] = '';
            $data['smenu'] = '';
            $data['role'] = $this->session->userdata['user_role'];
            $data['content'] = $this->mWali->getFollowUpKhusus($jenjang);
        } else {
            $data['title'] = "Daftar siswa yang perlu dilakukan follow up" . $kelas_tingkat . $kelas_rombel;
            $data['menu'] = '';
            $data['smenu'] = '';
            $data['role'] = $this->session->userdata['user_role'];
            $data['content'] = $this->mWali->getFollowUp($kelas_rombel, $kelas_tingkat);
        }

        $this->blade->render('listfollowup', $data);
        //       var_dump($jenjang);
    }

    public function listtindakan()
    {
        $jenjang = $this->session->userdata['jenjang'];
        $kelas_rombel = $this->session->userdata['kelas_rombel'];
        $kelas_tingkat = $this->session->userdata['kelas_tingkat'];
        if ($jenjang == "22" || $jenjang == "11") {
            $jenjangg = "";
            if ($jenjang == "22") {
                $jenjangg = "TK";
            } else {
                $jenjangg = "KB";
            }
            $data['title'] = "Daftar tindakan followup yang sudah dilakukan jenjang TK dan KB";
            $data['menu'] = '';
            $data['smenu'] = '';
            $data['role'] = $this->session->userdata['user_role'];
            $data['content'] = $this->mWali->getTindakanKhusus();
        } else {
            $data['title'] = "Daftar tindakan follow up yang sudah dilakukan kelas " . $kelas_tingkat . $kelas_rombel;
            $data['menu'] = '';
            $data['smenu'] = '';
            $data['role'] = $this->session->userdata['user_role'];
            $data['content'] = $this->mWali->getTindakan($kelas_rombel, $kelas_tingkat);
        }
        foreach ($data['content'] as $key => $hasil) {
            $hasil->tgl_followup = $this->mUKS->tgl_indo($hasil->tgl_followup);
        };

        $this->blade->render('listtindakan', $data);
        //      var_dump($data['content']);
    }

    public function status($kode_mcu, $status)
    {
        if ($status == 1) {
            $this->mWali->updateRow2($kode_mcu, 2);
        } else {
            $this->mWali->updateRow2($kode_mcu, 1);
        }
        redirect(base_url('wali/listfollowup'));
    }

    public function logout()
    {
        $this->mLogin->logout();
        redirect(base_url());
    }

    public function precetakmcu($niss, $kode_mcu)
    {
        if ($this->mUks->isLogin()) {
            # code...
            $data['title'] = "pracetak Medical Check Up";
            $data['menu'] = 'CMCU';
            $data['smenu'] = '';
            $gender = "";
            //$nis                = $this->input->post('nis');
            //$tanggal_mcu        = $this->input->post('tanggal_mcu');
            //$kodemcu            = $nis.$tanggal_mcu;
            //$data['basicsiswa'] = $this->mUKS->getOnesiswaNis($nis);
            $data['basicsiswa'] = $this->mUKS->getOnesiswaNis($niss);
            $jk = $data['basicsiswa'][0]->jenis_kelamin;
            if ($jk == "L") {
                $tabel_imt = "imt_laki";
            } else {
                $tabel_imt = "imt_perempuan";
            }
            //$data['content']    = $this->mUKS->getOneMcu($kodemcu);
            $data['content'] = $this->mUKS->getOneMcuKode($kode_mcu, $tabel_imt);
            //$a                  = $this->mUKS->getTglLhr($nis);
            $a = $this->mUKS->getTglLhr($niss);
            $b = $this->mUKS->getTglMcuKode($kode_mcu);
            $cek = $a[0]->tgl_lahir;
            $cek2 = $b[0]->tgl_periksa;
            $data['tanggal_lhr'] = $this->mUKS->tgl_indo($cek);
            $data['tanggal_mcu'] = $this->mUKS->tgl_indo($cek2);
            $data['grafik'] = $this->mUKS->grafik($niss, $tabel_imt);
            //var_dump($data['grafik']);
            //var_dump($tabel_imt);
            $this->blade->render('pracetakmcu', $data);
            // $this->blade->render('skreening', $data);
            // $this->blade->render('skreening', $data);
        } else {
            $data['title'] = "Login";
            $data['hasil'] = '2';
            $data['smenu'] = '';
            $this->blade->render('login', $data);
        }
    }

    public function  precetakdcu($mcu_id)
    {
        $data['title'] = "Pracetak Medical Check Up";
        $data['menu'] = 'Cetak MCU';
        $data['smenu'] = '';
        $data['user'] = $this->mLogin->getNameUser();
        $data['role'] = $this->mLogin->getUserRole();
        $siswa_id = $this->mCDcu->getIdSiswa($mcu_id);
        $data['basicsiswa'] = $this->mSiswa->findByIdd($siswa_id->siswa_id);
        $data['basicsiswaa'] = $this->mSiswa->findById($siswa_id->siswa_id);
        $jk = $data['basicsiswaa']->siswa_kelamin;
        $jenjang = $data['basicsiswaa']->siswa_jenjang;
        $data['jenjang'] = $jenjang;
        $data['tanggal_lhr'] = $this->mUKS->tgl_indo($data['basicsiswaa']->siswa_tgl_lahir);
        $data['content'] = $this->mCDcu->getOneDcuKode($mcu_id);
        $data['diagnose'] = $this->mCDcu->getDiagnose($mcu_id);

        $this->blade->render('pracetakdcu', $data);
    }

    public function mcu_periode()
    {
        $data['title'] = "Cetak data mcu";
        $data['menu'] = 'CMCU';
        $data['smenu'] = '';
        $data['periode'] = $this->mCetak->getPeriode();
        //$data['content'] = $this->mUKS->getAllBasicSiswa();
        // var_dump($data['periode']);
        $this->blade->render('mcu_periode', $data);
    }

    public function getallwali()
    {
        if ($this->mUks->isLogin()) {
            # code...
        } else {
            $data['title'] = "Login";
            $data['hasil'] = '2';
            $data['smenu'] = '';
            $this->blade->render('login', $data);
        }
    }

    public function kunjungan_bulanan()
    {
        if ($this->mUks->isLogin()) {
            # code...
            $data['title'] = "Cetak Laporan Kunjungan UKS Bulanan";
            $data['menu'] = 'CMCU';
            $data['smenu'] = '';

            $data['content'] = $this->mCetak->getKunjunganMonthly();
            //var_dump($data['content']);      
            $this->blade->render('kunjunganbulanan', $data);
            // $this->blade->render('skreening', $data);
            // $this->blade->render('skreening', $data);
        } else {
            $data['title'] = "Login";
            $data['hasil'] = '2';
            $data['smenu'] = '';
            $this->blade->render('login', $data);
        }
    }

    public function lihat_kunjungan_bulanan($month, $year)
    {
        $data['title'] = "Cetak Laporan Kunjungan UKS Bulanan";
        $data['menu'] = 'CMCU';
        $data['smenu'] = '';
        $data['content'] = $this->mCetak->getBulanan($month, $year);
        foreach ($data['content'] as $key => $hasil) {
            $hasil->tgl_kunjungan = $this->mUKS->tgl_indo($hasil->tgl_kunjungan);
        };
        //var_dump($data['content']);
        $this->blade->render('lihat_kunjungan_bulanan', $data);
    }


    public function tindakan_followup()
    {
        $status_followup = $this->input->post('status_followup');
        $kode_mcu = $this->input->post('kode_mcu');
        $dataa = array(
            'idsiswa' => $this->input->post('idsiswa'),
            'kode_mcu' => $kode_mcu,
            'nama_wali' => $this->input->post('nama_wali'),
            'followup' => $this->input->post('followup'),
            'status_followup' => $status_followup,
            'hasil_followup' => $this->input->post('tindakan_followup'),
            'tgl_followup' => $this->input->post('tgl_followup')
        );
        $this->mWali->simpanTindakan($dataa);

        if ($status_followup == 1) {
            $this->mWali->updateRow2($kode_mcu, 2);
        } else {
            $this->mWali->updateRow2($kode_mcu, 1);
        }
        //      var_dump($dataa);
        // $this->mUKS->saveScreening($dataa);
        echo "<script type='text/javascript'>alert('Data Berhasil Disimpan');</script>";
        // redirect(base_url('wali/listfollowup'));
        $this->listfollowup();
    }

    public function excel_bulanan($month, $year)
    {
        $data['content']   = $this->mCetak->getBulanan($month, $year);
        $bulan = "";
        if ($month == '01') {
            $bulan = 'Januari';
            # code...
        } else if ($month == '02') {
            $bulan = 'Februari';
            # code...
        } else if ($month == '03') {
            $bulan = 'Maret';
            # code...
        } else if ($month == '04') {
            $bulan = 'April';
            # code...
        } else if ($month == '05') {
            $bulan = 'Mei';
            # code...
        } else if ($month == '06') {
            $bulan = 'Juni';
            # code...
        } else if ($month == '07') {
            $bulan = 'Juli';
            # code...
        } else if ($month == '08') {
            $bulan = 'Agustus';
            # code...
        } else if ($month == '09') {
            $bulan = 'September';
            # code...
        } else if ($month == '10') {
            $bulan = 'Oktober';
            # code...
        } else if ($month == '11') {
            $bulan = 'November';
            # code...
        } else if ($month == '12') {
            $bulan = 'Desember';
            # code...
        }
        //require(APPPATH. 'PHPExcelpath/Classes/PHPExcel.php');
        // require base_url('PHPExcelpath/Classes/PHPExcel.php'); 
        // require(APPPATH. 'PHPExcelpath/Classes/PHPExcel/Writer/Excel2007.php'); 

        $object = new Spreadsheet();
        $object->getProperties()->setCreator('UKS Teladan');
        $object->getProperties()->setTitle('Daftar UKS Bulan ' . $bulan . ' Tahun ' . $year);
        $object->setActiveSheetIndex(0);
        $object->getDefaultStyle()->getFont()->setName('Carlito'); //font
        $object->getDefaultStyle()->getFont()->setSize(9); //sizefont
        $object->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('G')->setWidth(18);
        $object->getActiveSheet()->getColumnDimension('H')->setWidth(30.5);
        $object->getActiveSheet()->getColumnDimension('I')->setWidth(43.17);

        $object->getActiveSheet()->setCellValue('A1', 'No');
        $object->getActiveSheet()->mergeCells("A1:A2");
        $object->getActiveSheet()->setCellValue('B1', 'Hari,tanggal');
        $object->getActiveSheet()->mergeCells("B1:B2");
        $object->getActiveSheet()->setCellValue('C1', 'Nama Siswa');
        $object->getActiveSheet()->mergeCells("C1:C2");
        $object->getActiveSheet()->setCellValue('D1', 'Kelas');
        $object->getActiveSheet()->mergeCells("D1:D2");
        $object->getActiveSheet()->setCellValue('E1', 'Waktu');
        $object->getActiveSheet()->mergeCells("E1:F1");
        $object->getActiveSheet()->setCellValue('E2', 'Masuk');
        $object->getActiveSheet()->setCellValue('F2', 'Keluar');
        $object->getActiveSheet()->setCellValue('G1', 'Keluhan');
        $object->getActiveSheet()->mergeCells("G1:G2");
        $object->getActiveSheet()->setCellValue('H1', 'Penanganan');
        $object->getActiveSheet()->mergeCells("H1:H2");
        $object->getActiveSheet()->setCellValue('I1', 'Hasil/Keterangan');
        $object->getActiveSheet()->mergeCells("I1:I2");

        $baris = 3;
        $no = 1;

        foreach ($data['content'] as $key => $hasil) {
            $hasil->tgl_kunjungan = $this->mUKS->tgl_indo($hasil->tgl_kunjungan);

            $object->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $object->getActiveSheet()->setCellValue('B' . $baris, $hasil->hari . ', ' . $hasil->tgl_kunjungan);
            $object->getActiveSheet()->setCellValue('C' . $baris, $hasil->nama);
            $object->getActiveSheet()->setCellValue('D' . $baris, $hasil->kelas);
            $object->getActiveSheet()->setCellValue('E' . $baris, $hasil->jam_datang);
            $object->getActiveSheet()->setCellValue('F' . $baris, $hasil->jam_keluar);
            $object->getActiveSheet()->setCellValue('G' . $baris, $hasil->keluhan);
            $object->getActiveSheet()->setCellValue('H' . $baris, $hasil->penanganan);
            $object->getActiveSheet()->setCellValue('I' . $baris, $hasil->hasil);

            $baris++;
            # code...
        }

        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                // 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $object->getActiveSheet()->getStyle('A1:I2')->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('A3:A' . $baris)
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $object->getActiveSheet()->getStyle('D3:F' . $baris)
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $object->getActiveSheet()->getStyle('G3:I' . $baris)
            ->getAlignment()->setWrapText(true);

        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $object->getActiveSheet()->getStyle('A1:I' . $baris)->applyFromArray($borderStyle);

        $writer = new Xlsx($object);
        $filename = "Data_Pengunjung_Uks_Bulan_" . $bulan . "_Tahun_" . $year . '.xlsx';
        header('Content-Type: application/vnd.ms-excel');
        //  header('Content-Disposition: attachment;filename="Latihan.xlsx"');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');

        // $object->getActiveSheet()->setTitle("Data Pengunjung UKS");

        // header('Cache-Control: max-age=0');

        // $Writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
        // $Writer->save('php://output');
        // exit;
    }

    public function checkup_periode()
    {
        $this->load->model('checkup/M_Periode', 'mCheckUpPeriode');
        $this->load->model('checkup/M_Checkup', 'mCheckUp');
        if($this->input->post()){
            if($this->input->post()['typeSubmit'] == 'insert') {
                $message = setMessage($this->mCheckUpPeriode->insert($this->input->post()), "Menambahkan");
                if($message['result']){
                    $data_checkup = new stdClass();
                    $param['jenjang'] = $this->session->userdata['jenjang'];
                    $param['kelas_rombel'] = $this->session->userdata['kelas_rombel'];
                    $param['kelas_tingkat'] = $this->session->userdata['kelas_tingkat'];
                    $param['thnAkademik_id'] = $this->mAkademik->getTahunAkademikIdByActive();

                    $data_checkup->siswa = $this->mSiswa->getByKelas($param);
                    $data_checkup->checkup_periode_id = $this->mCheckUpPeriode->getLastInsertId($this->input->post());
                    $message = setMessage($this->mCheckUp->insert($data_checkup), "Menambahkan");
                }
                $this->session->set_flashdata('message', $message['message']);
                redirect(base_url('wali/checkup_periode'));
            } elseif ($this->input->post()['typeSubmit'] == 'update') {
                $message = setMessage($this->mCheckUpPeriode->update($this->input->post()), "Mengubah");
                $this->session->set_flashdata('message', $message['message']);
                redirect(base_url('wali/checkup_periode'));
            } elseif ($this->input->post()['typeSubmit'] == 'delete') {
                $message = setMessage($this->mCheckUpPeriode->delete($this->input->post()), "Menghapus");
                $this->session->set_flashdata('message', $message['message']);
                redirect(base_url('wali/checkup_periode'));
            }
        }else{
            $data['title'] = "Periode Pemeriksaan Mingguan";
            $data['username'] = $this->mLogin->getNameUser();
            $data['role'] = $this->mLogin->getUserRole();
            $data['menu'] = 'WC';
            $data['smenu'] = '0';
            $data['periode'] = $this->mCheckUpPeriode->getAll();
            $data['thnAkademik_id'] = $this->mAkademik->getTahunAkademikIdByActive();
            $this->blade->render('checkup/periode',$data);
        }
    }

    public function checkup($checkup_periode_id)
    {
        $this->load->model('checkup/M_Periode', 'mCheckUpPeriode');
        $this->load->model('checkup/M_Checkup', 'mCheckUp');
        if($this->input->post()){
            if($this->input->post()['typeSubmit'] == 'update') {
                $message = setMessage($this->mCheckUp->update($this->input->post()), "Mengubah");
                $this->session->set_flashdata('message', $message['message']);
                redirect(base_url('wali/checkup/'.$checkup_periode_id));
            }
        } else {
            $data['kelas_rombel'] = $this->session->userdata['kelas_rombel'];
            $data['kelas_tingkat'] = $this->session->userdata['kelas_tingkat'];
            
            $data['title'] = "Daftar Pemeriksaan Siswa";
            $data['username'] = $this->mLogin->getNameUser();
            $data['role'] = $this->mLogin->getUserRole();
            $data['menu'] = 'WC';
            $data['smenu'] = '0';
            $data['checkup'] = $this->mCheckUp->getAll($checkup_periode_id);
            $data['periode'] = $this->mCheckUpPeriode->get($checkup_periode_id);
            $this->blade->render('checkup/checkup',$data);
        }
    }

    public function exportRMCU($periode_id)
    {
        $this->load->model('mcuSD/M_GiziSD', 'mGiziSD');
        $this->load->model('cetak/M_CetakMcu', 'mCMcu');

        $jenjang = $this->session->userdata['jenjang'];
        $kelas_rombel = $this->session->userdata['kelas_rombel'];
        $kelas_tingkat = $this->session->userdata['kelas_tingkat'];
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
        $sheet->setCellValue('L2', 'BB/U (Stunting)');
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
            $sheet->setCellValue('L'.$i, $value->stun_text);
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

    public function exportRMCU2($kelas_tingkat, $kelas_rombel, $periode)
    {
        $this->load->model('cetak/M_CetakMcu', 'mCMcu');
        $data['title'] = "Detail Laporan MCU / Screening Kelas " . $kelas_tingkat . $kelas_rombel;
        $data['content'] = $this->mCMcu->getReport2($kelas_tingkat, $kelas_rombel, $periode);

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
        $sheet->setCellValue('L2', 'BB/U');
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
            $sheet->setCellValue('L'.$i, $value->bbperu_text);
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
}
