@layout('template/back/main')

@section('scripts-css')

@endsection

@section('content')
<div class="container-fluid">
    </br>
    <h3> {{$title}}</h3>
    </br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informasi Siswa</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>NIS</label>
                                <input type="text" class="form-control" value="{{$siswa->siswa_nis}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" value="{{$siswa->siswa_nama}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input type="text" class="form-control" value=" {{ $siswa->siswa_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tgl Lahir</label>
                                <input type="date" class="form-control" value="{{$siswa->siswa_tgl_lahir}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Kelas</label>
                                <input type="text" class="form-control" value="{{formatJenjang($siswa->siswa_jenjang).' - '.$siswa->siswa_kelas}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Umur Hari Ini</label>
                                <input type="text" class="form-control" value="{{$siswa->siswa_umurT.' Tahun '.$siswa->siswa_umurB.' Bulan'}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$mcu->periode_name != "SCR" ? "Medical Check Up" : "Screening"}} - SD Teladan</h4>
                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                            <div class="nav flex-column nav-pills">
                                <a href="{{base_url('mcu/SD/step1/'.$mcu->mcu_id)}}" class="nav-link"> Status Gizi</a>
                                <a href="{{base_url('mcu/SD/step2/'.$mcu->mcu_id)}}" class="nav-link">Pemeriksaan Umum</a>
                                @if($mcu->periode_name != "SCR")
                                <a href="{{base_url('mcu/SD/step3/'.$mcu->mcu_id)}}" class="nav-link">Gigi Dan Mulut</a>
                                @endif
                                <a href="{{base_url('mcu/SD/step4/'.$mcu->mcu_id)}}" class="nav-link">Penglihatan dan Pendengaran</a>
                                <a href="{{base_url('mcu/SD/evaluasi/'.$mcu->mcu_id)}}" class="nav-link">Lainnya</a>
                                <a href="#v-pills-home" class="nav-link active show" class="nav-link">Evaluasi</a>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content" style="color: black">


                                <hr>
                                <h4 class="card-title">Pemeriksaan Status Gizi</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">1. Berat Badan (kg)</div>
                                            <div class="col-lg-6">:&nbsp&nbsp{{$mcu->bb}} cm</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">2. Tinggi Badan (kg)</div>
                                            <div class="col-lg-6">:&nbsp&nbsp{{$mcu->tb}} kg</div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <!-- <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-6">1. Berat Badan (kg)</div>
                                                <div class="col-lg-6"><div class="row">
                                                    <div class="col-lg-4">:&nbsp&nbsp{{$mcu->bb}}</div>
                                                    <div class="col-lg-8">Cm</div>
                                                </div></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-6">2. Tinggi Badan (kg)</div>
                                                <div class="col-lg-6">:&nbsp&nbsp{{$mcu->tb}}</div>
                                            </div>
                                        </div>
                                    </div> -->

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">3. IMT (BB/TB)</div>
                                            <div class="col-lg-6">:&nbsp&nbsp{{$mcu->pimt}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">4.Status Gizi</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->status_gizi == "1") {
                                                                                    echo "Sangat Kurus";
                                                                                } elseif ($mcu->status_gizi == "2") {
                                                                                    echo "Kurus";
                                                                                } elseif ($mcu->status_gizi == "3") {
                                                                                    echo "Normal";
                                                                                } elseif ($mcu->status_gizi == "4") {
                                                                                    echo "Gemuk";
                                                                                } elseif ($mcu->status_gizi == "5") {
                                                                                    echo "Sangat Gemuk";
                                                                                }

                                                                                ?></div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">5. Lingkar Kepala</div>
                                            <div class="col-lg-6">:&nbsp&nbsp{{$mcu->lk}} cm</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">6. Lingkar Lengan Atas</div>
                                            <div class="col-lg-6">:&nbsp&nbsp{{$mcu->lla}} cm</div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">7. Lingkar Perut (cm)</div>
                                            <div class="col-lg-6">:&nbsp&nbsp{{$mcu->lp}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">8. Stunting</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->stun == "1") {
                                                                                    echo "Tdak";
                                                                                } else {
                                                                                    echo "Ya";
                                                                                }
                                                                                ?></div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">9. Tanda Klinis Anemia</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->anemia == "1") {
                                                                                    echo "Tdak";
                                                                                } else {
                                                                                    echo "Ya";
                                                                                }
                                                                                ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6"></div>
                                            <div class="col-lg-6"></div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h4>
                                    <font><b> Pemeriksaan Umum</b></font>
                                </h4>
                                <br>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">1. Mata</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->mata == '1') {
                                                                                    echo "Bersih / Sehat";
                                                                                } else {
                                                                                    echo "Tidak Sehat";
                                                                                }
                                                                                ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">Keterangan</div>
                                            <div class="col-lg-6">:&nbsp&nbsp{{$mcu->ket_mata}}</div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">1. Hidung</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->hidung == '1') {
                                                                                    echo "Bersih Sehat";
                                                                                } else {
                                                                                    echo "Tidak Sehat";
                                                                                }
                                                                                ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">Keterangan</div>
                                            <div class="col-lg-6">:&nbsp&nbsp{{$mcu->ket_hidung}}</div>

                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">Rongga Mulut</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->rongga_mulut == '1') {
                                                                                    echo "Normal";
                                                                                } else {
                                                                                    echo "Ada Kelainan";
                                                                                }
                                                                                ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">Keterangan</div>
                                            <div class="col-lg-6">:&nbsp&nbsp{{$mcu->ket_rongga_mulut}}</div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">Jantung</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->jantung == '1') {
                                                                                    echo "Normal";
                                                                                } else {
                                                                                    echo "Gangguan";
                                                                                }
                                                                                ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">Keterangan</div>
                                            <div class="col-lg-6">:&nbsp&nbsp{{$mcu->ket_jantung}}</div>

                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">Rambut</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->rambut == '1') {
                                                                                    echo "Bersih / Sehat";
                                                                                } else {
                                                                                    echo "Kotor / Tidak Sehat";
                                                                                }
                                                                                ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">Keterangan</div>
                                            <div class="col-lg-6">:&nbsp&nbsp{{$mcu->ket_rambut}}</div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">1. Kulit</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->kulit == '1') {
                                                                                    echo "Bersih Sehat";
                                                                                } else {
                                                                                    echo "Tidak Sehat";
                                                                                }
                                                                                ?></div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-6">Keterangan</div>
                                            <div class="col-lg-6">:&nbsp&nbsp{{$mcu->ket_kulit}}</div>

                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">Kuku</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->kuku == '1') {
                                                                                    echo "Bersih / Sehat";
                                                                                } else {
                                                                                    echo "Kotor / Panjang";
                                                                                }
                                                                                ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">Keterangan</div>
                                            <div class="col-lg-6">:&nbsp&nbsp{{$mcu->ket_kuku}}</div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                    </div>
                                </div>

                                <br>
                                <br>
                                <hr>
                                @if($mcu->periode_name != "SCR")
                                <h4 class="card-title">Kesehatan Rongga Mulut</h4>


                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">1. Celah bibir/ Langit-langit</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->bibir == "1") {
                                                                                    echo "TIdak";
                                                                                } else {
                                                                                    echo "Ya";
                                                                                }
                                                                                ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">2. Luka Pada Sudut Mulut</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->sudut_mulut == "1") {
                                                                                    echo "Tidak Ada";
                                                                                } else {
                                                                                    echo "Ada";
                                                                                }
                                                                                ?></div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">3. Sariawan</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->sariawan == "1") {
                                                                                    echo "Tidak";
                                                                                } else {
                                                                                    echo "Ya";
                                                                                }
                                                                                ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">4. Lidah Kotor</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->lidah == "1") {
                                                                                    echo "Tidak";
                                                                                } else {
                                                                                    echo "Ya";
                                                                                }
                                                                                ?></div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">5. Luka Lainnya</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->luka_lain == "1") {
                                                                                    echo "Tidak Ada";
                                                                                } else {
                                                                                    echo "Ada";
                                                                                }
                                                                                ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">6 Masalah Rongga Mulut Lainnya</div>
                                            <div class="col-lg-6">{{$mcu->ket_masalah_lain_rongga_mulut}}</div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">Caries/ Gigi Berlubang</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->caries == '1') {
                                                                                    echo "Tidak";
                                                                                } else {
                                                                                    echo "Ya";
                                                                                }
                                                                                ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">Keterangan</div>
                                            <div class="col-lg-6">:&nbsp&nbsp{{$mcu->ket_caries}}</div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">Susunan Gigi Depan Tidak teratur</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->luka_lain == "1") {
                                                                                    echo "Tidak";
                                                                                } else {
                                                                                    echo "Ya";
                                                                                }
                                                                                ?></div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">Masalah Gigi dan Gusi LainnyaLainnya</div>
                                            <div class="col-lg-6">{{$mcu->ket_masalah_lain_gigi_gusi}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6"></div>
                                            <div class="col-lg-6"></div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @endif
                                <h4><label>
                                        <font><b> Penglihatan</b></font>
                                    </label></h4>


                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">1. Mata Luar</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->mata_luar == '1') {
                                                                                    echo "Bersih / Sehat";
                                                                                } else {
                                                                                    echo "Tidak Sehat";
                                                                                }
                                                                                ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">Keterangan</div>
                                            <div class="col-lg-6">:&nbsp&nbsp{{$mcu->ket_mata}}</div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">2. Tajam Penglihatan</div>
                                            <div class="col-lg-6">:&nbsp&nbsp <?php if ($mcu->penglihatan == '1') {
                                                                                    echo " Normal";
                                                                                } else if ($mcu->penglihatan == '2') {
                                                                                    echo "Low Vision";
                                                                                } else if ($mcu->penglihatan == '3') {
                                                                                    echo "Kebutaan";
                                                                                } else {
                                                                                    echo "Kelainan Refraksi";
                                                                                }


                                                                                ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">Keterangan</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php echo ($mcu->ket_penglihatan); ?></div>
                                        </div>

                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">3. Kacamata</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->kacamata == '1') {
                                                                                    echo "Tidak";
                                                                                } else {
                                                                                    echo "Ya";
                                                                                }
                                                                                ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">Keterangan</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php echo ($mcu->ket_kacamata); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">4. Infeksi Mata</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->inf_mata == '1') {
                                                                                    echo "Tidak";
                                                                                } else {
                                                                                    echo "Ya";
                                                                                }
                                                                                ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">Keterangan</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php echo ($mcu->ket_inf_mata); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">Masalah Penglihatan Lainnya</div>
                                            <div class="col-lg-6">{{$mcu->ket_masalah_lain_penglihatan}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6"></div>
                                            <div class="col-lg-6"></div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <h4><label>
                                        <font><b> Pendengaran</b></font>
                                    </label></h4>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">5. Telinga Luar</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->telinga == '1') {
                                                                                    echo "Sehat";
                                                                                } else {
                                                                                    echo "Tidak Sehat";
                                                                                }
                                                                                ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">Keterangan</div>
                                            <div class="col-lg-6">{{$mcu->ket_telinga}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">6. Serumen</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->kot_telinga == '1') {
                                                                                    echo "TIdak";
                                                                                } else {
                                                                                    echo "Ya";
                                                                                }
                                                                                ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">Keterangan</div>
                                            <div class="col-lg-6">{{$mcu->ket_kot_telinga}}</div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">7. Infeksi</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php if ($mcu->inf_telinga == '1') {
                                                                                    echo "Tidak";
                                                                                } else {
                                                                                    echo "Ya";
                                                                                }
                                                                                ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">Keterangan</div>
                                            <div class="col-lg-6">{{$mcu->ket_inf_telinga}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">8. Masalah Lainnya</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php echo $mcu->ket_masalah_lain_pendengaran; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <br>

                                <div class="row">
                                    @if($mcu->periode_name != "SCR")
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">Gangguan Mental Emosional</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php echo $mcu->mental; ?></div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">Kesimpulan</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php echo $mcu->kesimpulan; ?></div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">Saran</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php echo $mcu->saran; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">Followup</div>
                                            <div class="col-lg-6">:&nbsp&nbsp<?php echo ($mcu->followup); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <br><br><br>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicModal" style="float:right;">Proses Evaluasi</button>
                                <div class="modal fade" id="basicModal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Form Hasil Evaluasi</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <form action="" method="POST">
                                                <div class="modal-body">
                                                    Apakah sudah yakin siswa telah menyelesaikan semua tahapan pemeriksaan dan data sudah benar?<br>
                                                    <input type="hidden" class="form-control" name="form_code" value="1" required>
                                                    <br>
                                                    <table>
                                                        <tr>
                                                            <td>Tanggal Periksa</td>
                                                            <td>&emsp;:&emsp;</td>
                                                            <td>{{$mcu->mcu_date}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Lokasi</td>
                                                            <td>&emsp;:&emsp;</td>
                                                            <td>{{$mcu->mcu_location}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Dokter</td>
                                                            <td>&emsp;:&emsp;</td>
                                                            <td>{{$user}}</td>
                                                        </tr>
                                                    </table>
                                                    <br> Jika sudah tekan tombol <b>Proses Selesai</b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color:white">Close</button>
                                                    <button class="btn btn-success">Proses Selesai</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts-js')
@endsection
<br>

<div class="row">
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6"></div>
        </div>
    </div>
</div>