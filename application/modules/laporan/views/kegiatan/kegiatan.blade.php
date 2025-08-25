@layout('template/back/main')
<link href="{{base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@section('scripts-css')

@endsection
@section('content')
<div class="container-fluid">
    </br>
    <h3>{{$title}}</h3>
    </br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if($kegiatan == "MCU")
                    <div class="row float-right">
                        <div class="col-12">
                            <div class="btn-group" role="group">
                                <button class="btn btn-primary waves-effect waves-light export_rd_admin_button">Export Rekap Dokter</button>
                                <button class="btn btn-primary waves-effect waves-light export_rmcu_admin_button">Export ke Excel</button>
                            </div>
                        </div>
                    </div>
                    @endif
                    <h4 class="card-title">Laporan Kegiatan {{formatKegiatan($kegiatan)}}</h4>
                    <div class="table-responsive" >
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 20px;">#</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col" width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($content as $i => $data)
                                <tr>
                                    <td><b>{{$i+=1}}</b></td>
                                    <td>{{formatJenjang($data->jenjang)}} - {{$data->kelas}}</td>
                                    <td>{{$data->jumlah_siswa}} Siswa</td>                                 
                                    <td>
                                        @if($kegiatan == "MCU" || $kegiatan == "SCR")
                                            <a class="btn btn-success" style="color:white" href="{{base_url('laporan/detailMCUSCR/'.$data->kelas_tingkat.'/'.$data->kelas_rombel.'/'.$data->periode_id.'/'.$data->jenjang)}}"> Lihat</a> 
                                        @elseif($kegiatan == "DCU")
                                            <a class="btn btn-success" style="color:white" href="{{base_url('laporan/detailDCU/'.$data->kelas_tingkat.'/'.$data->kelas_rombel.'/'.$data->periode_id.'/'.$data->jenjang)}}"> Lihat</a>
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
<script src="{{base_url('assets/js/report/rmcu_admin.js')}}"></script>
<script src="{{base_url('assets/js/report/rd_admin.js')}}"></script>
<script >
$(document).ready(function(){
    var table = $("#table").DataTable({
        "pageLength": 50,
    });
});
</script>
@endsection