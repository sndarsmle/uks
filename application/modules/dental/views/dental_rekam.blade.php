@layout('template/back/main')

@section('scripts-css')
<link href="{{base_url('assets/plugins/select2/css/select2.min.css')}}?v=rt6" rel="stylesheet">
<link href="{{base_url('assets/css/select2-bootstrap4.min.css')}}?v=rt6" rel="stylesheet">
<style>
    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

    .modal {
        display: none;
        position: fixed;
        padding-top: 100px; 
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto; 
        background-color: rgb(0,0,0); 
        background-color: rgba(0,0,0,0.7);
    }

    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    .modal-content, #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }

    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,.close:focus {
        color: #fff;
        text-decoration: none;
        cursor: pointer;
    }

    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    </br>
    <center><h2><font color="green"> Dental Check Up Siswa</font></h2></center>
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
                                <input type="text" class="form-control" value="{{$siswa->nis}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" value="{{$siswa->nama}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tgl Lahir</label>
                                <input type="text" class="form-control" value="{{$siswa->tgl_lahir}}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Kelas</label>
                                <input type="text" class="form-control" value="{{$siswa->kelas}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Ondotogram</h4>
                    <center>
                        <img id="myImg" src="{{base_url('assets/images/gigi.png')}}" alt="Ondotogram" style="width:100%;max-width:600px">
                    </center>
                    <div id="myModal" class="modal">
                        <span class="close">&times;</span>
                        <img class="modal-content" id="img01">
                        <div id="caption"></div>
                    </div>

                    <h4 class="card-title">Diagnosis</h4>
                    
                    <div class="form-group">  
                        <form method="POST" name="add_name" id="add_name">  
                            <div class="table-responsive">  
                                <table class="table table-bordered" id="dynamic_field">  
                                    <tr>  
                                        <td>                            
                                            <select class="form-control select4" id="form_gigi">
                                                <option value=''> Nomor Gigi </option>
                                                <option value='0'> Semua Gigi </option>
                                                <option value='1'> 1 </option>
                                                <option value='2'> 2 </option>
                                                <option value='3'> 3 </option>
                                                <option value='4'> 4 </option>
                                                <option value='5'> 5 </option>
                                                <option value='6'> 6 </option>
                                                <option value='7'> 7 </option>
                                                <option value='8'> 8 </option>
                                                <option value='9'> 9 </option>
                                                <option value='10'> 10 </option>
                                                <option value='11'> 11 </option>
                                                <option value='12'> 12 </option>
                                                <option value='13'> 13 </option>
                                                <option value='14'> 14 </option>
                                                <option value='15'> 15 </option>
                                                <option value='16'> 16 </option>
                                                <option value='17'> 17 </option>
                                                <option value='18'> 18 </option>
                                                <option value='19'> 19 </option>
                                                <option value='20'> 20 </option>
                                                <option value='21'> 21 </option>
                                                <option value='22'> 22 </option>
                                                <option value='23'> 23 </option>
                                                <option value='24'> 24 </option>
                                                <option value='25'> 25 </option>
                                                <option value='26'> 26 </option>
                                                <option value='27'> 27 </option>
                                                <option value='28'> 28 </option>
                                                <option value='29'> 29 </option>
                                                <option value='30'> 30 </option>
                                                <option value='31'> 31 </option>
                                                <option value='32'> 32 </option>
                                                <option value='33'> 33 </option>
                                                <option value='34'> 34 </option>
                                                <option value='35'> 35 </option>
                                                <option value='36'> 36 </option>
                                                <option value='37'> 37 </option>
                                                <option value='38'> 38 </option>
                                                <option value='39'> 39 </option>
                                                <option value='40'> 40 </option>
                                                <option value='41'> 41 </option>
                                                <option value='42'> 42 </option>
                                                <option value='43'> 43 </option>
                                                <option value='44'> 44 </option>
                                                <option value='45'> 45 </option>
                                                <option value='46'> 46 </option>
                                                <option value='47'> 47 </option>
                                                <option value='48'> 48 </option>
                                                <option value='49'> 49 </option>
                                                <option value='50'> 50 </option>
                                                <option value='51'> 51 </option>
                                                <option value='52'> 52 </option>
                                                <option value='53'> 53 </option>
                                                <option value='54'> 54 </option>
                                                <option value='55'> 55 </option>
                                                <option value='56'> 56 </option>
                                                <option value='57'> 57 </option>
                                                <option value='58'> 58 </option>
                                                <option value='59'> 59 </option>
                                                <option value='60'> 60 </option>
                                                <option value='61'> 61 </option>
                                                <option value='62'> 62 </option>
                                                <option value='63'> 63 </option>
                                                <option value='64'> 64 </option>
                                                <option value='65'> 65 </option>
                                                <option value='66'> 66 </option>
                                                <option value='67'> 67 </option>
                                                <option value='68'> 68 </option>
                                                <option value='69'> 69 </option>
                                                <option value='70'> 70 </option>
                                                <option value='71'> 71 </option>
                                                <option value='72'> 72 </option>
                                                <option value='73'> 73 </option>
                                                <option value='74'> 74 </option>
                                                <option value='75'> 75 </option>
                                                <option value='81'> 81 </option>
                                                <option value='82'> 82 </option>
                                                <option value='83'> 83 </option>
                                                <option value='84'> 84 </option>
                                                <option value='85'> 85 </option>
                                            </select>
                                        </td>  
                                        <td>
                                            <input type="text" class="form-control input-default" id="form_diag" placeholder="Diagnosis">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control input-default" id="form_ket" placeholder="Keterangan">
                                        </td>
                                        <td>
                                            <button type="button" name="add" id="add" class="btn btn-success" style="color:white">Tambah Diagnosis</button>
                                        </td>  
                                    </tr>  
                                </table>  
                                
                            </div>  
                            <div class="form-group">
                                <label><b>Oklusi</b> </label>
                                <input type="text" class="form-control input-default" name="form_oklusi" required>
                            </div>
                            <div class="form-group">
                                <label><b>Mukosa</b> </label>
                                <textarea type="text" class="form-control input-default" name="form_mukosa" required></textarea>
                            </div>
                            <h4 class="card-title">DMF</h4>
                            <table>  
                                <tr>  
                                    <td> <b style="font-size:18px;">D</b> &nbsp;&nbsp;</td>
                                    <td><input type="text" class="form-control input-default" id="form_d" required></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp; <b style="font-size:18px;">M</b> &nbsp;&nbsp;</td>
                                    <td><input type="text" class="form-control input-default" id="form_m" required></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp; <b style="font-size:18px;">F</b> &nbsp;&nbsp;</td>
                                    <td><input type="text" class="form-control input-default" id="form_f" required></td>
                                </tr>
                            </table><br>
                            <h4 class="card-title">Frequensi menyikat gigi dalam 1 hari</h4>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input chb1" name="form_freq_sikat" value="1">1x</label>
                                </div>
                                <div class="form-check form-check-inline" style="margin-left:10px;"> 
                                    <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input chb1" name="form_freq_sikat" value="2">2x</label>
                                </div>
                                <div class="form-check form-check-inline" style="margin-left:10px;">
                                    <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input chb1" name="form_freq_sikat" value="3">3x</label>
                                </div>
                                <div class="form-check form-check-inline" style="margin-left:10px;">
                                    <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input chb1" name="form_freq_sikat" value="4">Lebih dari 3x</label>
                                </div>
                            </div>
                            <h4 class="card-title">Waktu Menggosok Gigi</h4>
                            <div class="form-group">
                                <div class="form-check mb-3">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input chb2" name="form_wkt_sikat" value="1">Pagi Sebelum Makan</label>
                                </div>
                                <div class="form-check mb-3">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input chb2" name="form_wkt_sikat" value="2">Mandi Pagi dan Sore</label>
                                </div>
                                <div class="form-check mb-3">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input chb2" name="form_wkt_sikat" value="3">Malam Sebelum Tidur</label>
                                </div>
                                <div class="form-check mb-3">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input chb2" name="form_wkt_sikat" value="4">Pagi sebelum Makan dan Malam Sebelum Tidur</label>
                                </div>
                            </div>
                            <h4 class="card-title">Penggunaan Pasta Gigi</h4>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input chb3" name="form_pasta" value="1">Ya</label>
                                </div>
                                <div class="form-check form-check-inline" style="margin-left:10px;"> 
                                    <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input chb3" name="form_pasta" value="2">Tidak</label>
                                </div>
                            </div>
                            <h4 class="card-title">Konsumsi Makanan Manis</h4>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input chb4" name="form_makan_manis" value="1">Ya</label>
                                </div>
                                <div class="form-check form-check-inline" style="margin-left:10px;"> 
                                    <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input chb4" name="form_makan_manis" value="2">Tidak</label>
                                </div>
                            </div>
                            <br>
                            <h4 class="card-title">Pemeriksaan OHI-S</h4>
                            <h4 class="card-title">DI (Debris Index)</h4>
                            <table>  
                                <tr>
                                    <td width="120px"><input type="text" style="text-align:center;" class="form-control input-default" name="form_di1"></td>
                                    <td width="120px"><input type="text" style="text-align:center;" class="form-control input-default" name="form_di2"></td>
                                    <td width="120px"><input type="text" style="text-align:center;" class="form-control input-default" name="form_di3"></td>
                                </tr>
                                <tr>
                                    <td ><input type="text" style="text-align:center;" class="form-control input-default" name="form_di4"></td>
                                    <td ><input type="text" style="text-align:center;" class="form-control input-default" name="form_di5"></td>
                                    <td ><input type="text" style="text-align:center;" class="form-control input-default" name="form_di6"></td>
                                </tr>
                            </table>
                            <br>
                            <div class="form-group">
                                <label><b>Skor DI</b> </label>
                                <input type="text" class="form-control input-default" name="form_di_skor" required>
                            </div>
                            <h4 class="card-title">CI (Calculus Index)</h4>
                            <table>  
                                <tr>
                                    <td width="120px"><input type="text" style="text-align:center;" class="form-control input-default" name="form_ci1"></td>
                                    <td width="120px"><input type="text" style="text-align:center;" class="form-control input-default" name="form_ci2"></td>
                                    <td width="120px"><input type="text" style="text-align:center;" class="form-control input-default" name="form_ci3"></td>
                                </tr>
                                <tr>
                                    <td ><input type="text" style="text-align:center;" class="form-control input-default" name="form_ci4"></td>
                                    <td ><input type="text" style="text-align:center;" class="form-control input-default" name="form_ci5"></td>
                                    <td ><input type="text" style="text-align:center;" class="form-control input-default" name="form_ci6"></td>
                                </tr>
                            </table>
                            <br>
                            <div class="form-group">
                                <label><b>Skor CI</b> </label>
                                <input type="text" class="form-control input-default" name="form_ci_skor" required>
                            </div>
                            <div class="form-group">
                                <label><b>Skor OHI-S</b> </label>
                                <input type="text" class="form-control input-default" name="form_ohis_skor" required>
                            </div>
                            <h4 class="card-title">Status OHI-S</h4>
                            <div class="form-group">
                                <div class="form-check mb-3">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input chb5" name="form_ohis_status" value="1"> (0,0 - 1,2) Baik </label>
                                </div>
                                <div class="form-check mb-3">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input chb5" name="form_ohis_status" value="2"> (1,3 - 3,0) Sedang</label>
                                </div>
                                <div class="form-check mb-3">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input chb5" name="form_ohis_status" value="3"> (3,1 - 6,0) Buruk</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><b>Periode Periksa</b> </label>
                                <select class="form-control select4" name="form_periode" required>
                                    <option value=''> Pilih Periode </option>
                                    @foreach ($periode as $data)
                                        <option value="{{$data->id}}">{{$data->periode_mcu}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label><b>Tanggal Periksa</b> </label>
                                <input type="date" class="form-control input-default" name="form_tgl" required>
                            </div>
                            <div class="form-group">
                                <label><b>Dokter Periksa</b> </label>
                                <input type="text" class="form-control input-default" name="form_dokter" required>
                            </div>
                            <input type="submit" class="btn btn-info float-right" value="Submit" />  
                        </form>  
                    </div>  
                </div>
            </div>
        </div>
    </div>               
</div>
@endsection
@section('scripts-js')
<script src="{{base_url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script >
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
    var modal = document.getElementById("myModal");
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        modal.style.display = "none";
    }
    var i=1;  
    $('#add').click(function(){  
        i++;  
        var gigi = document.getElementById("form_gigi").value;
        var diag = document.getElementById("form_diag").value;
        var ket = document.getElementById("form_ket").value;
        $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="form_gigi[]" value="'+gigi+'" class="form-control name_list" readonly/></td><td><input type="text" name="form_diag[]" value="'+diag+'" class="form-control name_list" readonly/></td><td><input type="text" name="form_ket[]" value="'+ket+'" class="form-control name_list" readonly/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
        $("#form_gigi").prop('selectedIndex',0);
        document.getElementById("form_diag").value =null ;
        document.getElementById("form_ket").value = null;
    });  
    $(document).on('click', '.btn_remove', function(){  
        var button_id = $(this).attr("id");   
        $('#row'+button_id+'').remove();  
    });  
 }); 
</script>
@endsection