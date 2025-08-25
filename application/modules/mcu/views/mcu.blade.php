@layout('template/back/main')

@section('scripts-css')
<link href="{{base_url('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
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
                    <h4 class="card-title">List Daftar Tunggu Medical Check Up</h4>
                    @foreach($periode_list as $i => $periode)
                    <a href="{{ base_url("mcu?periode_id={$periode->periode_id}") }}"
                       class="btn mb-1 {{ $periode->periode_id === $params['periode_id'] ? 'btn-success text-white' : 'btn-outline-success text-success'}}"
                    >
                        {{ $periode->periode_name }} - {{ $periode->periode_monthName }} {{ $periode->periode_year }}
                    </a>
                    @endforeach
                    <a href="{{ base_url("mcu?all_mcu=1") }}"
                       class="btn mb-1 {{ $params['all_mcu'] ?  'btn-primary text-white' : 'btn-outline-primary text-primary' }}"
                    >
                        MCU - Semua
                    </a>
                    <a href="{{ base_url("mcu?all_dcu=1") }}"
                       class="btn mb-1 {{ $params['all_dcu'] ? 'btn-primary text-white' : 'btn-outline-primary text-primary'  }}"
                    >
                        DCU - Semua
                    </a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Periode</th>
                                    <th scope="col">Tanggal Daftar</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($daftarTunggu as $i => $data)
                                <tr>
                                    <th></th>
                                    <td>{{$data->siswa_nama}}</td>
                                    <td>{{$data->siswa_kelas}}</td>
                                    <td>{{formatKegiatan($data->periode_name).' - '.$data->periode_monthName.' '.$data->periode_year}}</td>
                                    <td>{{$data->waiting_ftime}}</td>
                                    <td><a href="{{base_url('mcu/reservasi/proses/'.$data->waiting_id)}}" class="btn mb-1 btn-info">Proses</a></td>
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
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = (i+1)+".";
        } );
    } ).draw();
});
</script>
@endsection
