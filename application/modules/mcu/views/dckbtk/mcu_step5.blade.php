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
                                    <a href="{{base_url('mcu/dckbtk/step4/'.$mcu->mcu_id)}}" class="nav-link">Penglihatan dan PendengaranLainnya</a>
                                    <a href="#v-pills-home" class="nav-link active show" class="nav-link">Lainnya</a>
                                    @if($role == 3)
                                        <a href="{{base_url('mcu/dckbtk/evaluasi/'.$mcu->mcu_id)}}" class="nav-link">Evaluasi</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-9">
                                <div class="tab-content">
                                    <!-- masukkan sini -->
                                    <div class="row">
                                        @if($mcu->periode_name != "SCR")
                                        <div class="col-md-6">
                                            <label>
                                                <h5>Gangguan Mental Emosional</h5>
                                            </label>
                                            <textarea required class="form-control" rows="3" cols="10" placeholder="Penjelasan..." name="mental">{{$lain->mental}}</textarea>

                                        </div>
                                        @else
                                        <input type="hidden" class="form-control" name="mental">
                                        @endif

                                        <div class="col-md-6">
                                            <label>
                                                <h5> Kesimpulan</h5>
                                            </label>
                                            <textarea required class="form-control" rows="3" cols="10" placeholder="Penjelasan..." name="kesimpulan">{{$lain->kesimpulan}}</textarea>

                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>
                                                <h5>Saran </h5>
                                            </label>
                                            <textarea required class="form-control" rows="3" cols="10" placeholder="Penjelasan..." name="saran">{{$lain->saran}}</textarea>

                                        </div>

                                        <div class="col-md-6">

                                            <label>
                                                <h5>Follow Up</h5>
                                            </label>
                                            <textarea required class="form-control" rows="3" cols="10" placeholder="Penjelasan..." name="followup">{{$lain->followup}}</textarea>
                                            <input type="hidden" name="status_followup" value="1" required checked="">




                                        </div>
                                    </div>
                                    <!-- sampai sini -->

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

@endsection