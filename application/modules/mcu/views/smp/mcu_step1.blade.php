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
                    <h4 class="card-title">{{$mcu->periode_name != "SCR" ? "Medical Check Up" : "Screening"}} - SMP Teladan</h4>
                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                            <div class="nav flex-column nav-pills">
                                <a href="#v-pills-home" class="nav-link active show" class="nav-link">Tanda Vital</a>
                                <a href="{{base_url('mcu/SMP/step2/'.$mcu->mcu_id)}}" class="nav-link">Status Gizi</a>
                                @if(isset($role) && ($role == 3|| $role == 0))
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
                                <h4 class="card-title">Pemeriksaan Tanda-tanda Vital</h4>
                                <hr>
                                <form action="" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>1. Tekanan Darah (mm/hg)</label>
                                                <div class="row">
                                                    <div class="col-lg-4"><input type="text" class="form-control" name="form_tekananDarahmm" value="{{$vital->vital_tekananDarahmm}}" placeholder="mm" required></div>
                                                    <div class="col-lg-2 " style="align-items: center;">
                                                        <h5 style="align-items: center; padding-top: 10px; padding-left: 0px"> mm /</h5>
                                                    </div>
                                                    <div class="col-lg-4"><input type="text" class="form-control" name="form_tekananDarahhg" value="{{$vital->vital_tekananDarahhg}}" placeholder="hg" required></div>
                                                    <div class="col-lg-2 " style="align-items: center;">
                                                        <h5 style="align-items: center; padding-top: 10px; padding-left: 0px"> Hg /</h5>
                                                    </div>
                                                    <!-- <div class="col-lg-3">hg</div> -->

                                                </div>
                                                <!-- <input type="text" class="form-control" name="form_tekananDarah" value="{{$vital->vital_tekananDarah}}" placeholder="mm/hg" required> -->
                                            </div>
                                            <div class="form-group">
                                                <label>2. Denyut Nadi (permenit)</label>
                                                <input type="text" class="form-control" name="form_nadi" value="{{$vital->vital_nadi}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>3. Frequensi Nafas (permenit)</label>
                                                <input type="text" class="form-control" name="form_freqNafas" value="{{$vital->vital_freqNafas}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>4. Suhu (Derajat Celcius)</label>
                                                <input type="text" class="form-control" name="form_suhu" value="{{$vital->vital_suhu}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>5. Bising Jantung</label>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input chb1" name="form_bisingJantung" value="0" {{ $vital->vital_bisingJantung == '0' ? 'checked' : '' }}>Tidak</label>
                                                </div>
                                                <div class="form-check form-check-inline" style="margin-left:10px;">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input chb1" name="form_bisingJantung" value="1" {{ $vital->vital_bisingJantung == '1' ? 'checked' : '' }}>Ya</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>6. Bising Paru</label>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input chb2" name="form_bisingParu" value="0" {{ $vital->vital_bisingParu == '0' ? 'checked' : '' }}>Tidak</label>
                                                </div>
                                                <div class="form-check form-check-inline" style="margin-left:10px;">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input chb2" name="form_bisingParu" value="1" {{ $vital->vital_bisingParu == '1' ? 'checked' : '' }}>Ya</label>
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