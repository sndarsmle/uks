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
                                    <a href="#v-pills-home" class="nav-link active show" class="nav-link">Gigi Dan Mulut</a>
                                    <a href="{{base_url('mcu/dckbtk/step4/'.$mcu->mcu_id)}}" class="nav-link">Penglihatan dan Pendengaran</a>
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
                                            <h4 class="card-title">Kesehatan Rongga Mulut</h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>
                                                        1. Celah bibir/ Langit-langit
                                                    </label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb1 minimal" name="bibir" class="minimal" value="1" <?php if ($mulut->bibir == '1' || $mulut->bibir == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb1 minimal" name="bibir" class="minimal" value="2" <?php if ($mulut->bibir == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><!-- <br> -->
                                                    <!--                  <textarea name="ket_bibir" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea> -->
                                                    <br /><br />
                                                </div>

                                                <div class="col-md-6">
                                                    <label>
                                                        2. Luka Pada Sudut Mulut
                                                    </label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb2 minimal" name="sudut_mulut" class="minimal" value="1" <?php if ($mulut->sudut_mulut == '1' || $mulut->sudut_mulut == '') : echo "checked"; ?> <?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb2 minimal" name="sudut_mulut" class="minimal" value="2" <?php if ($mulut->sudut_mulut == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><!-- <br> -->
                                                    <!--                 <textarea name="ket_sudut_mulut" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea> -->
                                                    <br /><br />
                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>
                                                        3. Sariawan
                                                    </label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb3 minimal" name="sariawan" class="minimal" value="1" <?php if ($mulut->sariawan == '1' || $mulut->sariawan == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb3 minimal" name="sariawan" class="minimal" value="2" <?php if ($mulut->sariawan == '2') : echo "checked"; ?><?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label> <!-- <br> -->
                                                    <!--                  <textarea name="ket_sariawan" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea> -->
                                                    <br /><!-- <br />  -->
                                                </div>
                                                <div class="col-md-6">
                                                    <label>
                                                        4. Lidah Kotor
                                                    </label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb4 minimal" name="lidah" class="minimal" value="1" <?php if ($mulut->lidah == '1' || $mulut->lidah == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb4 minimal" name="lidah" class="minimal" value="2" <?php if ($mulut->lidah == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><!-- <br> -->
                                                    <!--                  <textarea name="ket_lidah" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea> -->
                                                    <br /><br />
                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>
                                                        5. Luka Lainnya
                                                    </label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb5 minimal" name="luka_lain" class="minimal" value="1" <?php if ($mulut->luka_lain == '1' || $mulut->luka_lain == '') : echo "checked"; ?> <?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb5 minimal" name="luka_lain" class="minimal" value="2" <?php if ($mulut->luka_lain == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><!-- <br> -->
                                                    <!--                  <textarea name="ket_luka_lain" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3"></textarea> -->
                                                    <br /><br />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>
                                                        6. Masalah Lainnya
                                                    </label><!-- <br /> -->
                                                    <br /><textarea name="ket_masalah_lain_rongga_mulut" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$mulut->ket_masalah_lain_rongga_mulut}}</textarea>
                                                    <br /><br />
                                                </div>

                                            </div>
                                        </div> <!-- akhir form group -->
                                        <div class="form-group">
                                            <h4 class="card-title">Kesehatan Gigi dan Gusi</h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>
                                                        6. Caries
                                                    </label><br />
                                                    <label>

                                                        <input type="checkbox" class="chb6 minimal" name="caries" class="minimal" value="1" <?php if ($mulut->caries == '1' || $mulut->caries == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb6 minimal" name="caries" class="minimal" value="2" <?php if ($mulut->caries == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br><textarea name="ket_caries" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$mulut->ket_masalah_lain_gigi_gusi}}</textarea>
                                                    <br /><br />
                                                </div>

                                                <div class="col-md-6">
                                                    <label>
                                                        7. Susunan Gigi Depan Tidak Teratur
                                                    </label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb7 minimal" name="gigi_dep" class="minimal" value="1" <?php if ($mulut->gigi_dep == '1' || $mulut->gigi_dep == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb7 minimal" name="gigi_dep" class="minimal" value="2" <?php if ($mulut->gigi_dep == '2') : echo "checked"; ?><?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>

                                                    <br /><br />
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>
                                                        7. Masalah Lainnya
                                                    </label><br />
                                                    <textarea name="ket_masalah_lain_gigi_gusi" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$mulut->ket_masalah_lain_gigi_gusi}}</textarea>
                                                    <br /><br />
                                                </div>

                                                <div class="col-md-6">

                                                </div>
                                            </div>




                                        </div> <!-- akhir form group -->


                                        <!-- sampai sini -->

                                        <input type="submit" style="color:white" class="btn btn-success" value="Simpan & Lanjut" />
                    </form>
                </div>
            </div>
        </div>s
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