@layout('template/back/main')

@section('scripts-css')
<link href="{{base_url('assets/plugins/select2/css/select2.min.css')}}?v=rt6" rel="stylesheet">
<link href="{{base_url('assets/plugins/sweetalert/css/sweetalert.css')}}?v=rt6" rel="stylesheet">
<link href="{{base_url('assets/css/select2-bootstrap4.min.css')}}?v=rt6" rel="stylesheet">
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
                    <h4 class="card-title">Buat Daftar Tunggu</h4>
                    <hr>
                    <form action="" method="POST">
                        <div class='form-group'>
                            <label>Siswa</label>
                            <select id='searchSiswa' class="form-control select4" name="form_siswa" required>
                                <option value='0'> Masukan Nama </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Medical Check Up</label>
                            <input type="date" class="form-control input-default" value="{{date('Y-m-d')}}" name="form_tgl" required>
                        </div>
                        <div class="form-group">
                            <label>Kegiatan</label>
                            <select class="form-control select4" name="form_periode" required>
                                <option value='0'> --- Pilih Kegiatan --- </option>
                                @foreach($kegiatan as $data)
                                <option value='{{$data->periode_id}}'> {{formatKegiatan($data->periode_name)}} - {{$data->periode_monthName}} {{$data->periode_year}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Lokasi Medical Check Up</label>
                            <input type="text" class="form-control input-default" name="form_lokasi" value="Sekolah Teladan Yogyakarta " required>
                        </div>
                        <center>
                            <input type="submit" style="color:white" class="btn mb-1 btn-success" value="Proses Data"/>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts-js')
<script src="{{base_url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{base_url('assets/plugins/sweetalert/js/sweetalert.min.js')}}"></script>
<script >
    var jenjang;
    $(document).ready(function() {
        $('.select4').select2({
            theme: 'bootstrap4',
        });
        $("#searchSiswa").select2({
            theme: "bootstrap4",
            ajax: { 
                url: '{{base_url('api/siswa/liveSearch2?key=')}}<?php echo $key ?>',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });
</script>
@if(isset($result) && $result == 1)
<script type="text/javascript">
$(document).ready(function() {
    swal("Berhasil!!","Siswa sudah masuk daftar tunggu  !!","success")
});
</script>
@endif
@endsection
