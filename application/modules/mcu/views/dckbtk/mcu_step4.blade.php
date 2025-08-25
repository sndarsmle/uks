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
                    <h4 class="card-title">{{$mcu->periode_name != "SCR" ? "Medical Check Up" : "Screening"}} - DC KB TK Teladan</h4>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-4 col-lg-3">
                                <div class="nav flex-column nav-pills">
                                    <a href="{{base_url('mcu/dckbtk/step1/'.$mcu->mcu_id)}}" class="nav-link"> Status Gizi</a>
                                    <a href="{{base_url('mcu/dckbtk/step2/'.$mcu->mcu_id)}}" class="nav-link">Pemeriksaan Umum</a>
                                    <a href="{{base_url('mcu/dckbtk/step3/'.$mcu->mcu_id)}}" class="nav-link">Gigi Dan Mulut</a>
                                    <a href="#v-pills-home" class="nav-link active show" class="nav-link">Penglihatan dan Pendengaran</a>
                                    <a href="{{base_url('mcu/dckbtk/step5/'.$mcu->mcu_id)}}" class="nav-link">Lainnya</a>
                                    @if($role == 3)
                                        <a href="{{base_url('mcu/dckbtk/evaluasi/'.$mcu->mcu_id)}}" class="nav-link">Evaluasi</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-9">
                                <div class="tab-content">
                                    <!-- masukkan sini -->
                                    <div class="box-header with-border">


                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <h4><label>
                                                    <font><b> Penglihatan</b></font>
                                                </label></h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>1. Mata Luar</label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb1 minimal" name="mata_luar" class="minimal" value="1" <?php if ($matatelinga->mata_luar == '1' || $matatelinga->mata_luar == '') : echo "checked"; ?><?php endif ?>> Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb1 minimal" name="mata_luar" class="minimal" value="2" <?php if ($matatelinga->mata_luar == '2') : echo "checked"; ?><?php endif ?>> Tidak Sehat &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br><br>
                                                    <textarea required name="ket_mata_luar" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$matatelinga->ket_mata_luar}}</textarea>
                                                    <br /><br />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>2. Tajam Penglihatan</label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb2 minimal" name="penglihatan" class="minimal" value="1" checked <?php if ($matatelinga->penglihatan == '1' || $matatelinga->penglihatan == '') : echo "checked"; ?> <?php endif ?>> Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb2 minimal" name="penglihatan" class="minimal" value="2" <?php if ($matatelinga->penglihatan == '2') : echo "checked"; ?> <?php endif ?>> Low Vission &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb2 minimal" name="penglihatan" class="minimal" value="3" <?php if ($matatelinga->penglihatan == '3') : echo "checked"; ?> <?php endif ?>> Kebutaan &nbsp&nbsp&nbsp&nbsp&nbsp<br>
                                                        <input type="checkbox" class="chb2 minimal" name="penglihatan" class="minimal" value="4" <?php if ($matatelinga->penglihatan == '4') : echo "checked"; ?> <?php endif ?>> Kelainan Refraksi &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <textarea required name="ket_penglihatan" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3" required="">{{$matatelinga->ket_penglihatan}}</textarea>
                                                    <br />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>3. Kacamata</label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb3 minimal" name="kacamata" class="minimal" value="1" <?php if ($matatelinga->kacamata == '1' || $matatelinga->kacamata == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb3 minimal" name="kacamata" class="minimal" value="2" <?php if ($matatelinga->kacamata == '2') : echo "checked"; ?><?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <textarea required name="ket_kacamata" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3" required>{{$matatelinga->ket_kacamata}}</textarea>
                                                    <!-- <br /> --><br />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>4. Infeksi Mata</label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb4 minimal" name="inf_mata" class="minimal" value="1" <?php if ($matatelinga->inf_mata == '1' || $matatelinga->inf_mata == '') : echo "checked"; ?> <?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb4 minimal" name="inf_mata" class="minimal" value="2" <?php if ($matatelinga->inf_mata == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <textarea required name="ket_inf_mata" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$matatelinga->ket_inf_mata}}</textarea>
                                                    <br /><br />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>
                                                        5. Masalah Lainnya
                                                    </label><br /> <br>
                                                    <textarea required name="ket_masalah_lain_penglihatan" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$matatelinga->ket_masalah_lain_penglihatan}}</textarea>
                                                    <br /><br />
                                                </div>
                                                <div class="col-lg-6"></div>
                                            </div>

                                        </div> <!-- akhir form group -->






                                        <div class="form-group">
                                            <h4><label>
                                                    <font color="black"><b> Pendengaran</b></font>
                                                </label></h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>
                                                        6. Telinga Luar
                                                    </label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb5 minimal" name="telinga" class="minimal" value="1" <?php if ($matatelinga->telinga == '1' || $matatelinga->telinga == '') : echo "checked"; ?> <?php endif ?>> Sehat &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb5 minimal" name="telinga" class="minimal" value="2" <?php if ($matatelinga->telinga == '2') : echo "checked"; ?> <?php endif ?>> Tidak Sehat &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <textarea required name="ket_telinga" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$matatelinga->ket_telinga}}</textarea>
                                                    <br /><br />
                                                </div>

                                                <div class="col-md-6">
                                                    <label>
                                                        7. Serumen
                                                    </label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb6 minimal" name="kot_telinga" class="minimal" value="1" <?php if ($matatelinga->kot_telinga == '1' || $matatelinga->kot_telinga == '') : echo "checked"; ?> <?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb6 minimal" name="kot_telinga" class="minimal" value="2" <?php if ($matatelinga->kot_telinga == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <textarea required name="ket_kot_telinga" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$matatelinga->ket_kot_telinga}}</textarea>
                                                    <br /><br />
                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>
                                                        8. Infeksi Telinga
                                                    </label><br />

                                                    <input type="checkbox" class="chb7 minimal" name="inf_telinga" class="minimal" value="1" <?php if ($matatelinga->inf_telinga == '1' || $matatelinga->inf_telinga == '') : echo "checked"; ?> <?php endif ?>>Tidak&nbsp&nbsp&nbsp&nbsp&nbsp
                                                    <input type="checkbox" class="chb7 minimal" name="inf_telinga" class="minimal" value="2" <?php if ($matatelinga->inf_telinga == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    <br>
                                                    <textarea required name="ket_inf_telinga" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$matatelinga->ket_inf_telinga}}</textarea>
                                                    <br /><br />
                                                </div>

                                                <div class="col-md-6">
                                                    <label>
                                                        9. Tajam Pendengaran
                                                    </label><br />

                                                    <input type="checkbox" class="chb8 minimal" name="tajam_pendengaran" class="minimal" value="1" <?php if ($matatelinga->tajam_pendengaran == '1' || $matatelinga->tajam_pendengaran == '') : echo "checked"; ?> <?php endif ?>>Normal&nbsp&nbsp&nbsp&nbsp&nbsp
                                                    <input type="checkbox" class="chb8 minimal" name="tajam_pendengaran" class="minimal" value="2" <?php if ($matatelinga->tajam_pendengaran == '2') : echo "checked"; ?> <?php endif ?>> Ada Gangguan &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    <br>
                                                    <textarea required name="ket_tajam_pendengaran" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$matatelinga->ket_tajam_pendengaran}}</textarea>
                                                    <br /><br />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>
                                                        10. Masalah Lainnya
                                                    </label><br /> <br>
                                                    <textarea required name="ket_masalah_lain_pendengaran" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$matatelinga->ket_masalah_lain_pendengaran}}</textarea>
                                                    <br /><br />
                                                </div>
                                                <div class="col-lg-6"></div>
                                            </div>
                                            <!-- <div class="col-md-6">
                        
                     <div class="col-md-6">
                        
                     </div>

                   </div> -->


                                        </div> <!-- akhir form group -->
                                    </div>
                                    <!-- sampai sini -->

                                    <input type="submit" style="color:white" class="btn btn-success" value="Simpan & Lanjut" />
                    </form>
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
        $(".chb8").change(function() {
            $(".chb8").prop('checked', false);
            $(this).prop('checked', true);
        });
    });
</script>
@endsection