@layout('template/back/main')
<link href="{{base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
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
                    <h4 class="card-title">Detail Laporan Dental Check Up</h4>
                    <div class="table-responsive" >
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIS</th>
                                    <th scope="col">Jadwal DCU</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($content as $i => $data)
                                <tr>
                                    <td><b>{{$i+=1}}</b></td>
                                    <td>{{$data->siswa_nama}}</td>
                                    <td>{{$data->siswa_nis}}</td>
                                    <td>{{$data->periode_monthName}} {{$data->periode_year}}</td>                                 
                                    <td>
                                        @if($data->dcu_isfinish or $data->dokter_id)
                                        <a href="{{base_url('cetakdoc/precetakdcu/'.$data->dcu_id)}}" class="btn btn-success" style="color:white">Lihat </a>
                                        @else
                                            <span class="badge badge-warning">Belum Selesai</span>
                                        @endif
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
<script >
    
$(document).ready(function(){
    var table = $("#table").DataTable({
        "pageLength": 50,
    });
    
});
</script>
@endsection