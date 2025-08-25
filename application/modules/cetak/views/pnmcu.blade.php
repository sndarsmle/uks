@layout('template/back/main')

@section('scripts-css')
<link href="{{base_url('assets/plugins/select2/css/select2.min.css')}}?v=rt6" rel="stylesheet">
<link href="{{base_url('assets/css/select2-bootstrap4.min.css')}}?v=rt6" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    </br>
    <center><h2><font color="green"> Data Medical Check Up Siswa</font></h2></center>
    </br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cari Siswa</h4>
                    <form action="pdmcu" method='POST'>
                        <div class='form-group'>
                            <label>Jenjang</label>
                            <select id='pilihJenjang' class="form-control select4">
                                <option value='0'> ---- Pilih Jenjang ---- </option>
                                <option value='22'> KBTK </option>
                                <option value='33'> SD </option>
                                <option value='44'> SMP </option>
                            </select>
                        </div>
                        <div class='form-group'>
                            <label>Siswa</label>
                            <select id='searchSiswa' class="form-control select4" name="siswa">
                                <option value='0'> Masukan Nama </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Cek</button>
                    </from>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts-js')
<script src="{{base_url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script >
    var jenjang;
    $(document).ready(function() {
        $('.select4').select2({
            theme: 'bootstrap4',
        });
        $("#pilihJenjang").change(function() {
            jenjang = document.getElementById("pilihJenjang").value;
            $("#searchSiswa").select2({
                theme: "bootstrap4",
                ajax: { 
                    url: '{{base_url('api/siswa/liveSearch?key=')}}'+jenjang,
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
    });
</script>
@endsection