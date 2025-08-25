@layout('template/back/main')

@section('scripts-css')
<link href="{{base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
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
                    <h4 class="card-title">List Tahun Akademik</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tahun Akademik</th>
                                    <th scope="col">Angkatan</th>
                                    <th scope="col">Jumlah Kegiatan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tahun_akademik as $i => $data)
                                <tr>
                                    <th>{{$i+=1}}.</th>
                                    <td>{{$data->thnAkademik_yearstart}} / {{$data->thnAkademik_yearend}}</td>
                                    <td>{{$data->thnAkademik_year}}</td>
                                    <td>{{$data->thnAkademik_totalperiode}}</td>
                                    <td>
                                        <a href="{{base_url('laporan/tahun/'.$data->thnAkademik_id)}}" class="btn mb-1 btn-info">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts-js')
<script src="{{base_url('assets/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{base_url('assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{base_url('assets/plugins/toastr/js/toastr.min.js')}}"></script>
<script >
$(document).ready(function(){
    var table = $("#table").DataTable({
        "pageLength": 50,
    });
});
</script>
@endsection
