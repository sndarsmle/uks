<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SMA extends Middleware
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Login', 'mLogin');
        $this->load->model('mcu/M_MCU', 'mMCU');
        $this->load->model('M_Uks', 'mUKS');
        $this->load->model('siswa/M_Siswa', 'mSiswa');
    }

    public function step1($mcu_id): void
    {
        $this->load->helper('jenjang');
        $this->load->model('mcuSMA/M_VitalSMA', 'mVitalSMA');
        $data['role'] = $this->mLogin->getUserRole();
        $mcuData = $this->mMCU->findById($mcu_id);
        $vitalData = $this->mVitalSMA->findByParentID($mcuData->mcu_id);

        if ($form = $this->input->post()) {
            $form['form_id'] = $mcuData->mcu_id;

            if ($vitalData) {
                $result = $this->mVitalSMA->update($form);
            } else {
                $result = $this->mVitalSMA->create($form);
            }

            if ($result) {
                redirect("mcu/SMA/step2/" . $mcuData->mcu_id);
            } else {
                redirect("mcu/SMA/step1/" . $mcuData->mcu_id);
            }
        } else {
            $data['title'] = "Step 1";
            $data['menu'] = 'MCU';
            $data['smenu'] = '';
            $data['user'] = $this->mLogin->getNameUser();
            $data['role'] = $this->mLogin->getUserRole();
            $data['siswa'] = $this->mSiswa->findById($mcuData->siswa_id);
            $data['mcu'] = $mcuData;
            $jk = $data['siswa']->siswa_kelamin;
            if ($jk === "L") {
                $data ['imtdbb'] = $this->mUKS->getIMTLaki();
            } else {
                $data ['imtdbb'] = $this->mUKS->getIMTPerempuan();
            }

            if ($vitalData) {
                $data['vital'] = $vitalData;
            } else {
                $data['vital'] = (object)[
                    'vital_tekananDarahmm' => '',
                    'vital_tekananDarahhg' => '',
                    'vital_nadi' => '',
                    'vital_freqNafas' => '',
                    'vital_suhu' => '',
                    'vital_bisingJantung' => '',
                    'vital_bisingParu' => '',
                ];
            }
            $this->blade->render('sma/mcu_step1', $data);
        }
    }

    public function step2($mcu_id): void
    {
        $this->load->helper('jenjang');
        $this->load->model('mcuSMA/M_GiziSMA', 'mGiziSMA');

        $role = $this->mLogin->getUserRole();
        $mcuData = $this->mMCU->findById($mcu_id);
        $giziData = $this->mGiziSMA->findByParentID($mcuData->mcu_id);

        if ($form = $this->input->post()) {
            $form['form_id'] = $mcuData->mcu_id;

            if ($giziData) {
                $result = $this->mGiziSMA->update($form);
            } else {
                $result = $this->mGiziSMA->create($form);
            }

            if ($result) {
                if (isset($form['form_tgl']) && $mcuData) {
                    $data['siswa'] = $this->mSiswa->findById($mcuData->siswa_id);
                    $born_date = new DateTime($data['siswa']->siswa_tgl_lahir);
                    $selected_date = new DateTime($form['form_tgl']);
                    $interval_date = $born_date->diff($selected_date);

                    $form['form_periode'] = $mcuData->periode_id;
                    $form['form_siswa'] = $mcuData->siswa_id;
                    $form['form_lokasi'] = $mcuData->mcu_location;
                    $form['form_tahun'] = $interval_date->y;
                    $form['form_bulan'] = $interval_date->m;
                    $form['form_code'] = $mcuData->mcu_code;

                    $result = $this->mMCU->updateRow($form);

                    if (!$result) {
                        redirect("mcu/SMA/step2/" . $mcuData->mcu_id);
                    }
                }

                if ((int)$role === 2) {
                    redirect("mcu/reservasi?key=44");
                } else {
                    redirect("mcu/SMA/step3/" . $mcuData->mcu_id);
                }
            } else {
                redirect("mcu/SMA/step2/" . $mcuData->mcu_id);
            }
        } else {
            $data['title'] = "Step 2";
            $data['menu'] = 'MCU';
            $data['smenu'] = '';
            $data['user'] = $this->mLogin->getNameUser();
            $data['role'] = $this->mLogin->getUserRole();
            $data['siswa'] = $this->mSiswa->findById($mcuData->siswa_id);
            $data['mcu'] = $mcuData;
            $jk = $data['siswa']->siswa_kelamin;
            if ($jk === "L") {
                $data ['imtdbb'] = $this->mUKS->getIMTLaki();
            } else {
                $data ['imtdbb'] = $this->mUKS->getIMTPerempuan();
            }

            if ($giziData) {
                $data['gizi'] = $giziData;
            } else {
                $data['gizi'] = (object)[
                    'bb' => '',
                    'tb' => '',
                    'lk' => '',
                    'lla' => '',
                    'lp' => '',
                    'pimt' => '',
                    'status_gizi' => '',
                    'stun' => '',
                    'anemia' => '',
                ];
            }
            $this->blade->render('sma/mcu_step2', $data);
        }
    }

    public function step3($mcu_id): void
    {
        $this->load->helper('jenjang');
        $this->load->model('mcuSMA/M_BersihSMA', 'mBersihSMA');

        $mcuData = $this->mMCU->findById($mcu_id);
        $bersihData = $this->mBersihSMA->findByParentID($mcuData->mcu_id);

        if ($form = $this->input->post()) {
            $form['form_id'] = $mcuData->mcu_id;

            if ($bersihData) {
                $result = $this->mBersihSMA->update($form);
            } else {
                $result = $this->mBersihSMA->create($form);
            }

            if ($result) {
                redirect("mcu/SMA/step4/" . $mcuData->mcu_id);
            } else {
                redirect("mcu/SMA/step3/" . $mcuData->mcu_id);
            }
        } else {
            $data['title'] = "Step 3";
            $data['menu'] = 'MCU';
            $data['smenu'] = '';
            $data['user'] = $this->mLogin->getNameUser();
            $data['role'] = $this->mLogin->getUserRole();
            $data['siswa'] = $this->mSiswa->findById($mcuData->siswa_id);
            $data['mcu'] = $mcuData;

            if ($bersihData) {
                $data['bersih'] = $bersihData;
            } else {
                $data['bersih'] = (object)[
                    'rambut' => '',
                    'kulit' => '',
                    'ket_kulit' => '',
                    'kulit_sisik' => '',
                    'kulit_memar' => '',
                    'kulit_sayat' => '',
                    'kulit_koreng' => '',
                    'kulit_koreng_sukar' => '',
                    'kulit_suntik' => '',
                    'kuku' => '',

                ];
            }
            $this->blade->render('sma/mcu_step3', $data);
        }
    }

    public function step4($mcu_id): void
    {
        $this->load->helper('jenjang');
        $this->load->model('mcuSMA/M_MulutSMA', 'mMulut');

        $mcuData = $this->mMCU->findById($mcu_id);
        $mulutData = $this->mMulut->findByParentID($mcuData->mcu_id);

        if ($form = $this->input->post()) {
            $form['form_id'] = $mcuData->mcu_id;

            if ($mulutData) {
                $result = $this->mMulut->update($form);
            } else {
                $result = $this->mMulut->create($form);
            }

            if ($result) {
                redirect("mcu/SMA/step5/" . $mcuData->mcu_id);
            } else {
                redirect("mcu/SMA/step4/" . $mcuData->mcu_id);
            }
        } else {
            $data['title'] = "Step 4";
            $data['menu'] = 'MCU';
            $data['smenu'] = '';
            $data['user'] = $this->mLogin->getNameUser();
            $data['role'] = $this->mLogin->getUserRole();
            $data['siswa'] = $this->mSiswa->findById($mcuData->siswa_id);
            $data['mcu'] = $mcuData;

            if ($mulutData) {
                $data['mulut'] = $mulutData;
            } else {
                $data['mulut'] = (object)[
                    'bibir' => '',
                    'sudut_mulut' => '',
                    'sariawan' => '',
                    'lidah' => '',
                    'luka_lain' => '',
                    'ket_masalah_lain_rongga_mulut' => '',
                    'caries' => '',
                    'gigi_mud_berdarah' => '',
                    'gusi_bengkak' => '',
                    'gigi_kotor' => '',
                    'karang_gigi' => '',
                    'gigi_dep' => '',
                    'ket_masalah_lain_gigi_gusi' => '',
                ];
            }
            $this->blade->render('sma/mcu_step4', $data);
        }
    }

    public function step5($mcu_id): void
    {
        $this->load->helper('jenjang');
        $this->load->model('mcuSMA/M_MatatelingaSMA', 'mMata');

        $mcuData = $this->mMCU->findById($mcu_id);
        $mataData = $this->mMata->findByParentID($mcuData->mcu_id);

        if ($form = $this->input->post()) {
            $form['form_id'] = $mcuData->mcu_id;

            if ($mataData) {
                $result = $this->mMata->update($form);
            } else {
                $result = $this->mMata->create($form);
            }

            if ($result) {
                redirect("mcu/SMA/step6/" . $mcuData->mcu_id);
            } else {
                redirect("mcu/SMA/step5/" . $mcuData->mcu_id);
            }
        } else {
            $data['title'] = "Step 5";
            $data['menu'] = 'MCU';
            $data['smenu'] = '';
            $data['user'] = $this->mLogin->getNameUser();
            $data['role'] = $this->mLogin->getUserRole();
            $data['siswa'] = $this->mSiswa->findById($mcuData->siswa_id);
            $data['mcu'] = $mcuData;

            if ($mataData) {
                $data['matatelinga'] = $mataData;
            } else {
                $data['matatelinga'] = (object)[
                    'mata_luar' => '',
                    'penglihatan' => '',
                    'ket_penglihatan' => '',
                    'buta_warna' => '',
                    'inf_mata' => '',
                    'telinga' => '',
                    'kot_telinga' => '',
                    'inf_telinga' => '',
                    'ket_masalah_lain_pendengaran' => '',
                ];
            }

            $this->blade->render('sma/mcu_step5', $data);
        }
    }

    public function step6($mcu_id): void
    {
        $this->load->helper('jenjang');
        $this->load->model('mcuSMA/M_LainSMA', 'mLain');

        $role = $this->mLogin->getUserRole();
        $mcuData = $this->mMCU->findById($mcu_id);
        $lainData = $this->mLain->findByParentID($mcuData->mcu_id);

        if ($form = $this->input->post()) {
            $form['form_id'] = $mcuData->mcu_id;

            if ($lainData) {
                if ($this->mLain->update($form)) {
                    if ((int)$role === 3) {
                        redirect("mcu/SMA/evaluasi/" . $mcuData->mcu_id);
                    } else {
                        redirect("mcu/SMA/step6/" . $mcuData->mcu_id);
                    }
                } else {
                    redirect("mcu/SMA/step6/" . $mcuData->mcu_id);
                }
            } else {
                if ($this->mLain->create($form)) {
                    if ((int)$role === 3) {
                        redirect("mcu/SMA/evaluasi/" . $mcuData->mcu_id);
                    } else {
                        redirect("mcu/SMA/step6/" . $mcuData->mcu_id);
                    }
                } else {
                    redirect("mcu/SMA/step6/" . $mcuData->mcu_id);
                }
            }
        } else {
            $data['title'] = "Step 6";
            $data['menu'] = 'MCU';
            $data['smenu'] = '';
            $data['user'] = $this->mLogin->getNameUser();
            $data['role'] = $this->mLogin->getUserRole();
            $data['siswa'] = $this->mSiswa->findById($mcuData->siswa_id);
            $data['mcu'] = $mcuData;

            if ($lainData) {
                $data['lain'] = $lainData;
            } else {
                $data['lain'] = (object)[
                    'mental' => '',
                    'saran' => '',
                    'kesimpulan' => '',
                    'followup' => '',
                ];
            }
            $this->blade->render('sma/mcu_step6', $data);
        }
    }

    public function evaluasi($mcu_id): void
    {
        $this->load->helper('jenjang');
        $this->load->helper('date');
        $mcuData = $this->mMCU->findByIdAllDataSMA($mcu_id);
        if ($form = $this->input->post()) {
            $form['form_id'] = $mcuData->mcu_id;
            $form['form_admin'] = $this->mLogin->getUserID();
            $this->mMCU->UpdateStatusFinish($form);
            redirect("mcu");
        } else {
            $data['title'] = "Evaluasi";
            $data['menu'] = 'MCU';
            $data['smenu'] = '';
            $data['user'] = $this->mLogin->getNameUser();
            $data['role'] = $this->mLogin->getUserRole();
            $data['siswa'] = $this->mSiswa->findById($mcuData->siswa_id);
            $data['mcu'] = $mcuData;
            $this->blade->render('sma/mcu_evaluasi', $data);
        }
    }
} 