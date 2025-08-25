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
    <input type="hidden" name="tahun_usia" id="tahun_usiaa" value="{{$siswa->siswa_umurT}}">
    <input type="hidden" name="bulan_usia" id="bulan_usiaa" value="{{$siswa->siswa_umurB}}">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$mcu->periode_name != "SCR" ? "Medical Check Up" : "Screening"}} - SMP Teladan</h4>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-4 col-lg-3">
                                <div class="nav flex-column nav-pills">
                                    <a href="{{base_url('mcu/SMP/step1/'.$mcu->mcu_id)}}" class="nav-link">Tanda Vital</a>
                                    <a href="{{base_url('mcu/SMP/step2/'.$mcu->mcu_id)}}" class="nav-link">Status Gizi</a>
                                    <a href="{{base_url('mcu/SMP/step3/'.$mcu->mcu_id)}}" class="nav-link">Kebersihan diri</a>
                                    <a href="{{base_url('mcu/SMP/step4/'.$mcu->mcu_id)}}" class="nav-link">Kesehatan Rongga Mulut</a>
                                    <a href="#v-pills-home" class="nav-link active show" class="nav-link">Penglihatan dan Pendengaran</a>
                                    <a href="{{base_url('mcu/SMP/step6/'.$mcu->mcu_id)}}" class="nav-link">Lainnya</a>
                                    @if($role == 3)
                                        <a href="{{base_url('mcu/SMP/evaluasi/'.$mcu->mcu_id)}}" class="nav-link">Evaluasi</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-9">
                                <div class="tab-content">
                                    <div class="box-header with-border">

                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <h4>
                                                <label>
                                                    <font><b> Penglihatan</b></font>
                                                </label>
                                            </h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>1. Mata Luar</label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb1 minimal" name="mata_luar" value="1" <?php if ($matatelinga->mata_luar == '1' || $matatelinga->mata_luar == '') : echo "checked"; ?><?php endif ?>> Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb1 minimal" name="mata_luar" value="2" <?php if ($matatelinga->mata_luar == '2') : echo "checked"; ?><?php endif ?>> Tidak Sehat &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <!-- <textarea name="ket_mata_luar" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea><br /> --><br />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>2. Tajam Penglihatan</label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb2 minimal" name="penglihatan" value="1" checked <?php if ($matatelinga->penglihatan == '1' || $matatelinga->penglihatan == '') : echo "checked"; ?> <?php endif ?>> Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        &nbsp&nbsp&nbsp&nbsp<input type="checkbox" class="chb2 minimal" name="penglihatan" value="2" <?php if ($matatelinga->penglihatan == '2') : echo "checked"; ?> <?php endif ?>> Low Vission &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <br>&nbsp&nbsp<input type="checkbox" class="chb2 minimal" name="penglihatan" value="3" <?php if ($matatelinga->penglihatan == '3') : echo "checked"; ?> <?php endif ?>> Kebutaan
                                                        <input type="checkbox" class="chb2 minimal" name="penglihatan" value="4" <?php if ($matatelinga->penglihatan == '4') : echo "checked"; ?> <?php endif ?>> Kelainan Refraksi &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <textarea name="ket_penglihatan" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3" required>{{$matatelinga->ket_penglihatan}}</textarea>
                                                    <br />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>3. Buta warna</label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb3 minimal" name="buta_warna" value="1" <?php if ($matatelinga->buta_warna == '1' || $matatelinga->buta_warna == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb3 minimal" name="buta_warna" value="2" <?php if ($matatelinga->buta_warna == '2') : echo "checked"; ?><?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <!--                             
                                                        <textarea name="ket_kacamata" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea> -->
                                                    <!-- <br /> -->
                                                    <br />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>4. Infeksi Mata</label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb4 minimal" name="inf_mata" value="1" <?php if ($matatelinga->inf_mata == '1' || $matatelinga->inf_mata == '') : echo "checked"; ?> <?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb4 minimal" name="inf_mata" value="2" <?php if ($matatelinga->inf_mata == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <!-- 
                                                        <textarea name="ket_inf_mata" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3" ></textarea><br /> --><br />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h4>
                                                <label>
                                                    <font color="green"><b> Pendengaran</b></font>
                                                </label>
                                            </h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>
                                                        5. Telinga Luar
                                                    </label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb5 minimal" name="telinga" value="1" <?php if ($matatelinga->telinga == '1' || $matatelinga->telinga == '') : echo "checked"; ?> <?php endif ?>> Sehat &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb5 minimal" name="telinga" value="2" <?php if ($matatelinga->telinga == '2') : echo "checked"; ?> <?php endif ?>> Tidak Sehat &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <!-- <textarea name="ket_telinga" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea><br /> --><br />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>
                                                        6. Serumen
                                                    </label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb6 minimal" name="kot_telinga" value="1" <?php if ($matatelinga->kot_telinga == '1' || $matatelinga->kot_telinga == '') : echo "checked"; ?> <?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb6 minimal" name="kot_telinga" value="2" <?php if ($matatelinga->kot_telinga == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <!-- <textarea name="ket_kot_telinga" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea><br /> --><br />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>
                                                        7. Infeksi
                                                    </label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb7 minimal" name="inf_telinga" value="1" <?php if ($matatelinga->inf_telinga == '1' || $matatelinga->inf_telinga == '') : echo "checked"; ?> <?php endif ?>>Tidak&nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb7 minimal" name="inf_telinga" value="2" <?php if ($matatelinga->inf_telinga == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <!-- <textarea name="ket_inf_telinga" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea><br /> --><br />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>
                                                        8. Masalah Lainnya
                                                    </label><br />
                                                    <textarea name="ket_masalah_lain_pendengaran" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3" required>{{$matatelinga->ket_masalah_lain_pendengaran}}</textarea>
                                                    <br /><br />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" style="color:white" class="btn btn-success" value="Simpan & Lanjut" />
                                </div>  
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts-js')
<script>
    $(document).ready(function() {
        $(".chb1").change(function() {
            $(".chb1").prop('checked', false);
            $(this).prop('checked', true);
        });
        $(".chb2").change(function() {
            $(".chb2").prop('checked', false);
            $(this).prop('checked', true);
        });
        $(".chb3").change(function() {
            $(".chb3").prop('checked', false);
            $(this).prop('checked', true);
        });
        $(".chb4").change(function() {
            $(".chb4").prop('checked', false);
            $(this).prop('checked', true);
        });
        $(".chb5").change(function() {
            $(".chb5").prop('checked', false);
            $(this).prop('checked', true);
        });
        $(".chb6").change(function() {
            $(".chb6").prop('checked', false);
            $(this).prop('checked', true);
        });
        $(".chb7").change(function() {
            $(".chb7").prop('checked', false);
            $(this).prop('checked', true);
        });
    });
</script>
@endsection