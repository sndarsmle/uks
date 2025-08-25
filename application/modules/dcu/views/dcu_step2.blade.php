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
                                <a href="#v-pills-home" class="nav-link active show">Pemerikasaan Lanjutan</a> 
                                <a href="{{base_url('dcu/step3/'.$dcu->dcu_id)}}" class="nav-link">Evaluasi</a>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                <h4 class="card-title">Pemeriksaan Lanjutan</h4>
                                <hr>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label><b>Oklusi</b> </label>
                                        <input type="text" class="form-control input-default" name="form_oklusi" value="{{$dcuDetail->dcuDetail_oklusi}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Mukosa</b> </label>
                                        <textarea type="text" class="form-control input-default" name="form_mukosa" required>{{$dcuDetail->dcuDetail_muklosa}}</textarea>
                                    </div>
                                    <h4 class="card-title">DMF</h4>
                                    <table>  
                                        <tr>  
                                            <td> <b style="font-size:18px;">D</b> &nbsp;&nbsp;</td>
                                            <td><input type="text" class="form-control input-default" name="form_d" value="{{$dcuDetail->dcuDetail_d}}" required></td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp; <b style="font-size:18px;">M</b> &nbsp;&nbsp;</td>
                                            <td><input type="text" class="form-control input-default" name="form_m" value="{{$dcuDetail->dcuDetail_m}}" required></td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp; <b style="font-size:18px;">F</b> &nbsp;&nbsp;</td>
                                            <td><input type="text" class="form-control input-default" name="form_f" value="{{$dcuDetail->dcuDetail_f}}" required></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <h4 class="card-title">Frequensi menyikat gigi dalam 1 hari</h4>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input chb1" name="form_freq_sikat" value="1" {{ $dcuDetail->dcuDetail_freq_sikat == 1 ? "checked" : '' }}>1x</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="margin-left:10px;"> 
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input chb1" name="form_freq_sikat" value="2" {{ $dcuDetail->dcuDetail_freq_sikat == 2 ? "checked" : '' }}>2x</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="margin-left:10px;">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input chb1" name="form_freq_sikat" value="3" {{ $dcuDetail->dcuDetail_freq_sikat == 3 ? "checked" : '' }}>3x</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="margin-left:10px;">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input chb1" name="form_freq_sikat" value="4" {{ $dcuDetail->dcuDetail_freq_sikat == 4 ? "checked" : '' }}>Lebih dari 3x</label>
                                        </div>
                                    </div>
                                    <h4 class="card-title">Waktu Menggosok Gigi</h4>
                                    <div class="form-group">
                                        <div class="form-check mb-3">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input chb2" name="form_wkt_sikat" value="1" {{ $dcuDetail->dcuDetail_waktu_sikat == 1 ? "checked" : '' }}>Pagi Sebelum Makan</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input chb2" name="form_wkt_sikat" value="2" {{ $dcuDetail->dcuDetail_waktu_sikat == 2 ? "checked" : '' }}>Mandi Pagi dan Sore</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input chb2" name="form_wkt_sikat" value="3" {{ $dcuDetail->dcuDetail_waktu_sikat == 3 ? "checked" : '' }}>Malam Sebelum Tidur</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input chb2" name="form_wkt_sikat" value="4" {{ $dcuDetail->dcuDetail_waktu_sikat == 4 ? "checked" : '' }}>Pagi sebelum Makan dan Malam Sebelum Tidur</label>
                                        </div>
                                    </div>
                                    <h4 class="card-title">Penggunaan Pasta Gigi</h4>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input chb3" name="form_pasta" value="1" {{ $dcuDetail->dcuDetail_pasta == 1 ? "checked" : '' }}>Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="margin-left:10px;"> 
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input chb3" name="form_pasta" value="2" {{ $dcuDetail->dcuDetail_pasta == 2 ? "checked" : '' }}>Tidak</label>
                                        </div>
                                    </div>
                                    <h4 class="card-title">Konsumsi Makanan Manis</h4>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input chb4" name="form_makan_manis" value="1" {{ $dcuDetail->dcuDetail_manis == 1 ? "checked" : '' }}>Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline" style="margin-left:10px;"> 
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input chb4" name="form_makan_manis" value="2" {{ $dcuDetail->dcuDetail_manis == 2 ? "checked" : '' }}>Tidak</label>
                                        </div>
                                    </div>
                                    <br>
                                    <h4 class="card-title">Pemeriksaan OHI-S</h4>
                                    <h4 class="card-title">DI (Debris Index)</h4>
                                    <table>  
                                        <tr>
                                            <td width="120px"><input type="text" style="text-align:center;" class="form-control input-default" value="{{$dcuDetail->dcuDetail_di1}}" oninput="hitung_DI()"  name="form_di1" id="di1" required></td>
                                            <td width="120px"><input type="text" style="text-align:center;"  oninput="hitung_DI()"class="form-control input-default" value="{{$dcuDetail->dcuDetail_di2}}"  name="form_di2"id="di2"required></td>
                                            <td width="120px"><input type="text" style="text-align:center;" oninput="hitung_DI()" class="form-control input-default" value="{{$dcuDetail->dcuDetail_di3}}"  name="form_di3"id="di3"required></td>
                                        </tr>
                                        <tr>
                                            <td ><input type="text" style="text-align:center;" class="form-control input-default" value="{{$dcuDetail->dcuDetail_di4}}"  name="form_di4"id="di4" oninput="hitung_DI()"required></td>
                                            <td ><input type="text" style="text-align:center;" class="form-control input-default" value="{{$dcuDetail->dcuDetail_di5}}"  name="form_di5"id="di5" oninput="hitung_DI()"required></td>
                                            <td ><input type="text" style="text-align:center;" class="form-control input-default" value="{{$dcuDetail->dcuDetail_di6}}"  name="form_di6"id="di6" oninput="hitung_DI()"required></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <div class="form-group">
                                        <label><b>Skor DI</b> </label>
                                        <input type="text" class="form-control input-default" name="form_di_skor" value="{{$dcuDetail->dcuDetail_di}}"  required id="scoredi">
                                    </div>
                                    <h4 class="card-title">CI (Calculus Index)</h4>
                                    <table>  
                                        <tr>
                                            <td width="120px"><input type="text" style="text-align:center;" class="form-control input-default" value="{{$dcuDetail->dcuDetail_ci1}}" name="form_ci1" id="ci1"oninput="hitung_CI()"required></td>
                                            <td width="120px"><input type="text" style="text-align:center;" class="form-control input-default" value="{{$dcuDetail->dcuDetail_ci2}}" name="form_ci2"id="ci2"oninput="hitung_CI()"required></td>
                                            <td width="120px"><input type="text" style="text-align:center;" class="form-control input-default" value="{{$dcuDetail->dcuDetail_ci3}}" name="form_ci3"id="ci3"oninput="hitung_CI()"required></td>
                                        </tr>
                                        <tr>
                                            <td ><input type="text" style="text-align:center;" class="form-control input-default" value="{{$dcuDetail->dcuDetail_ci4}}" name="form_ci4"id="ci4"oninput="hitung_CI()"required></td>
                                            <td ><input type="text" style="text-align:center;" class="form-control input-default" value="{{$dcuDetail->dcuDetail_ci5}}" name="form_ci5"id="ci5"oninput="hitung_CI()"required></td>
                                            <td ><input type="text" style="text-align:center;" class="form-control input-default" value="{{$dcuDetail->dcuDetail_ci6}}" name="form_ci6"id="ci6"oninput="hitung_CI()"required></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <div class="form-group">
                                        <label><b>Skor CI</b> </label>
                                        <input type="text" class="form-control input-default" name="form_ci_skor" value="{{$dcuDetail->dcuDetail_ci}}" required id="scoreci">
                                    </div>
                                    <div class="form-group">
                                        <label><b>Skor OHI-S</b> </label>
                                        <input type="text" class="form-control input-default" name="form_ohis_skor" value="{{$dcuDetail->dcuDetail_ohis}}" required id="ohis">
                                    </div>
                                    <h4 class="card-title">Status OHI-S</h4>
                                    <div class="form-group">
                                        <div class="form-check mb-3">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input chb5" name="form_ohis_status" id="ohis_baik" value="1" {{ $dcuDetail->dcuDetail_ohis_status == 1 ? "checked" : '' }}> (0,0 - 1,2) Baik </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input chb5" name="form_ohis_status" id="ohis_sedang" value="2" {{ $dcuDetail->dcuDetail_ohis_status == 2 ? "checked" : '' }}> (1,3 - 3,0) Sedang</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input chb5" name="form_ohis_status" value="3" id="ohis_buruk" {{ $dcuDetail->dcuDetail_ohis_status == 3 ? "checked" : '' }}> (3,1 - 6,0) Buruk</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Keterangan</b> </label>
                                        <textarea class="form-control input-default" name="dcuDetail_Kettambahan" id="" cols="30" rows="5" required placeholder="klik untuk keterangan">{{$dcuDetail->dcuDetail_Kettambahan}}</textarea>
                                    </div>
                                    <button type="submit" style="color:white" class="btn btn-success">Simpan Data</button>
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
$(document).on("keydown", ":input:not(textarea)", function(event) {
    if (event.key == "Enter") {
        event.preventDefault();
    }
});
$(document).ready(function(){ 
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
    $('.select4').select2({
            theme: 'bootstrap4',
    });
 }); 
</script>
<script type="text/javascript">
     function hitung_DI()
     {

       var DI1 = parseInt(document.getElementById("di1").value);
       var DI2 = parseInt(document.getElementById("di2").value);
       var DI3 = parseInt(document.getElementById("di3").value);
       var DI4 = parseInt(document.getElementById("di4").value);
       var DI5 = parseInt(document.getElementById("di5").value);
       var DI6 = parseInt(document.getElementById("di6").value);
       var scoreDi;
       scoreDi=(DI1+DI2+DI3+DI4+DI5+DI6)/6;
       scoreDi=scoreDi.toFixed(1);
       document.getElementById("scoredi").value = scoreDi;
       hitung_ohis();

     }
     function hitung_CI()
     {

       var CI1 = parseInt(document.getElementById("ci1").value);
       var CI2 = parseInt(document.getElementById("ci2").value);
       var CI3 = parseInt(document.getElementById("ci3").value);
       var CI4 = parseInt(document.getElementById("ci4").value);
       var CI5 = parseInt(document.getElementById("ci5").value);
       var CI6 = parseInt(document.getElementById("ci6").value);
       var scoreCi;
       scoreCi=(CI1+CI2+CI3+CI4+CI5+CI6)/6;
       scoreCi=scoreCi.toFixed(1);
       document.getElementById("scoreci").value = scoreCi;
       hitung_ohis();
     }

     function hitung_ohis()
     {
        var scoreCI = parseFloat(document.getElementById("scoreci").value);
        var scoreDI = parseFloat(document.getElementById("scoredi").value);
        var Ohis;
        Ohis = scoreCI+scoreDI;
        document.getElementById("ohis").value = Ohis;
        if (Ohis<1.3) {
             document.getElementById("ohis_baik").checked = true;
             document.getElementById("ohis_sedang").checked = false;
             document.getElementById("ohis_buruk").checked = false;
        }
        else if ((Ohis<3.1)&&(Ohis>1.2)) {
             document.getElementById("ohis_baik").checked = false;
             document.getElementById("ohis_sedang").checked = true;
             document.getElementById("ohis_buruk").checked = false;

        }
        else {
            document.getElementById("ohis_baik").checked = false;
             document.getElementById("ohis_sedang").checked = false;
             document.getElementById("ohis_buruk").checked = true;
        }

     }
 </script>
@endsection
