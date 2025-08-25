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
                    <h4 class="card-title">Detail Laporan Dental Checkup </h4>
                    <div class="table-responsive" >
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col" width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($content as $i => $data)
                                <tr>
                                    <th style="width:20px;">{{$i+=1}}</th>
                                    <td>{{formatJenjang($data->jenjang)}} - {{$data->kelas}}</td>
                                    <td>{{$data->jumlah_siswa}} Siswa</td>                                    
                                    <td>
                                        <a style="color:white" class="btn btn-success" href="{{base_url('wali/detailDCU2/'.$data->kelas_tingkat.'/'.$data->kelas_rombel.'/'.$data->periode_id)}}"> Lihat</a> 
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