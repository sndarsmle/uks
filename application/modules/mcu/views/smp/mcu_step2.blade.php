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
                                    <a href="#v-pills-home" class="nav-link active show" class="nav-link">Status Gizi</a>
                                    @if(isset($role) && $role == 3)
                                    <a href="{{base_url('mcu/SMP/step3/'.$mcu->mcu_id)}}" class="nav-link">Kebersihan diri</a>
                                    <a href="{{base_url('mcu/SMP/step4/'.$mcu->mcu_id)}}" class="nav-link">Kesehatan Rongga Mulut</a>
                                    <a href="{{base_url('mcu/SMP/step5/'.$mcu->mcu_id)}}" class="nav-link">Penglihatan dan Pendengaran</a>
                                    <a href="{{base_url('mcu/SMP/step6/'.$mcu->mcu_id)}}" class="nav-link">Lainnya</a>
                                        @if($role == 3)
                                            <a href="{{base_url('mcu/SMP/evaluasi/'.$mcu->mcu_id)}}" class="nav-link">Evaluasi</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-9">
                                <div class="tab-content">
                                    <h4 class="card-title">Informasi Awal</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Tanggal Periksa</label>
                                                <input type="date" class="form-control" name="form_tgl" value="{{$mcu->mcu_date}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Umur Saat Periksa</label>
                                                <input type="text" class="form-control" value="{{$mcu->mcu_ageY.' Tahun '.$mcu->mcu_ageM.' Bulan'}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h4 class="card-title">Pemeriksaan Status Gizi</h4>
                                            <div class="form-group">
                                                <label>1. Berat Badan (kg)</label>
                                                <input type="number" step="0.01" class="form-control" name="bb" required placeholder="Berat Badan" required id="bb" oninput="hitung_Imt()" value="{{$gizi->bb}}">
                                            </div>
                                            <div class="form-group">
                                                <label>2. Tinggi Badan (cg)</label>
                                                <input type="number" step="0.01" class="form-control" name="tb" required placeholder="Tinggi Badan" required id="tb" oninput="hitung_Imt()" value="{{$gizi->tb}}"> <br />
                                            </div>
                                            <input type="hidden" name="lk" value="0">
                                            <input type="hidden" name="lla" value="0">
                                            <input type="hidden" name="lp" value="0">
                                            <!--
                                                <div class="form-group">
                                                    <label>3. Lingkar Kepala (cm)</label>
                                                    <input type="number" step="0.01" class="form-control" name="lk" required placeholder="Lingkar Kepala" required value="{{$gizi->lk}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>4. Lingkar Lengan Atas (cm)</label>
                                                    <input type="number" step="0.01" class="form-control" name="lla" required placeholder="Lingkar Lengan Atas" required value="{{$gizi->lla}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>5. Lingkar Perut (cm)</label>
                                                    <input type="number" step="0.01" class="form-control" name="lp" required placeholder="Lingkar Perut" required value="{{$gizi->lp}}">
                                                </div>
                                            -->
                                        </div>
                                        <div class="col-lg-6">
                                            <h4 class="card-title">Kategori Status Gizi</h4>
                                            <div class="form-group">
                                                <label>6. IMT (BB/TB)<sup>2</sup>)</label>
                                                <input type="number" class="form-control" name="pimt" placeholder="IMT Hitung" readonly class="target" id="pimt" value="{{$gizi->pimt}}">
                                            </div>
                                            <div class="form-group">
                                                <label>7. Status Gizi</label>
                                                <br>
                                                <p id="cek" class="form-control" readonly><?php if ($gizi->status_gizi == "1") {
                                                                                                echo "Sangat Kurus";
                                                                                            } elseif ($gizi->status_gizi == "2") {
                                                                                                echo "Kurus";
                                                                                            } elseif ($gizi->status_gizi == "3") {
                                                                                                echo "Normal";
                                                                                            } elseif ($gizi->status_gizi == "4") {
                                                                                                echo "Gemuk";
                                                                                            } elseif ($gizi->status_gizi == "5") {
                                                                                                echo "Sangat Gemuk";
                                                                                            }

                                                                                            ?> </p>
                                                <input type="hidden" name="status_gizi" id="status_gizi" value="{{$gizi->status_gizi}}">
                                            </div>
                                            <div class="form-group">
                                                <label>8. TB / U (Stunting)</label>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" class="form-check-input chb1" name="stun" value="1" <?php if ($gizi->stun == '1') : echo "checked"; ?> <?php endif ?>> Normal &nbsp&nbsp&nbsp&nbsp&nbsp
                                                    <input type="checkbox" class="form-check-input chb1" name="stun" class="minimal" value="2" <?php if ($gizi->stun == '2') : echo "checked"; ?> <?php endif ?>> Pendek &nbsp&nbsp&nbsp&nbsp&nbsp
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>9. Tanda Klinis Anemi</label><br>
                                                <small>(Conjungtiva/kelopak mata bagian dalam bawah pucat, bibir, lidah,telapak tangan pucat)</small>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input chb2" name="anemia" class="minimal" value="1" <?php if ($gizi->anemia == '1') : echo "checked"; ?> <?php endif ?>> Tidak &nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <input type="checkbox" class="form-check-input chb2" name="anemia" class="minimal" value="2" <?php if ($gizi->anemia == '2') : echo "checked"; ?> <?php endif ?>> Ya &nbsp&nbsp&nbsp&nbsp&nbsp
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <br>
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
<script type="text/javascript">
    function hitung_Imt() {

        var bb = document.getElementById("bb").value;
        var tb = document.getElementById("tb").value;
        var tahun_usia_mcu = document.getElementById("tahun_usiaa").value;
        var bulan_usia_mcu = document.getElementById("bulan_usiaa").value;
        <?php foreach ($imtdbb as $key) : ?>

            if ((tahun_usia_mcu == "<?php echo $key->tahun_usia; ?>") && (bulan_usia_mcu == "<?php echo $key->bulan_usia; ?>")) {

                var sangat_kurus = "<?php echo ($key->sangat_kurus); ?>";
                var kurus = "<?php echo ($key->kurus); ?>";
                var batas_bawah = "<?php echo ($key->batas_bawah); ?>";
                var ideal = "<?php echo ($key->ideal); ?>";
                var batas_atas = "<?php echo ($key->batas_atas); ?>";
                var gemuk = "<?php echo ($key->berlebih); ?>";
                var sangat_gemuk = "<?php echo ($key->sangat_berlebih); ?>";


            }

        <?php endforeach ?>
        var imt;
        imt = (bb) / ((tb * 0.01) * (tb * 0.01));
        document.getElementById("pimt").value = imt;
        if (imt <= sangat_kurus) {
            document.getElementById("cek").innerHTML = "Sangat kurus";
            document.getElementById("status_gizi").value = "1";
            //         alert(imt);
        } else if ((sangat_kurus < imt) && (imt <= kurus)) {
            document.getElementById("cek").innerHTML = "Kurus";
            document.getElementById("status_gizi").value = "2";

        } else if ((kurus < imt) && (imt <= batas_atas)) {
            document.getElementById("cek").innerHTML = "Ideal";
            document.getElementById("status_gizi").value = "3";

        } else if ((batas_atas < imt) && (imt < sangat_gemuk)) {
            document.getElementById("cek").innerHTML = "Gemuk";
            document.getElementById("status_gizi").value = "4";
        } else if (imt >= sangat_gemuk) {
            document.getElementById("cek").innerHTML = "Sangat Gemuk";
            document.getElementById("status_gizi").value = "5";
        };



    }
</script>
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
    });
</script>
@endsection