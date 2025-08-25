@layout('template/back/main')

@section('scripts-css')
<link href="{{base_url('assets/plugins/select2/css/select2.min.css')}}?v=rt6" rel="stylesheet">
<link href="{{base_url('assets/css/select2-bootstrap4.min.css')}}?v=rt6" rel="stylesheet">
<link href="{{base_url('assets/plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
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
                    <h4 class="card-title">Dental Check Up - SD Teladan</h4>
                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                            <div class="nav flex-column nav-pills">
                                <a href="{{base_url('dcu/step1/'.$dcu->dcu_id)}}" class="nav-link">Ondotogram</a>
                                <a href="{{base_url('dcu/step2/'.$dcu->dcu_id)}}" class="nav-link">Pemerikasaan Lanjutan</a> 
                                <a href="#v-pills-home" class="nav-link active show">Evaluasi</a>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                <h4 class="card-title">Evaluasi Pemeriksaan</h4>
                                <hr>
                                <h5>Pastikan data telah diisi dengan benar sebelum menekan tombol di bawah ini untuk menyelesaikan pemeriksaan :</h5>
                                <table>
                                    <tr>
                                        <td>Dokter Periksa</td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td>{{$user}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Periksa</td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td>{{$dcu->dcu_date}}</td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi Periksa</td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td>{{$dcu->dcu_location}}</td>
                                    </tr>
                                </table>
                                <br>
                                <form action="" method="post">
                                    <input type="hidden" name="form_status" value="1"/>
                                    <input type="submit" style="color:white" class="btn btn-success" value="Proses Evaluasi">
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
<script src="{{base_url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{base_url('assets/plugins/toastr/js/toastr.min.js')}}"></script>
<script >
$(document).ready(function(){ 
    $('.select4').select2({
            theme: 'bootstrap4',
    });
 }); 
</script>
@endsection
