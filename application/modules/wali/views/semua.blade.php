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
                    <h4 class="card-title">Daftar Riwayat Medical Check Up</h4>
                    <div class="table-responsive" >
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jadwal MCU</th>
                                    <th scope="col"> <center> Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody><?php $i=0; ?>
                            @foreach($content as $hasil)
                            
                                <tr> <center>
                                    <th>{{$i+1}}</th>
                                    <td>{{$hasil->nis}} | {{$hasil->nama}}</td>
                                    <td>{{$hasil->jadwal_mcu}}</td>                                 
                                    <td><center>  <a href="{{base_url('cetak/precetakmcu/'.$hasil->nis.'/'.$hasil->kode_mcu)}}" class="btn btn-success">Lihat </a>
                                    </center></td>
                                </center></tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS -->

 <!-- Default box -->
      <

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