@layout('template/back/main')

@section('scripts-css')
@endsection

@section('content')
<div class="container-fluid">
    <br>
    <h3>{{$title}} - {{$siswa->siswa_nama}}</h3>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="card-title">Informasi Siswa</h4>
                        </div>
                        <div class="col-md-8 text-right">
                            <a href="{{ base_url("profile/siswa/{$siswa->siswa_id}") }}" type="button" class="btn btn-secondary text-white">
                                Batal
                            </a>
                            <a href="{{ base_url("profile/sync/{$siswa->siswa_id}") }}" type="button" class="btn btn-primary">
                                Sync
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Data saat ini</h5>
                            </div>
                            <div class="form-group">
                                <label>NIS</label>
                                <input type="text" class="form-control" value="{{ $siswa->siswa_nis }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" value="{{ $siswa->siswa_nama }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input type="text" class="form-control" value=" {{ $siswa->siswa_kelamin === 'L' ? 'Laki - Laki' : 'Perempuan' }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tgl Lahir</label>
                                <input type="text" class="form-control" value="{{ formatTanggal($siswa->siswa_tgl_lahir) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jenjang</label>
                                <input type="text" class="form-control" value="{{ formatJenjang($siswa->siswa_jenjang) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Angkatan</label>
                                <input type="text" class="form-control" value="{{ $siswa->siswa_angkatan }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" value="{{ $siswa->siswa_status }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Data dari Akademik</h5>
                            </div>
                            <div class="form-group">
                                <label>NIS</label>
                                <input type="text" class="form-control" value="{{ $new_siswa->siswa_nis }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" value="{{ $new_siswa->siswa_nama_full }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input type="text" class="form-control" value=" {{ $new_siswa->siswa_kelamin === 'L' ? 'Laki - Laki' : 'Perempuan' }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tgl Lahir</label>
                                <input type="text" class="form-control" value="{{ formatTanggal($new_siswa->siswa_tgl_lhr) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Jenjang</label>
                                <input type="text" class="form-control" value="{{ formatJenjang($new_siswa->jenjang) }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Angkatan</label>
                                <input type="text" class="form-control" value="{{ $new_siswa->siswa_angkatan }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" value="{{ $new_siswa->siswa_isactive }}" readonly>
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
