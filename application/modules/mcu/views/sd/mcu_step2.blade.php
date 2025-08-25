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
                    <h4 class="card-title">{{$mcu->periode_name != "SCR" ? "Medical Check Up" : "Screening"}} - SD Teladan</h4>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-4 col-lg-3">
                                <div class="nav flex-column nav-pills">

                                    <a href="{{base_url('mcu/SD/step1/'.$mcu->mcu_id)}}" class="nav-link"> Status Gizi</a>
                                    <a href="#v-pills-home" class="nav-link active show" class="nav-link">Pemeriksaan Umum</a>
                                    <a href="{{base_url('mcu/SD/step3/'.$mcu->mcu_id)}}" class="nav-link">Gigi dan Mulut</a>
                                    <a href="{{base_url('mcu/SD/step4/'.$mcu->mcu_id)}}" class="nav-link">Penglihatan dan Pendengaran</a>
                                    <a href="{{base_url('mcu/SD/step5/'.$mcu->mcu_id)}}" class="nav-link">Lainnya</a>
                                    @if($role == 3)
                                        <a href="{{base_url('mcu/SD/evaluasi/'.$mcu->mcu_id)}}" class="nav-link">Evaluasi</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-9">
                                <div class="tab-content">
                                    <div class="form-group">
                                        <h4><label>
                                                <font><b> Kepala</b></font>
                                            </label></h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    1. Mata
                                                </label><br />
                                                <label>
                                                    <input type="checkbox" class="chb1 minimal" name="mata" class="minimal" value="1" <?php if ($umum->mata == '1' || $umum->mata == '') : echo "checked"; ?><?php endif ?>> Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    <input type="checkbox" class="chb1 minimal" name="mata" class="minimal" value="2" <?php if ($umum->mata == '2') : echo "checked"; ?> <?php endif ?>> Tidak Sehat/Kotor &nbsp&nbsp&nbsp&nbsp&nbsp
                                                </label>
                                                <br>
                                                <textarea required name="ket_mata" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$umum->ket_mata}}</textarea>
                                                <br /><br />
                                            </div>

                                            <div class="col-md-6">
                                                <label>2. Hidung

                                                </label><br />
                                                <label>
                                                    <input type="checkbox" class="chb2 minimal" name="hidung" class="minimal" value="1" <?php if ($umum->hidung == '1' || $umum->hidung == '') : echo "checked"; ?> <?php endif ?>> Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    <input type="checkbox" class="chb2 minimal" name="hidung" class="minimal" value="2" <?php if ($umum->hidung == '2') : echo "checked"; ?> <?php endif ?>> Tidak Sehat/Kotor &nbsp&nbsp&nbsp&nbsp&nbsp
                                                </label>
                                                <br>
                                                <textarea required name="ket_hidung" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$umum->ket_hidung}}</textarea>
                                                <!--  <br /> --><br />
                                            </div>

                                        </div>




                                        <div class="form-group box-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>3. Rongga Mulut</label>
                                                    <br />
                                                    <label>
                                                        <input type="checkbox" class="chb3 minimal" name="rongga_mulut" class="minimal" value="1" <?php if ($umum->rongga_mulut == '1' || $umum->rongga_mulut == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb3 minimal" name="rongga_mulut" class="minimal" value="2" <?php if ($umum->rongga_mulut == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <textarea required name="ket_rongga_mulut" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$umum->ket_rongga_mulut}}</textarea>
                                                    <br /><br />
                                                </div>
                                                <div class="col-md-6">

                                                </div>

                                            </div>
                                            <br>
                                            <hr>
                                            <h4><label>
                                                    <font><b> Thorax</b></font>
                                                </label></h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>4. Jantung</label>
                                                    <br />
                                                    <label>
                                                        <input type="checkbox" class="chb4 minimal" name="jantung" class="minimal" value="1" <?php if ($umum->jantung == '1' || $umum->jantung == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb4 minimal" name="jantung" class="minimal" value="2" <?php if ($umum->jantung == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <textarea required name="ket_jantung" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$umum->ket_jantung}}</textarea>
                                                    <br /><br />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>5. Paru-paru</label>
                                                    <br />
                                                    <label>
                                                        <input type="checkbox" class="chb5 minimal" name="paru" class="minimal" value="1" <?php if ($umum->paru == '1' || $umum->paru == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb5 minimal" name="paru" class="minimal" value="2" <?php if ($umum->paru == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <textarea required name="ket_paru" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$umum->ket_paru}}</textarea>
                                                    <br /><br />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>6. Neurologi</label>
                                                    <br />
                                                    <textarea required name="neurologi" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$umum->neurologi}}</textarea>
                                                    <br />
                                                </div>
                                                <div class="col-lg-6"></div>
                                            </div>
                                            <hr>
                                            <h4><label>
                                                    <font><b> Kebersihan diri</b></font>
                                                </label></h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>
                                                        7. Rambut
                                                    </label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb6 minimal" name="rambut" class="minimal" value="1" <?php if ($umum->rambut == '1' || $umum->rambut == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb6 minimal" name="rambut" class="minimal" value="2" <?php if ($umum->rambut == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp


                                                    </label><br>
                                                    <textarea required name="ket_rambut" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$umum->ket_rambut}}</textarea>
                                                    <br /><br />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>
                                                        8. Kulit
                                                    </label><br />
                                                    <label>
                                                        <input type="checkbox" class="chb7 minimal" name="kulit" class="minimal" value="1" <?php if ($umum->kulit == '1' || $umum->kulit == '') : echo "checked"; ?><?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="chb7 minimal" name="kulit" class="minimal" value="2" <?php if ($umum->kulit == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    </label><br>
                                                    <textarea required name="ket_kulit" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$umum->ket_kulit}}</textarea>
                                                    <br /><br />
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>
                                                9. Kuku
                                            </label><br />
                                            <label>
                                                <input type="checkbox" class="chb8 minimal" name="kuku" class="minimal" value="1" <?php if ($umum->kuku == '1' || $umum->kuku == '') : echo "checked"; ?><?php endif ?>> Sehat/Bersih &nbsp&nbsp&nbsp&nbsp&nbsp
                                                <input type="checkbox" class="chb8 minimal" name="kuku" class="minimal" value="2" <?php if ($umum->kuku == '2') : echo "checked"; ?> <?php endif ?>> Kotor/Panjang &nbsp&nbsp&nbsp&nbsp&nbsp
                                            </label><br>
                                            <textarea required name="ket_kuku" placeholder="Penjelasan. isi dengan tanda '-' jika tidak ada. " class="form-control" cols="10" rows="3">{{$umum->ket_kuku}}</textarea>
                                            <br /><br />
                                        </div>
                                        <div class="col-md-6">

                                        </div>

                                    </div>

                                </div>

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