@layout('template/back/main')

@section('scripts-css')
<link href="{{base_url('assets/plugins/select2/css/select2.min.css')}}?v=rt6" rel="stylesheet">
<link href="{{base_url('assets/css/select2-bootstrap4.min.css')}}?v=rt6" rel="stylesheet">
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
                    <h4 class="card-title">Cari Siswa</h4>
                    <form action="" method='POST'>
                        <div class='form-group'>
                            <select id='searchSiswa' class="form-control select4" name="form_siswa">
                                <option value='0'> Masukan NIS atau Nama </option>
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
    $(document).ready(function() {
        $('.select4').select2({
            theme: 'bootstrap4',
        });
        $("#searchSiswa").select2({
            theme: "bootstrap4",
            ajax: { 
                url: '{{base_url('api/siswa/liveSearch')}}',
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
@endsection